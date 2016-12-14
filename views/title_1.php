<div class="col-md-12">
		<table class='table table-hover table-responsive table-bordered'>
			<tr>
				<th class='textAlignLeft'>消息名稱</th>
				<th>內容</th>
				<th>編輯/刪除</th>
			</tr>
			<?php if(!empty($stat)){
			    	echo $stat;
			    	}
			    	else{
			    		$stat ="";
			    	} 
			?>
			<?php if(!empty($list)){ foreach($list as $news_item): ?>
			<tr>
				<td class="col-md-3"><?php echo $news_item->name; ?></td>
				<td class="col-md-7"><?php $word = $news_item->content;
				echo substr($word,0, 150); ?></td>
				<td class="col-md-2">
					<a href='<?php echo site_url('Edit/catch_news'); ?>/<?php echo $news_item->id;?>' class='btn btn-success'><span class='glyphicon glyphicon-remove'></span>編輯</a>
					<a href='<?php echo site_url('Edit/del_news'); ?>/<?php echo $news_item->id;?>' class='btn btn-danger'><span class='glyphicon glyphicon-remove'></span>刪除</a>
				</td>
			</tr>
			<?php  endforeach; }?>
		</table>
		<div class="col-sm-offset-5">
		<?php if(!empty($link)){ echo $link; }?>
		</div>
</div>