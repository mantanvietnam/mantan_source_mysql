<?php getHeader();global $settingThemes;?>
<style>
    footer, header {
        display: none;
    }
</style>
<main class="main-cover">
    <section class="box-banner-home avarta-intro">
        <div class="logo text-center">
            <a href="/home">
                <img src="<?php echo $urlThemeActive;?>/images/logo-trailer.png" class="img-fluid" alt="">
            </a>
        </div>
        <div class="video-banner">
            <img src="<?php echo $urlThemeActive;?>/images/cover.jpg" class="img-fluid w-100">
        </div>
        <div class="wrapper-intro">
            <div class="content-intro">
                <div class="close-intro">
                    <a href="/home">
                        <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M38.5376 35.3669L3.50781 0.337158L0.339975 3.505L35.3697 38.5348L38.5376 35.3669Z" fill="white"/>
                            <path d="M3.54446 38.5544L38.5742 3.52466L35.4064 0.356821L0.376621 35.3866L3.54446 38.5544Z" fill="white"/>
                        </svg>
                    </a>
                </div>
                <video loop="loop" autoplay="autoplay" muted="" defaultmuted="" playsinline="" oncontextmenu="return false;" preload="auto">
                    <source src="<?php echo @$settingThemes['video_trailer'];?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
                <div class="social-intro">
                    <ul>
                        <li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-1.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="<?php echo @$settingThemes['facebook'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-2.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="<?php echo @$settingThemes['tiktok'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-3.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="<?php echo @$settingThemes['twitter'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-4.svg" class="img-fluid" alt=""></a></li>
                        <li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/sc-5.svg" class="img-fluid" alt=""></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="btn-main text-center text-uppercase"><a href="">THƯ VIỆN ẢNH</a></div>
    </section>
</main>
<?php getFooter();?>