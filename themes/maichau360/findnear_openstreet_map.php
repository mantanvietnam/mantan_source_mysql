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
    left: 70px;
    background-color: #4E9D90;
    padding: 50px 60px;
    width: 350px;
    height:450px;
    z-index: 999;
    border-radius: 0 20px 20px 0;
    transition: 1s;
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
  @media (max-width: 600px) {
    .img-calendar img {
      width: 30px;
      height: 30px;
    }
    .box-menu-map {
      position: absolute;
      left: 25px;
      background-color: #4E9D90;
      padding: 25px 30px;
      width: 250px;
      height: 380px;
      z-index: 999;
      border-radius: 0 20px 20px 0;
      transition: 1s;
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
          <div class="check-box-menu-map">
            <div class="title-menu-map">
              <p>Danh sách điểm đến</p>
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
              <?php  $listdestination = destination(); 
                foreach($listdestination as $keydes => $des){?>
                  <li>
                    <input id="check-all<?php echo $keydes ?>"  onclick="initMap();" name="all" type="checkbox" value="<?php echo $des['urlSlug'] ?>" checked>
                    <label class="noselect" for="check-all<?php echo $keydes ?>"><?php echo $des['name'] ?></label>
                  </li>
              <?php }?>     
            </ul>
            <div class="absolute btn-hide">
              <a href="javascript:void(0)" class="hide_pop-up"><i class="fa-solid fa-angle-left"></i></a>
            </div>
          </div>
          <div class="btn-show absolute opacity-0">
            <a href="javascript:void(0)" class="show_pop-up"><i class="fa-solid fa-angle-right"></i></a>
          </div>
          <div class="img-calendar">
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
          </div>
        </div>
      </div>
      <div class="iframe-map">
        <!-- <button onclick="btnMenu(this)"><i class="fa fa-bars" aria-hidden="true"></i></button> -->
        <div id="map_HS"></div>
      </div>
    </div>
  </div>
</div>
 
<script type="text/javascript">
  var keyMap = 'efe2301638f6af0bd594f5f607d6dc86ea53e3406d158d44';

  var locations = [<?php
    $findNear = getFindnear();

    if (!empty($findNear)) {
        $listShowMap= array();
        
        foreach ($findNear as $data) {
          if(!empty($data['lat']) & !empty($data['long'])){
              $content   = '<img src='.$data['image'].' style=width:200px;height:156px;  ><br/><a href='.$data['urlSlug'].'>' . $data['name']. '</a>';
              $content.='<br/>Điện thoại: ' . @$data['phone'];
              $content.='<br/>Địa chỉ: ' . $data['address'];

              $listShowMap[]= '["' . $content . '", ' . $data['lat'] . ', ' . $data['long'] . ', "' . $data['icon'] . '","'.$data['type'].'"]';
            }
        }
        
        echo implode(',', $listShowMap);
    }
    ?>];

  const map = L.map('map_HS', {
    center: [20.668785542548076, 105.00060413875005],
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

    for (y = 1; y < 10; y++) {
      if($('#check-all'+y).is(":checked")){

        for (i = 0; i < locations.length; i++) {
          if($('#check-all'+y).val() == locations[i][4]){
            icon = L.icon({
              iconUrl: locations[i][3],
              iconSize: [40, 40],
            });

            L.marker([locations[i][1], locations[i][2]], {icon: icon}).bindPopup(locations[i][0]).addTo(pointLayer);
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


