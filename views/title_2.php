<div class="col-md-12">
		<table class='table table-hover table-responsive table-bordered'>
			<tr>
				<th class='textAlignLeft'>圖片</th>
				<th>標題</th>
				<th>內容</th>
				<th>編輯/刪除</th>
			</tr>
			<tr>
			<?php if(!empty($stat)){
			    	echo $stat;
			    	}
			    	else{
			    		$stat ="";
			    	} 
			?>
			</tr>
	<?php	if(!empty($list)) { foreach ($list as $item): ?>
			<tr>
				<td class="col-md-2">
					<?php if(!empty($item->pic)): ?>
						<img src= '<?php echo base_url(); ?>/uploads/<?php echo $item->pic;?>' class ="pic">
					<?php endif; ?>
				</td>
				<td class="col-md-3"><?php echo $item->name; ?></td>
				<td class="col-md-4"><?php $word = $item->content;	echo substr($word,0, 120); ?></td>
				<td class="col-md-1">
					<a href='<?php echo site_url(); ?>/Edit/catchproduct/<?php echo $item->id;?>' class='btn btn-success'><span class='glyphicon glyphicon-remove'></span>編輯</a>
					<a href='<?php echo site_url(); ?>/Edit/Delproduct/<?php echo $item->id;?>' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span>刪除</a>
				</td>
			</tr>
			<?php  endforeach; }?>
		</table>
		<div class="col-sm-offset-5">
			<?php if(!empty($link)){ echo $link; }?>
		</div>
</div>