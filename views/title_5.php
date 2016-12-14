<div class="col-md-10">
	<form class="form-horizontal" action ="<?php echo site_url(); ?>/Login/ChangeUser" method="post" id = "login">
		<div class="form-group">
			<label class="col-sm-offset-2 control-label col-sm-2">帳號: </label>
				<div class="col-sm-4">
					<p class="form-control-static"><?php echo $this->session->userdata('login')['user']; ?></p>
      			</div>
    	</div>
		<div class="form-group">
			<label class="col-sm-offset-2 control-label col-sm-2">修改密碼:</label>
				<div class="col-sm-4">
					<input class="form-control" id="user_password" type="password" name="user_password">
      			</div>
    	</div>
		<div class="form-group">
			<label class="col-sm-offset-2 control-label col-sm-2">再次確認密碼:</label>
				<div class="col-sm-4">
					<input class="form-control" id="ck_password" type="password" name="ck_password">
      			</div>
    	</div>
	    	<div class="form-group">  
	    		<div class="col-sm-offset-6 col-sm-2">
					<button type="submit" class="btn btn-default">送出</button> <button type="reset" class="btn btn-default">重新輸入</button>
				</div>
			</div>
    </form>
    <?php if(!empty($stat)){
    	echo $stat;
    	}else{
    		$stat ="";
    	}
    	; ?>
</div>

