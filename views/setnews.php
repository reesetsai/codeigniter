<div class="col-md-12">
	<form class="form-horizontal" role="form" action ="<?php echo site_url(); ?>/Edit/postnews/" method="post" >
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">標題</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" name ="name"
					   placeholder='請輸入發表的文章標題'>
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">內容</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="8" placeholder='請輸入發表的文章內容' name ="content"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="video_url" class="col-sm-2 control-label">影片連結</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="video_url" placeholder='輸入相關影片連結' name ="video_url">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">新增</button><button type="reset" class="btn btn-default">取消</button>
			</div>
		</div>
	</form>
	<div class="col-sm-offset-11 col-sm-10">
		<a href="<?php echo site_url();?>/Login/getMyPageTitle/title_1"><button class="btn btn-default">回前頁</button></a>
	</div>
</div>