<?php 
global $infoUser;
$avatar = (!empty($infoUser->avatar))?$infoUser->avatar:'https://ezpics.vn/plugins/ezpics/view/home/img/avatar.png';
?>
<div class="menu-head">
	<div class="container">
		<div class="content-menu">
			<div class="left">
				<div class="avarta-user"><img src="<?php echo $avatar;?>" class="img-fluid w-100" alt=""></div>
				<div class="back-home clc-back"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/arrow-black.png" class="img-fluid" alt=""></a></div>
				<div class="back-data clc-back"><a href="javascript:void(0)"><img src="<?php echo $urlThemeActive;?>images/arrow-black.png" class="img-fluid" alt=""></a></div>
			</div>
			<div class="right">
				<div class="box-search">
					<input type="text" placeholder="Tìm kiếm mẫu thiết kế ..." class="txt_srearch">
					<button type="submit" class="btn_search"><img src="<?php echo $urlThemeActive;?>images/search.png" class="img-fluid" alt=""></button>
				</div>
			</div>
		</div>
	</div>
</div>