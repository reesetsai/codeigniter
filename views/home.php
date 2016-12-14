<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/css/bootstrapValidator.css"/>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/examples/offcanvas/offcanvas.js"></script>
    <link href='<?php echo base_url(); ?>application/views/css/all.css' rel="stylesheet">
	<title>管理頁面</title>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href='<?php echo site_url('Login/introduce'); ?>'>後台管理</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href='<?php echo site_url('Edit/newspage'); ?>'>公告編輯</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">購物車編輯<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href='<?php echo site_url('/Edit/GetAllProduct/'); ?>'>商品編輯</a></li>
            <li><a href='<?php echo site_url('/Edit/GetAllProduct/'); ?>'>訂單查詢</a></li>
          </ul>
        </li>
        <li><a href='<?php echo site_url('Login/ManagerUser'); ?>'>帳號管理</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
        	<a href="#"><span class="glyphicon glyphicon-user"></span>
        		<?php if(isset($this->session->userdata('login')['user'])){ echo 'Hello'.' '.$this->session->userdata('login')['user'];}?>
        	</a>
        </li>
        <li><a href='<?php echo site_url();?>/Login/logout'><span class="glyphicon glyphicon-log-in"></span>登出</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container col-md-12">
<?php if(!empty($title)){ ?>
  <h3><?php echo $title; ?></h3>
<?php }else{ $title == ""; } ?>