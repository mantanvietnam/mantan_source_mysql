<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>

<style type="text/css">
  .gm-style-iw-d{
    width: 210px;
  }
  .gm-style-iw-d a{
    font-size: 15px;
    font-weight: 500;
    width: 79px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
  }
  .box-menu-map {
    position: absolute;
    left: 0;
    background-color: #4E9D90;
    padding: 50px 60px;
    width: 350px;
    height:450px;
    z-index: 999;
    border-radius: 0 20px 20px 0;
    /* transition: 1s; */
  }
  #bando .col-md-12 {
    padding: 0;
  }
  .box-menu-map .title-menu-map p {
    font-size: 24px;
    color: #ffffff;
    margin-bottom: 30px;
  }
  .box-menu-map ul {
    color: #ffffff;
  }
  .box-menu-map ul li {
    margin: 15px 0;
  }
  #map_HS {
    height: 100% !important;
  }

  #bando{
    height: 100%
  }

  #bando .row{
    height: 100%
  }

  .iframe-map{
    height: 100%
  }

  .map-filter-close{
    position: absolute;
    left: 36px;
    top: 0;
    z-index: 999;
    width: 30px;
    height: 30px;
    background-color: #6FABA1;

}

.map-filter-close i{
    -moz-transition: all .5s linear;
    -webkit-transition: all .5s linear;
    transition: all .5s linear;
    font-size: 20px;
    color: #fff;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    /* border-radius: 30px; */
}



.map-filter-close .rotate.right{
    -moz-transform:rotate(180deg);
    -webkit-transform:rotate(180deg);
    transform:rotate(180deg);
}

#bando .col-md-12{
	position: relative;
}
  @media (max-width: 600px) {
    .img-calendar img {
      width: 30px;
      height: 30px;
    }
    .box-menu-map {
      position: absolute;
      left: 0;
      background-color: #4E9D90;
      padding: 30px 38px;
      width: 100%;
      height: 215px;
      z-index: 999;
      /* border-radius: 0 20px 20px 0; */
      /* transition: 1s; */
    }
    .img-calendar {
      left: -13px;
    }
    .box-menu-map .title-menu-map p {
      font-size: 20px;
      margin-bottom: 20px;
    }
    .box-menu-map ul li {
      font-size: 14px;
    }
    .btn-hide a, .btn-show a {
      /* padding: 19px; */
      padding: 5px 15px;
    }
    .check-box-menu-map {
      width: 200px;
    }
    .btn-show {
      left: 40px;
      top: 180px;
    }
    .btn-hide {
      top: 180px;
    }
  }
</style>
<div class="container-fluid wr-map page-section" id="bando">
  <div class="row">
    <div class="col-md-12 set-pd-col clsFlex-wrap" style="overflow: hidden;">
      <div class="menu-map">
        <div class="box-menu-map">
          <div class="check-box-menu-map" style="width: 305px;">
            <div class="title-menu-map">
              <p>Di tích lịch sử</p>
            </div>
            <div>
              <!-- <span class="cursor-pointer" onclick="btnMenu(this)"><i class="fa fa-bars" aria-hidden="true"></i></span>
              <span data-toggle="collapse" data-target="#box-check" class="cursor-pointer hidden-pc" onclick="btnMenu2(this)"><i class="fa fa-bars" aria-hidden="true"></i></span> -->
            </div>
              <ul  class="collapse show">
                <li>
                  <input id="check-all" name="all" onclick="checkboxAll(this,'box-check');" value="0" type="checkbox" checked>
                  <label class="noselect" for="check-all">Chọn tất cả</label>
                </li>
              </ul>
            <ul id="box-check" class="collapse show">
              <?php  
                foreach($typeHistoricalSites as $des){?>
                  <li>
                    <input id="check-all<?php echo $des->id ?>"  onclick="initMap();" name="all" type="checkbox" value="<?php echo $des->id ?>" checked>
                    <label class="noselect" for="check-all<?php echo $des->id ?>"><?php echo $des->name ?></label>
                  </li>
              <?php }?>     
            </ul>
            <!-- <div class="absolute btn-hide">
              <a href="javascript:void(0)" class="hide_pop-up"><i class="fa-solid fa-angle-left"></i></a>
            </div> -->
          </div>
          <!-- <div class="btn-show absolute opacity-0">
            <a href="javascript:void(0)" class="show_pop-up"><i class="fa-solid fa-angle-right"></i></a>
          </div> -->
          <!-- <div class="img-calendar">
            <div class="box-img-calendar">
              <img src="<?php echo $urlThemeActive; ?>images/Ellip.png" alt="">
            </div>
            <div class="box-img-calendar">
              <img src="<?php echo $urlThemeActive; ?>images/Ellip.png" alt="">
            </div>
            <div class="box-img-calendar">
              <img src="<?php echo $urlThemeActive; ?>images/Ellip.png" alt="">
            </div>
            <div class="box-img-calendar">
              <img src="<?php echo $urlThemeActive; ?>images/Ellip.png" alt="">
            </div>
            <div class="box-img-calendar">
              <img src="<?php echo $urlThemeActive; ?>images/Ellip.png" alt="">
            </div>
          </div> -->
        </div>
      </div>
      <div class="iframe-map">
        <!-- <button onclick="btnMenu(this)"><i class="fa fa-bars" aria-hidden="true"></i></button> -->
        <div id="map_HS"></div>
      </div>
      <div class="map-filter-close">
        <i class="fa-solid fa-angle-up rotate"></i>
      </div>
    </div>
  </div>
</div>
 
<script type="text/javascript">
  var keyMap = 'efe2301638f6af0bd594f5f607d6dc86ea53e3406d158d44';

  var locations = [<?php

    if (!empty($listHistorieAll)) {
        $listShowMap= array();
        $icon = '/themes/camgiang360/assets/icon/ditich.png';
        
        foreach ($listHistorieAll as $data) {
          if(!empty($data->latitude) & !empty($data->longitude)){
              
              $content   = '<img src='.$data->image.' style=width:200px;height:156px;  ><br/><a href=/chi_tiet_di_tich_lich_su/'.$data->urlSlug.'.html>' . $data->name. '</a>';
              $content.='<br/>Điện thoại: ' . $data->phone;
              $content.='<br/>Địa chỉ: ' . $data->address;
              
              $listShowMap[]= '["' . $content . '", ' . $data->latitude . ', ' . $data->longitude . ', "'.$icon.'","'.$data->idTypeHistoricalSites.'"]';
            }
        }
        
        echo implode(',', $listShowMap);
    }
    ?>];

  const map = L.map('map_HS', {
    center: [20.957851727465343, 106.21850910018482],
    zoom: 13,
  });

  const pointLayer = L.layerGroup().addTo(map);

  function initMap() {
    L.tileLayer('https://maps.vnpost.vn/api/tm/{z}/{x}/{y}@@2x.png?apikey='+keyMap, {
      attribution: 'Map data &copy; <a href="https://vmap.vn">Vmap</a>, <a href="http://openstreetmap.org">OSM Contributors</a>',
      maxZoom: 18,
      id: 'Vmap.streets',
      accessToken: keyMap
    }).addTo(map);

    var icon, y, i;

    pointLayer.clearLayers();

    for (y = 1; y < 100; y++) {
      if($('#check-all'+y).is(":checked")){

        for (i = 0; i < locations.length; i++) {
          if($('#check-all'+y).val() == locations[i][4]){
            icon = L.icon({
              iconUrl: locations[i][3],
              iconSize: [40, 40],
            });

            L.marker([locations[i][1], locations[i][2]], {icon: icon }).bindPopup(locations[i][0]).on('mouseover', function (e) {
               this.openPopup();
              }).addTo(pointLayer);

             L.marker([locations[i][1], locations[i][2]], {icon: icon }).bindPopup(locations[i][0]).on('mouseout', function (e) {
              marker.closePopup();
              });
          }
        }
      }else{
       
      }
    }  

    
  }
</script> 

<script>
  function checkboxAll(source,idLoad) 
  {
    var checkboxes = document.querySelectorAll('#'+idLoad+' input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

    initMap();
  }
</script>

<script>
  $(document).ready(function() {
    var w = $(window).innerHeight();
    var h = $('.map_search').innerHeight();
    // var s = $('#search').innerHeight();
    var f = $('footer').innerHeight();

    var x = w-h-f-10;
    // x= 800;
    // document.write(x);
    // $('#map, #map_HS').css({'height':x});

    initMap();
  });
</script>


