<?php global $session;?>
<?php if(empty($session->read('infoUser'))){ ?>
<div class="menu-bottom">
	<div class="menu">
		<div class="menu-home">
			<a href="javascript:void(0);" onclick="backToHome();"><img src="<?php echo $urlThemeActive;?>images/menu-1.png" class="img-fluid" alt=""></a>
		</div>
		<ul>
			<li><a href=""><img src="<?php echo $urlThemeActive;?>images/menu-2.png" class="img-fluid" alt=""></a></li>
			
			<li onclick="loadDataUrl('/login','.box-account');">
				<a href="javascript:void(0)">
					<img src="<?php echo $urlThemeActive;?>images/menu-3.png" class="img-fluid" alt="">
				</a>
			</li>
			
			<li onclick="loadDataUrl('/login','.box-account');">
				<a href="javascript:void(0);">
					<img src="<?php echo $urlThemeActive;?>images/menu-4.png" class="img-fluid" alt="">
				</a>
			</li>
		</ul>
	</div>
</div> 
<?php }else{ ?>
<div class="menu-bottom">
	<div class="menu">
		<div class="menu-home">
			<a href="javascript:void(0);" onclick="backToHome();"><img src="<?php echo $urlThemeActive;?>images/menu-1.png" class="img-fluid" alt=""></a>
		</div>
		<ul>
			<li><a href=""><img src="<?php echo $urlThemeActive;?>images/menu-2.png" class="img-fluid" alt=""></a></li>
			
			<li onclick="loadDataUrl('/account','.box-money');">
				<a href="javascript:void(0)">
					<img src="<?php echo $urlThemeActive;?>images/menu-3.png" class="img-fluid" alt="">
				</a>
			</li>
			
			<li onclick="loadDataUrl('/account','.box-money');">
				<a href="javascript:void(0);">
					<img src="<?php echo $urlThemeActive;?>images/menu-4.png" class="img-fluid" alt="">
				</a>
			</li>
		</ul>
	</div>
</div> 
<?php }?>