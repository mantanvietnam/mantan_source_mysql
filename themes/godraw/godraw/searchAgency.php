<a target="_blank" href="https://www.google.com/maps/dir/?api=1&destination='.$value->lat_gps.','.$value->long_gps.'"><?php getHeader();global $settingThemes;?>

<style>
	footer {
		display: none;
	}
</style>
<main>
    <div class="social-home">
        <ul>
            <li><a href="<?php echo @$settingThemes['facebook'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/facebook.png" class="img-fluid btn-effect" alt=""></a></li>

            <li><a href="<?php echo @$settingThemes['youtube'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/youtube.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['telegram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/telegram.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['instagram'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/instagram.png" class="img-fluid btn-effect" alt=""></a></li>
            
            <li><a href="<?php echo @$settingThemes['twitter'];?>" target="_blank"><img src="<?php echo $urlThemeActive;?>/images/twitter.png" class="img-fluid btn-effect" alt=""></a></li>
        </ul>
    </div>

    <div class="full-home-slider" id="slide-home-shop">
        
        <!-- Danh sách đại lý -->
        <div class="item-slide">
            <section class="box-maps">
                <div class="container">
                    <div class="title text-center mb-0">
                        <span>ĐỊA ĐIỂM CÓ DỊCH VỤ VẼ GÔ DRAW</span>
                    </div>
                    <div class="">
                        <form action="" method="get">
                            <div class="row box-search-agency">
                            
                                <div class="col-md-2">
                                    <p>Tìm điểm vẽ</p>
                                    <input placeholder="Nhập điểm vẽ ..." type="text" name="name_agency" value="<?php echo @$_GET['name_agency'];?>" class="form-control">
                                </div>    
                                <div class="col-md-2">
                                    <p>Tỉnh thành</p>
                                    <select name="province_id" id="province_id" class="form-control" onchange="selectCity();">
                                        <option value="">Chọn tỉnh thành</option>
                                        <?php 
                                        if(!empty($listCity)){
                                            foreach ($listCity as $key => $value) {
                                                if(empty($_GET['province_id']) || $_GET['province_id']!=$value->province_id){
                                                    echo '<option value="'.$value->province_id.'">'.$value->name.'</option>';
                                                }else{
                                                    echo '<option selected value="'.$value->province_id.'">'.$value->name.'</option>';
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>    
                                <div class="col-md-3">
                                    <p>Quận huyện</p>
                                    <select name="district_id" id="district_id" class="form-control" onchange="selectDistrict();">
                                        <option value="">Chọn quận huyện</option>
                                    </select>
                                </div>    
                                <div class="col-md-3">
                                    <p>Xã phường</p>
                                    <select name="ward_id" id="ward_id" class="form-control">
                                        <option value="">Chọn xã phường</option>
                                    </select>
                                </div> 


                                <div class="col-md-2">
                                    <p>&nbsp;</p>
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>    
                            
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="content-maps-left">
                                   
                                    <div class="list-showroom">
                                        <?php 
                                        if(!empty($listAgency)){
                                            foreach ($listAgency as $key => $value) {
                                                echo '<div class="item-showroom">
                                                        <div class="avr"><img src="'.@$value->image.'" class="img-fluid w-100" alt=""></div>
                                                        <div class="info">
                                                            <h3>
                                                                <a target="_blank" href="/store/?id='.$value->id.'">'.@$value->name.'</a>
                                                            </h3>
                                                            <ul>
                                                                <li>'.@$value->address.'</li>
                                                                <li>'.@$value->phone.'</li>
                                                                <li>'.@$value->email.'</li>
                                                            </ul>
                                                        </div>
                                                    </div>';
                                            }
                                        }else{
                                            echo 'Không tìm được đại lý';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="avr-maps">
                                    <?php include(__DIR__.'/findnear_openstreet_map.php');?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div> 
    </div>
</main>

<script type="text/javascript">
    var district_id = "<?php echo @$_GET['district_id'];?>";
    var ward_id = "<?php echo @$_GET['ward_id'];?>";
    
    function selectDistrict()
    {
        var district_select = $('#district_id').val();

        var ward_option = '<option value="">Chọn xã phường</option>';
        var i;

        if(district_select != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getWardAPI",
              data: { district_id: district_select }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        if(msg[i].wards_id != ward_id){
                            ward_option += '<option value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }else{
                            ward_option += '<option selected value="'+msg[i].wards_id+'">'+msg[i].name+'</option>';
                        }
                    }
                }

                $('#ward_id').html(ward_option);
            });
        }else{
            $('#ward_id').html(ward_option);
        }
    }
    
    function selectCity()
    {
        var province_id = $('#province_id').val();
        var district_option = '<option value="">Chọn quận huyện</option>';
        var i;

        if(province_id != ""){
            $.ajax({
              method: "POST",
              url: "/apis/getDistrictAPI",
              data: { province_id: province_id }
            })
            .done(function( msg ) {
                if(msg.length>0){
                    for(i=0;i<msg.length;i++){
                        if(msg[i].district_id != district_id){
                            district_option += '<option value="'+msg[i].district_id+'">'+msg[i].name+'</option>';
                        }else{
                            district_option += '<option selected value="'+msg[i].district_id+'">'+msg[i].name+'</option>';
                        }
                    }
                }

                $('#district_id').html(district_option);

                selectDistrict();
            });
        }else{
            $('#district_id').html(district_option);

            selectDistrict();
        }
    }

    selectCity();
</script>

<?php getFooter();?>