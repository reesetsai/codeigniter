<div class="col-md-11">
	<form class="form-horizontal" role="form" action ="<?php echo site_url('Edit/ed_news/'); ?>/<?php echo $list['0']->id; ?>" method="post" >
		<div class="form-group">
			<label for="title" class="col-sm-2 control-label">標題</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="title" name ="name"
					   value='<?php echo $list['0']->name; ?>'>
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-sm-2 control-label">內容</label>
			<div class="col-sm-10">
				<textarea class="form-control" rows="8" name ="content"><?php echo $list['0']->content; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="video_url" class="col-sm-2 control-label">影片連結</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" id="video_url" value='<?php echo $list['0']->video_url; ?>' name ="video_url">
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">確認修改</button><button type="reset" class="btn btn-default">取消</button>
			</div>
		</div>
	</form>
	<div class="col-sm-offset-11 col-sm-10">
		<a href="<?php echo site_url('Edit/newspage');?>"><button class="btn btn-default">回前頁</button></a>
	</div>
</div>