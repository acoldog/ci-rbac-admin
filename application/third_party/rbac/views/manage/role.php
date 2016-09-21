<style>
.table td:first-child{width:10%}
.table td:nth-child(2){width:20%}
</style>
<table class="table table-bordered well">
	<thead>
          <tr>
            <th>ID</th>
            <th>角色名称</th>
            <th>状态</th>
            <th>操作</th>
          </tr>
        </thead>
   <tbody>
	<?php 
	foreach($data as $mb){
		$control_html = '';
		//不能编辑管理员组	 acol 2016-08-27 11:54:30
		if($mb->id != 1){
			$control_html = '<div class="btn-group  btn-group-xs  pull-right">
						  <a class="btn btn-default btn-xs" href="%s">编辑角色</a>
						  <a class="btn btn-info btn-xs" href="%s">赋权节点</a>
						  <a class="btn btn-danger" href="%s">删除删除</a>
						</div>';
		}

		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>
						'. $control_html .'
					</td>
				</tr>',$mb->id,$mb->rolename,($mb->status==1?"正常":"停用"),site_url("manage/role/edit/".$mb->id),site_url("manage/role/action/".$mb->id),site_url("manage/role/delete/".$mb->id));
	}
	?>
  </tbody>
</table>
<hr/>

<?php echo '<a class="btn btn-success pull-right" href="'.site_url("manage/role/add").'">新增角色</a>'; ?>
<?php echo $this->pagination->create_links(); ?>
