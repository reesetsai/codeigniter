<div class="col-md-12">
	<form class="form-horizontal" role="form" action ="<?php echo site_url('Edit/Postproduct'); ?>" method="post" enctype = "multipart/form-data">
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">標題</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" name ="name" placeholder='請輸入商品標題'>
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">內容</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="8" placeholder='商品簡介' name ="content"></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="video_url" class="col-sm-2 control-label">分類</label>
			<div class="col-sm-10">
		    <label class="radio-inline">
		      <input type="radio" name="type" value="movie">電影
		    </label>
		    <label class="radio-inline">
		      <input type="radio" name="type" value="series">電視劇
		    </label>
		    <label class="radio-inline">
		      <input type="radio" name="type" value="noval">小說
		    </label>
		    <label class="radio-inline">
		      <input type="radio" name="type" value="music">音樂
		    </label>
		    </div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">價格</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="price" name ="price" placeholder='請輸入金額'>
			</div>
		</div>
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">商品圖片</label>
			<div class="col-sm-10">
				<input type="file" class="form-control" id="pic" name ="pic">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">新增</button><button type="reset" class="btn btn-default">取消</button>
			</div>
		</div>
	</form>
	<div class="col-sm-offset-11 col-sm-10">
		<a href="<?php echo site_url('Edit/GetAllProduct');?>"><button class="btn btn-default">回前頁</button></a>
	</div>
</div>