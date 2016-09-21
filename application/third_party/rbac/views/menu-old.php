<?php 
foreach($menu as $mn){
	if(@$mn["shown"]){
		echo '<div class="list-group">';
		if($mn["self"]["uri"]=="/"){
			$flist = "<a class='list-group-item active'><span class='glyphicon glyphicon-align-left'></span> ".$mn["self"]["title"]."</a>";
		}else{
			$flist = anchor($mn["self"]["uri"],$mn["self"]["title"], array('class' => 'list-group-item'));
		}
		echo $flist;
		if(isset($mn["child"])){
			foreach($mn["child"] as $cmn){

				//选中二级菜单变底色 	acol 2016-08-27 11:54:44
				$active_class = '';
				if(isset($this->get_menu['list'][$this->uuri]) && $this->get_menu['list'][$this->uuri] == $cmn["self"]["title"]){
					$active_class = ' selected';
				}
				
				if(@$cmn["shown"]){
					if($cmn["self"]["uri"]=="/"){
						$slist =  "<a class='list-group-item'>&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-align-left'></span> ".$cmn["self"]["title"]."</a>";
					}else{
						$slist = anchor($cmn["self"]["uri"],'&nbsp;&nbsp;&nbsp;&nbsp;'.$cmn["self"]["title"], array('class' => 'list-group-item'. $active_class));
					}
					echo $slist;
					if(isset($cmn["child"])){
						foreach($cmn["child"] as $gcmn){
							if(@$gcmn["shown"]){

								//选中三级菜单变底色 	acol 2016-08-27 11:54:46
								$active_class = '';
								if(isset($this->get_menu['list'][$this->uuri]) && $this->get_menu['list'][$this->uuri] == $gcmn["self"]["title"]){
									$active_class = ' selected';
								}

								$tlist = anchor($gcmn["self"]["uri"],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$gcmn["self"]["title"], array('class' => 'list-group-item'. $active_class));
							}
							echo $tlist;
						}
					}
				}
				
			}
		}
		echo '</div>';
	}
}

?>