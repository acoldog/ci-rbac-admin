<?php 

$rand1 = uniqid();

echo <<<HTML
<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div class="accordion" id="accordion-{$rand1}">

HTML;

foreach($menu as $mn){
	if(@$mn["shown"]){
		$rand2 = uniqid();

		$menu_one_list = '';
		$open_sign = '';
		
		$menu_one_list .= '<div class="accordion-group">';
		$menu_one_list .= '		<div class="accordion-heading">';
			if($mn["self"]["uri"]=="/"){
				$flist = '<a class="list-group-item active accordion-toggle" data-toggle="collapse" data-parent="#accordion-'. $rand1 .'" href="#accordion-element-'. $rand2 .'"><span class="glyphicon glyphicon-align-left"></span> '.$mn["self"]["title"] .'{menu-direction-ico}</a>';
			}else{
				$flist = '<a class="list-group-item accordion-toggle" data-toggle="collapse" data-parent="#accordion-'. $rand1 .'"  href="'. $mn["self"]["uri"] .'#accordion-element-'. $rand2 .'">'. $mn["self"]["title"] .'</a>';
			}
		$menu_one_list .= $flist;
		$menu_one_list .= '		</div>';

		if(isset($mn["child"])){

			$menu_one_list .= '<div id="accordion-element-'. $rand2 .'" class="accordion-body {in} collapse">';

			foreach($mn["child"] as $cmn){
				$menu_one_list .= '<div class="accordion-inner">';

				//选中二级菜单变底色 	acol 2016-08-27 11:54:44
				$active_class = '';
				if(isset($this->get_menu['list'][$this->uuri]) && $this->get_menu['list'][$this->uuri] == $cmn["self"]["title"]){
					$active_class = ' selected';
					$open_sign = 'in';
				}

				if(@$cmn["shown"]){
					if($cmn["self"]["uri"]=="/"){
						$slist =  "<a class='list-group-item'>&nbsp;&nbsp;&nbsp;&nbsp;<span class='glyphicon glyphicon-align-left'></span> ".$cmn["self"]["title"]."</a>";
					}else{
						$slist = anchor($cmn["self"]["uri"],'&nbsp;&nbsp;&nbsp;&nbsp;'.$cmn["self"]["title"], array('class' => 'list-group-item'. $active_class));
					}
					$menu_one_list .= $slist;

					if(isset($cmn["child"])){
						foreach($cmn["child"] as $gcmn){
							if(@$gcmn["shown"]){

								//选中三级菜单变底色 	acol 2016-08-27 11:54:46
								$active_class = '';
								if(isset($this->get_menu['list'][$this->uuri]) && $this->get_menu['list'][$this->uuri] == $gcmn["self"]["title"]){
									$active_class = ' selected';
									$open_sign = 'in';
								}

								$tlist = anchor($gcmn["self"]["uri"],"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$gcmn["self"]["title"], array('class' => 'list-group-item'. $active_class));
							}
							$menu_one_list .= $tlist;
						}
					}
				}
				
				$menu_one_list .= '</div>';   //accordion-inner
			}
			$menu_one_list .= '</div>';		//accordion-body

		}
				
		$menu_one_list .= '</div>';		//accordion-group

		//是否有正在打开的菜单项
		$menu_one_list = str_replace('{in}', $open_sign, $menu_one_list);

		if ($open_sign == '') {
			$menu_ico = '<span class="glyphicon glyphicon-chevron-right pull-right"></span>';
		}else{
			$menu_ico = '<span class="glyphicon glyphicon-chevron-down pull-right"></span>';
		}

		echo str_replace('{menu-direction-ico}', $menu_ico, $menu_one_list);
	}
}

echo <<<HTML

			</div>
		</div>
	</div>
</div>

HTML;
