
<?php 
if($info->display_info == 1){
   include('themeinfo/theme1.php');
}elseif($info->display_info == 2){
   include('themeinfo/theme2/main.php');
}elseif($info->display_info == 3){
   include('themeinfo/theme3/main.php');
}elseif($info->display_info == 4){
   include('themeinfo/theme4/index.php');
}elseif($info->display_info == 5){
   include('themeinfo/theme5/index.php');
}elseif($info->display_info == 6){
   include('themeinfo/theme6/index.php');
}elseif($info->display_info == 7){
   include('themeinfo/theme7/index.php');
}elseif($info->display_info == 8){
   include('themeinfo/theme8/index.php');
}elseif($info->display_info == 9){
   include('themeinfo/theme9/index.php');
}
?>