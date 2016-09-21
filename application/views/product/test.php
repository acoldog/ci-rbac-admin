<style>
.table td:first-child{width:10%}
.table td:nth-child(2){width:20%}
</style>
<table class="table  table-bordered well">
	<thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>ico</th>
            <th>descr</th>
            <th>添加者</th>
            <th>创建时间</th>
            <th>操作</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	$i = 0;
	foreach($list as $mb){
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						<div class="btn-group  btn-group-xs">
							<a class="btn btn-success" href="%s">修改</a>
						  	<a class="btn btn-danger" href="%s">删除</a>
						</div>
					</td>
				</tr>',
				$mb->id,
				$mb->username,
				'<img class="modal-pic-'. $i++ .'" onclick="showModalImage(this)" width="50px" height="50px" src="'. $mb->ico .'">',
				$mb->descr,
				$mb->create_user,
				$mb->create_time,
				site_url("product/index/testAdd/".$mb->id),
				site_url("product/index/testDelete/".$mb->id)
			);
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("product/index/testAdd").'">新增关系</a>'; ?>
<?php echo $this->pagination->create_links(); ?>