<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Edit extends CI_Controller{
		public function catch_news(){
			//讀取所有消息
			$title = array('title' =>"編輯文章消息",'name'=>'title_1');
			$id    = $this->uri ->segment(3);
			$this->load->view('home',$title);
			if(!empty($id)){
				$this->load->model('Db_model','news');
				$data['list'] = $this->news->catchnews($id);
				$this->load->view('news',$data);
			}
				$this->load->view('footer');
		}
		public function del_news(){
			//刪除選取的消息
			$id    = $this->uri ->segment(3);
			$title = array('title' =>"全部文章",'name'=>'title_1');
			$this->load->view('home',$title);
			$this->load->view('search');
			if(!empty($id)){
				$this->load->model('Db_model','news');
				$data = $this->news->Delnews($id);
				if($data){
					$msg = array('stat'=>'<div class="alert alert-danger"><strong>刪除成功!!!</strong></div>');
					$this->load->view('title_1',$msg);
				}
			}
			$this->load->view('footer');
		}
		public function searchnews(){
			//查詢消息
			$keyword = $this->input->post('keyword');
			if($keyword !== ""){
				//如果輸入的搜尋不為空將$keyword傳給search_results方法
			$this->search_results($keyword);
			}else{
				$title = array('title' =>"搜尋文章",'name'=>'title_1');
				$data  = array('stat'=>'<div class="alert alert-danger"><strong>請輸入要尋找的關鍵字!!!</strong></div>');
				$this->load->view('home',$title);
				$this->load->view('title_1',$data);
				$this->load->view('footer');
			}
		}

		public function search_results($keyword){
			//搜尋得到的結果結合分頁
			$keyword = urldecode($keyword);
			$title 	 = array('title' =>"搜尋文章",'name'=>'title_1');
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->model('Db_model','news');
			//前往數據庫GetNews
			$query = $this->news->GetNews($keyword);
			//每頁顯示的數據
			$page_size  = 5;
			//取到的所有數據
			$total_rows = intval($query);
			if($total_rows>0){
			//定義參數頁面
			$page = intval($this->uri->segment(4));
			//將上面取出的$page,$page_size傳到printNews方法
			$data['list'] 				= $this->news->printNews($keyword,$page,$page_size);
			$config['base_url'] 		= site_url("Edit/search_results/").$keyword;
			$config['per_page'] 		= $page_size;
			$config['total_rows'] 		= $total_rows;
			$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] 	="</ul>";
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tagl_close'] 	= "</li>";
			$config['prev_tag_open'] 	= "<li>";
			$config['prev_tagl_close'] 	= "</li>";
			$config['first_tag_open'] 	= "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] 	= "<li>";
			$config['last_tagl_close'] 	= "</li>";
			$this->pagination->initialize($config);
			//載入home,將標題$title丟過去
			$this->load->view('home',$title);
			//載入search
			$this->load->view('search');
			$data['link'] = $this->pagination->create_links();
			$this->load->view('title_1',$data);
			$this->load->view('footer');
			}else {
				$title = array('title' =>"搜尋文章",'name'=>'title_1');
				$this->load->view('home',$title);
				$data = array('stat'=>'<div class="alert alert-danger"><strong>沒有找到相關資訊!!!</strong></div>');
				$this->load->view('title_1',$data);
				$this->load->view('footer');
			}
		}

		public function ed_news(){
			//編輯消息文章
			$id   	 = $this->uri ->segment(3);
			$name 	 = $this->input->post('name');
			$content = $this->input->post('content');
			$repost  = true;
			$this->load->view('home');
				if(!empty($name) && !empty($content)){
					$this->load->model('Db_model','news');
					$data['list'] = $this->news->Ednews($id);
					$data = array('stat'=>'<div class="alert alert-info"><strong>更新成功!!!</strong></div>');
					$this->load->view('renews',$data);
					$repost = false;
				}else{
					$data = array('stat'=>'<div class="alert alert-danger"><strong>請重新編輯，內容不得為空!!!</strong></div>');
					$this->load->view('renews',$data);
				}
			$this->load->view('footer');
		}
		public function setnews(){
			//編輯文章頁
			$title = array('title' =>'新增文章');
			$this->load->view('home',$title);
			$this->load->view('setnews');
			$this->load->view('footer');
		}
		public function postnews(){
			//發表文章
			$name 	 = $this->input->post('name');
			$content = $this->input->post('content');
			$post 	 = true;
			$this->load->view('home');
				if(!empty($name) && !empty($content) && $post){
					$this->load->model('Db_model','news');
					$data['list'] = $this->news->setnews();
					$data = array('stat'=>'<div class="alert alert-info"><strong>新增成功!!!</strong></div>');
					$this->load->view('renews',$data);
					$post = false;
				}else{
					$data = array('stat'=>'<div class="alert alert-danger"><strong>請重新編輯，內容不得為空!!!</strong></div>');
					$this->load->view('renews',$data);
				}
			$this->load->view('footer');
		}
		public function newspage(){
			//所有文章結合分頁功能
			//接收getMyPageTitle的$title
			//Load pagination
			$this->load->library('pagination');
			$this->load->model('Db_model','news');
			$title   = array('title' =>"全部文章",'name'=>'新增文章');
			//前往數據庫GetNews
			$keyword = "";
			$query   = $this->news->GetNews($keyword);
			//每頁顯示的數據
			$page_size  = 5;
			//取到的所有數據
			$total_rows = intval($query);
			//定義參數頁面
			$page       = intval($this->uri->segment(3));
			//將上面取出的$page,$page_size傳到printNews方法
			$data['list'] 				= $this->news->printNews($keyword,$page,$page_size);
			$config['base_url'] 		= site_url('Edit/newspage/');
			$config['per_page'] 		= $page_size;
			$config['total_rows'] 		= $total_rows;
			$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] 	="</ul>";
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tagl_close']  = "</li>";
			$config['prev_tag_open']    = "<li>";
			$config['prev_tagl_close']  = "</li>";
			$config['first_tag_open']   = "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open']    = "<li>";
			$config['last_tagl_close']  = "</li>";
			$this->pagination->initialize($config);
			$data['link'] = $this->pagination->create_links();
			//載入view
			$this->load->view('home',$title);
			$this->load->view('search',$title);
			$this->load->view('title_1',$data);
			$this->load->view('footer');
		}
		public function GetAllProduct(){
			//讀取所有商品結合分頁功能
			//更改DB_model名稱為product
			$this->load->library('pagination');
			$this->load->model('Db_model','product');
			//標題
			$title   = array('title' =>"所有商品",'name'=>'新增商品');
			//所有商品
			$product = "";
			//將搜尋到數量變成變數
			$query   = $this->product->GetProductRows($product);
			//每頁所顯示的商品數量
			$page_size = 10;
			//所有商品的數量若返回空則改成0
			$total_rows = intval($query);
			//$page參數取第三位
			$page 	= intval($this->uri->segment(3));
			$data['list'] = $this->product->GetProduct($product,$page,$page_size);
			//更改分頁樣式
			$config['base_url'] 		= site_url('Edit/GetAllProduct/');
			$config['per_page'] 		= $page_size;
			$config['total_rows'] 		= $total_rows;
			$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] 	="</ul>";
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tagl_close'] 	= "</li>";
			$config['prev_tag_open'] 	= "<li>";
			$config['prev_tagl_close'] 	= "</li>";
			$config['first_tag_open'] 	= "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] 	= "<li>";
			$config['last_tagl_close'] 	= "</li>";
			$this->pagination->initialize($config);
			$data['link'] = $this->pagination->create_links();
			//載入view
			$this->load->view('home',$title);
			$this->load->view('searchproduct');
			$this->load->view('title_2',$data);
			$this->load->view('footer');
		}
		public function Searchproduct(){
			//搜尋商品
			$product = $this->input->post('product');
			if($product !== ""){
			$this->search_PDresults($product);
			}else{
				$title = array('title' =>"搜尋商品");
				$data  = array('stat'=>'<div class="alert alert-danger"><strong>請輸入要尋找的關鍵字!!!</strong></div>');
				$this->load->view('home',$title);
				$this->load->view('title_2',$data);
				$this->load->view('footer');
			}
		}
		public function search_PDresults($product){
			//搜尋到的商品結合分頁
			$product = urldecode($product);
			$title 	 = array('title' =>"搜尋商品");
			$this->load->helper('url');
			$this->load->library('pagination');
			$this->load->model('Db_model','product');
			//前往數據庫GetNews
			$query = $this->product->GetProductRows($product);
			//每頁顯示的數據
			$page_size  = 5;
			//取到的所有數據
			$total_rows = intval($query);
			if($total_rows>0){
			//定義參數頁面
			$page = intval($this->uri->segment(4));
			//將上面取出的$page,$page_size傳到printNews方法
			$data['list'] 				= $this->product->GetProduct($product,$page,$page_size);
			$config['base_url'] 		= site_url("Edit/search_PDresults/").$product;
			$config['per_page'] 		= $page_size;
			$config['total_rows'] 		= $total_rows;
			$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
			$config['full_tag_close'] 	= "</ul>";
			$config['num_tag_open'] 	= '<li>';
			$config['num_tag_close'] 	= '</li>';
			$config['cur_tag_open'] 	= "<li class='disabled'><li class='active'><a href='#'>";
			$config['cur_tag_close'] 	= "<span class='sr-only'></span></a></li>";
			$config['next_tag_open'] 	= "<li>";
			$config['next_tagl_close'] 	= "</li>";
			$config['prev_tag_open'] 	= "<li>";
			$config['prev_tagl_close'] 	= "</li>";
			$config['first_tag_open'] 	= "<li>";
			$config['first_tagl_close'] = "</li>";
			$config['last_tag_open'] 	= "<li>";
			$config['last_tagl_close'] 	= "</li>";
			$this->pagination->initialize($config);
			//載入home,將標題$title丟過去
			$this->load->view('home',$title);
			//載入search
			$this->load->view('searchproduct');
			$data['link'] = $this->pagination->create_links();
			$this->load->view('title_2',$data);
			$this->load->view('footer');
			}
			else{
				$this->load->view('home',$title);
				$data = array('stat'=>'<div class="alert alert-danger"><strong>沒有找到相關資訊!!!</strong></div>');
				$this->load->view('title_2',$data);
				$this->load->view('footer');
			}
		}
		public function setproduct(){
			//新增商品頁面
			$title = array('title' =>'新增商品');
			$this->load->view('home',$title);
			$this->load->view('postproduct');
			$this->load->view('footer');
		}

		public function Postproduct(){
			//新增商品
			$product['name'] = $this->input->post('name');
			$product['content'] = $this->input->post('content');
			$product['type'] = $this->input->post('type');
			$product['price'] = $this->input->post('price');
			$post 	 = true;
			$this->load->view('home');
			if($_FILES && $product['name'] !="" && $product['content'] !="" && !empty($product['type']) && $product['price'] !=""){
				$temp = explode(".", $_FILES["pic"]["name"]);
				$extension = end($temp);
				$url = md5(uniqid($_FILES['pic']['name'])).'.'.$extension;
				$picture = './uploads/'.$url;
				$picture_tmp = $_FILES['pic']['tmp_name'];
				move_uploaded_file($picture_tmp, $picture);
				$this->load->model('Db_model','product');
				$product['pic'] = $url;
				$data['list'] = $this->product->Postproduct($product);
				if($data){
				$data = array('stat'=>'<div class="alert alert-info"><strong>新增成功!!!</strong></div>');
				$this->load->view('backproduct',$data);
				$post = false;
				}else{
					$data = array('stat'=>'<div class="alert alert-danger"><strong>請重新編輯，內容不得為空!!!</strong></div>');
					$this->load->view('backproduct',$data);
				}
			}
			$this->load->view('footer');
		}
		public function catchproduct(){
			//編輯商品按鈕
			$title = array('title' =>"編輯商品",'name'=>'title_1');
			$id    = $this->uri ->segment(3);
			$this->load->view('home',$title);

			if(!empty($id)){
				$this->load->model('Db_model','product');
				$data['list'] = $this->product->catchproduct($id);
				$this->load->view('reproduct',$data);
			}
				$this->load->view('footer');
		}
		public function Delproduct(){
			//刪除商品
			$id    = $this->uri ->segment(3);
			$title = array('title' =>"刪除成功",'name'=>'title_1');
			$this->load->view('home',$title);
			$this->load->view('searchproduct');
			if(!empty($id)){
				$this->load->model('Db_model','product');
				$data = $this->product->Delproduct($id);
				if($data){
					$msg = array('stat'=>'<div class="alert alert-danger"><strong>商品刪除成功!!!</strong></div>');
					$this->load->view('title_2',$msg);
				}
			}
			$this->load->view('footer');
		}
		public function upload(){
			//編輯商品功能
            $config  = './uploads/';
            /*$config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 10000;
			$config['file_name'] = uniqid();
			$this->load->library('upload',$config);
			//$this->upload->do_upload('pic');
			//$data =$this->upload->data();*/
				$product['id'] = $this->uri ->segment(3);
				$product['name'] = $this->input->post('name');
				$product['content'] = $this->input->post('content');
				$product['type'] = $this->input->post('type');
				$product['price'] = $this->input->post('price');
				$this->load->view('home');
			if($_FILES && $product['name'] !="" && $product['content'] !="" && !empty($product['type']) && $product['price'] !=""){
				$temp = explode(".", $_FILES["pic"]["name"]);
				$extension = end($temp);
				$url = md5(uniqid($_FILES['pic']['name'])).'.'.$extension;
				$picture = $config.$url;
				$picture_tmp = $_FILES['pic']['tmp_name'];
				move_uploaded_file($picture_tmp, $picture);
				$this->load->model('Db_model','product');
				$product['pic'] = $url;
				$file = $this->product->deletefile($product);
				$path ='/uploads/'.$file['0']->pic;

				/*$this->load->library ('ftp');
				$setting['hostname'] = '192.168.86.128' ; 
				$setting['username'] = 'root' ; 
				$setting['password'] = '123456' ; 
				$setting['debug']    = TRUE ;
				$this->ftp->connect($setting);
				$this->ftp->delete_file($path);*/

				$data['list'] = $this->product->changeproduct($product);
				if($data){
					$data = array('stat'=>'<div class="alert alert-info"><strong>更新成功!!!</strong></div>');
					$this->load->view('backproduct',$data);
					$repost = false;
				}else{
					$data = array('stat'=>'<div class="alert alert-danger"><strong>更新失敗!!!</strong></div>');
					$this->load->view('backproduct',$data);
				}
			}else{
					$data = array('stat'=>'<div class="alert alert-danger"><strong>內容不得為空!!</strong></div>');
					$this->load->view('backproduct',$data);
			}
			$this->load->view('footer');
		}
}
?>