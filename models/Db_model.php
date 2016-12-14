<?php if(!defined('BASEPATH')) exit('Direct Access Not Allowed');
	class Db_model extends CI_Model{
		public function getuser(){
			//讀取帳號密碼
			$salt = "iwantmore";
			$data = array(
					'user'          => $this->input->post('user'),
					'user_password' => hash('sha512',$this->input->post('user_password').$salt)
					);
			$res = $this->db->where($data)
			                ->get('members');
			return $res;
		}
		public function ChangeUserData(){
			//更改database的帳號密碼
			$salt = "iwantmore";
			$id = $this->session->userdata('login')['id'];
			$data = array(
					'user_password' => hash('sha512',$this->input->post('user_password').$salt)
					);
			$res = $this->db->where('id',$id)
			                ->update('members',$data);
			return true;
		}
		public function GetNews($keyword){
			//從database讀取全部文章的數量
			if($keyword == ""){
				//進全部文章時先將所有文章找出,因database有分類所以將$keyword指定成news 將所有文章找出
				$keyword = 'news';
				$query = $this->db->where('type',$keyword)
				                  ->get('news');
				//將取到的結果返回
				return $query->num_rows();
			}else{
				$query = $this->db->select('*')
								  ->from('news')
								  ->where("(name LIKE '%$keyword%' OR content LIKE '%$keyword%')")
								  ->get();
				return $query->num_rows();
			}
		}
		public function printNews($keyword,$page,$page_size){
			//依照controller傳進來的參數來回傳相對應的資料
			if($keyword == ""){
				$keyword = 'news';
				$query = $this->db->where('type',$keyword)
								  ->order_by('id','DESC')
				                  ->get('news',$page_size,$page);
				return $query->result();
			}else{
				$query = $this->db->select('*')
					              ->where("(name LIKE '%$keyword%' OR content LIKE '%$keyword%')")
					              ->order_by('id','DESC')
					              ->get('news',$page_size,$page);
				return $query->result();
			}
		
		}
		public function catchnews($id){
			//回傳資料庫查詢到選的消息文章
			$query = $this->db->where('id',$id)->get('news');
			return $query->result();
		}
		public function Delnews($id){
			//刪除database文章
			$query = $this->db->where('id',$id)
					          ->delete('news');
			return true;
		}
		public function Ednews($id){
			//編輯database文章
			$data = array('name'      => $this->input->post('name'),
						  'content'   => $this->input->post('content'),
						  'video_url' => $this->input->post('video_url')
			);
			$query = $this->db->where('id',$id)
							  ->update('news',$data);
			return true;
		}
		public function setnews(){
			//更改資料庫的消息文章
				$this->load->helper('date');
				$datestring = '%Y/%m/%d-%h:%i %a';
				$now = now('Asia/Taipei');
				$data = array('type' => 'news',
							  'name' => $this->input->post('name'),
							  'content' => $this->input->post('content'),
							  'video_url' => $this->input->post('video_url'),
							  'datetime' =>  mdate($datestring, $now)
				);
				$query = $this->db->insert('news', $data);
				return true;
		}
		public function GetProductRows($product){
			//回傳所有商品的數量分頁用
				if($product == ""){
					$query = $this->db->get('goods');
					return $query->num_rows();
				}else{
					$query = $this->db->select('*')
									  ->from('goods')
									  ->where("(name LIKE '%$product%' OR content LIKE '%$product%')")
									  ->get();
					return $query->num_rows();
				}
		}
		public function GetProduct($product,$page,$page_size){
			//依照controller所傳來的參數來回傳找到相應的商品結果
			if($product == ""){
				$query = $this->db->order_by('datetime','DESC')
								  ->get('goods',$page_size,$page);
				return $query->result();
			}else{
				$query = $this->db->select('*')
								  ->where("(name LIKE '%$product%' OR content LIKE '%$product%')")
								  ->order_by('datetime','DESC')
								  ->get('goods',$page_size,$page);
				return $query->result();
			}
		}
		public function Delproduct($id){
			//刪除資料庫找尋到相對應的ID資料
			$query = $this->db->where('id',$id)
				          ->delete('goods');
			return true;
		}
		public function catchproduct($id){
			//回傳所選ID的資料
			$query = $this->db->where('id',$id)->get('goods');
			return $query->result();
		}
		public function deletefile($product){
			//刪除資料
			$query = $this->db->where('id',$product['id'])
							  ->get('goods');
			return $query->result();
		}
		public function changeproduct($product){
			//編輯修改資料
			$query = $this->db->where('id',$product['id'])
							  ->update('goods',$product);
			return true;
		}
		public function Postproduct($product){
			//新增商品
				$this->load->helper('date');
				$datestring = '%Y/%m/%d-%h:%i %a';
				$now = now('Asia/Taipei');
				$product['datetime'] = mdate($datestring, $now);
				$query = $this->db->insert('goods', $product);
				return true;
		}
	}