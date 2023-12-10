<?php global $settingThemes;?>
<footer>
	<div class="content-footer">
		<div class="logo-foter">
			<div class="logo"><img src="<?php echo $urlThemeActive;?>/images/logo-footer.svg" class="img-fluid" alt=""></div>
			<div class="txt-logo">
				<h4><?php echo @$settingThemes['company_name'];?></h4>
				<ul>
					<li>Địa chỉ : <?php echo @$contactSite['address'];?></li>
					<li>Điện thoại:  <?php echo @$contactSite['phone'];?></li>
					<li>Email:<?php echo @$contactSite['email'];?></li>
				</ul>
			</div>
		</div>
		<div class="social">
			<ul>
				<li><a href="<?php echo @$settingThemes['facebook'];?>"><img src="<?php echo $urlThemeActive;?>/images/sc-2.svg" class="img-fluid" alt=""></a></li>
				<li><a href="<?php echo @$settingThemes['instagram'];?>"><img src="<?php echo $urlThemeActive;?>/images/INS.png" class="img-fluid" alt=""></a></li>
				<li><a href="<?php echo @$settingThemes['youtube'];?>"><img src="<?php echo $urlThemeActive;?>/images/sc-1.svg" class="img-fluid" alt=""></a></li>
				<li><a href="<?php echo @$settingThemes['telegram'];?>"><img src="<?php echo $urlThemeActive;?>/images/Z.png" class="img-fluid" alt=""></a></li>
				<li><a href="<?php echo @$settingThemes['twitter'];?>"><img src="<?php echo $urlThemeActive;?>/images/C.png" class="img-fluid" alt=""></a></li>
			</ul>
		</div>
		<div class="subscribe-fter">
			<div class="support">
				<a href="/contact"></a>
				<div class="icon">
					<svg width="19" height="24" viewBox="0 0 19 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M13.7996 4.96973C13.7996 4.59973 13.7996 4.29996 13.7996 4.20996C13.7996 2.63996 12.7295 0 9.43945 0H9.27954C5.71954 0 4.90942 2.69996 4.90942 4.20996C4.90942 4.30996 4.90942 4.59973 4.90942 4.96973C4.55942 4.96973 4.26953 5.25986 4.26953 5.60986V7.18994C4.26953 7.53994 4.54942 7.83008 4.90942 7.83008C4.91942 7.83008 4.92945 7.83008 4.93945 7.83008C5.19945 10.1101 7.83954 12.6899 9.27954 12.6899H9.43945C10.9195 12.6899 13.5195 10.1201 13.7795 7.83008C13.7895 7.83008 13.7993 7.83008 13.8093 7.83008C14.1593 7.83008 14.4495 7.54994 14.4495 7.18994V5.60986C14.4395 5.25986 14.1496 4.96973 13.7996 4.96973Z" fill="white"/>
						<path d="M5.01123 13.8599C2.31123 13.8599 0.121094 16.05 0.121094 18.75V23.7598H9.47119L5.16113 13.8501H5.01123V13.8599Z" fill="white"/>
						<path d="M13.9326 13.8599H13.5127L9.47266 23.77H18.8225V18.7598C18.8225 16.0498 16.6326 13.8599 13.9326 13.8599Z" fill="white"/>
						<path d="M9.35938 14.3999L6.85938 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
						<path d="M9.35938 14.3999L11.8594 12.9697V15.7598L9.35938 14.3999Z" fill="white"/>
						<path d="M10.1504 14.3999C10.1504 14.8399 9.79035 15.1899 9.36035 15.1899C8.92035 15.1899 8.57031 14.8399 8.57031 14.3999C8.57031 13.9599 8.92035 13.6099 9.36035 13.6099C9.79035 13.6099 10.1504 13.9599 10.1504 14.3999Z" fill="white"/>
					</svg>
				</div>
				<span>Hỗ trợ</span>
			</div>
			<div class="content-subscribe">
				<div class="head-sub">
					<h4>ĐĂNG KÝ NHẬN EMAIL TỪ CHÚNG TÔI</h4>
					<div class="icon"><img src="<?php echo $urlThemeActive;?>/images/subscribe.svg" class="img-fluid" alt=""></div>
				</div>
				<div class="sub-form">
					<form action="">
						<input type="text" class="txt_field" value="" placeholder="Entering email here">
						<input type="submit" value="Subscribe" class="btn_field">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright text-center">
		<div class="container">
			<p>Copyright © 2023 GÔDRAW. All rights reserved.</p>
		</div>
	</div>
</footer>

<?php 
    if(empty($isCssHome)){
        echo     
        '<script type="text/javascript" src="'.$urlThemeActive.'/js/private.js"></script>';
    }
	else{
		echo 
		'<script type="text/javascript" src="'.$urlThemeActive.'/js/private2.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/4.0.20/fullpage.min.js" integrity="sha512-LGiXf+jHGTHcIybSsOWO3I/in+OObCkcEsWIZ7IyhzfD6RzD5qDUw2CK+JveuI7zTSEcDG//bIOvOpAJW2BWsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
	}
?> 

<script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/lib/slick.min.js"></script> 
<!-- <script type="text/javascript" src="<?php echo $urlThemeActive;?>/js/private.js"></script> -->
</body>
</html>