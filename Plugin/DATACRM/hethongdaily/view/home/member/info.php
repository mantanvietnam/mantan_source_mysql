<?php 
if($info->display_info == 1){
   include('themeinfo/theme1.php');
}elseif($info->display_info == 2){
   include('themeinfo/theme2/main.php');
}elseif($info->display_info == 3){
   include('themeinfo/theme3/main.php');
}
?>