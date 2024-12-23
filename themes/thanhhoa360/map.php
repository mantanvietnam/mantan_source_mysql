<?php
getFileTheme('header_tayho.php');
global $urlThemeActive;

?>

 <div id="map-home" class="map-home-page">
            <div class="event-home-title">
                <p>Bản đồ 360</p>
                <div class="article-space"></div>
            </div>
           
            <?php include("findnear_openstreet_map.php"); ?>
        </div>
<?php getFileTheme('footer_tayho.php');?>