<?php
getHeader();
global $urlThemeActive;
global $controller; 
global $modelCategories;
global $modelOptions;

$modelHistoricalSite = $controller->loadModel('HistoricalSites');

$listHistorieAll = $modelHistoricalSite->find()->where()->all()->toList();
$typeHistoricalSites = $modelCategories->find()->where(['type' => 'typeHistoricalSites'])->all()->toList();

?>

 <div id="map-home" class="map-home-page">
            <div class="event-home-title">
                <p>Bản đồ 360</p>
                <div class="article-space"></div>
            </div>
           
            <?php include("findnear_openstreet_map.php"); ?>
        </div>
<?php
getFooter(); ?>