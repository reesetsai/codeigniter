<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	public function index(){
		//include 'index.php'
		$this->load->view('index');
	}
	public function welcome(){
		//登入後的首頁
		if($this->session->userdata('login')){
		$title = array('title' => '後台管理','name'=>'title');
		$this->load->view('home',$title);
		$this->load->view('footer');
		}
	}
	public function validate(){
		//open url物件, 使用post
		$this->load->helper('url');
		//將DB_model 用user代替
		$this->load->model('Db_model','user');
		//open Model getuser function 將結果賦給$row
		$row = $this->user->getuser();
		//把結果取出給$rows
		$rows = $row->row();
			if($row->num_rows()== 1 ){
			//把user賦值 $user = array('id'=>$rows->id,'user'=>$this->input->post('user'),'user_password'=>$this->input->post('user_password'))
				$user['id'] = $rows->id; 
				$user['user'] =$this->input->post('user');
				$user['user_password'] =$this->input->post('user_password');
				//設置session
				$this->session->set_userdata('login',$user);
				//轉往function welcome
				redirect('/login/welcome');
			}else{
				//帳號密碼不正確跳回輸入頁
				$this->index();
			}
	}
	public function logout(){
		//登出
		//open oop helper('url')
		$this->load->helper('url');
		//destroy session
		$this->session->unset_userdata('user');
		//to index.php
		$this->load->view('index');
	}
	public function introduce(){
		//後台簡介
		$title = array('title' =>'');
		$this->load->view('home',$title);
		$this->load->view('intro');
		$this->load->view('footer');
	}
	public function ManagerUser(){
		//管理帳號頁面
		//設置換頁標題
			$title = array('title' =>"帳號管理",'name'=>'title_5');
		//若標題為title5
			$this->load->view('home',$title);
			$this->load->model('Db_model','user');
			$res =$this->user->getuser();
			$this->load->view('title_5');
			$this->load->view('footer');
	}

	public function ChangeUser(){
		//編輯管理帳號功能
		$this->load->helper('url');
		$user_password =$this->input->post('user_password');
		$ck_password   =$this->input->post('ck_password');
		$success = array('stat' => '<div class="alert alert-info"><strong>更新成功</strong></div>');
		$fail =	array('stat'=>'<div class="alert alert-info"><strong>密碼不得為空 or 密碼不正確!!!</strong></div>');
		$con_fail = array('stat'=>'<div class="alert alert-info"><strong>更新失敗!!!</strong></div>');
		$title = array('title' =>'帳號管理');
		$this->load->view('home',$title);
		if(!empty($user_password) && !empty($ck_password) && $user_password == $ck_password){
			$this->load->model('Db_model','user');
			$this->user->ChangeUserData();
			if($this->user->ChangeUserData()){
				$this->load->view('title_5',$success);
			}else{
				$this->load->view('title_5',$con_fail);
			}
		}else{
			$this->load->view('title_5',$fail);
		}
		$this->load->view('footer');
	}
}