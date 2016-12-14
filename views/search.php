<div class="col-md-12">
	<div class="col-md-10">
		<form class="form-inline" action ="<?php echo site_url('Edit/searchnews'); ?>" method="post">	
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search" name="keyword">
			</div>
			<button type="submit" class="btn btn-default">搜尋</button>
		</form>
	</div>
	<ul class="col-md-2">
		<a href="<?php echo site_url();?>/Edit/setnews"><button class="btn btn-default">新增文章</button></a>
     </ul>
</div>