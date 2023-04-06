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
    z-index: 99999;
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
    height: 600px !important;
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
                  <img src="<?php echo $urlThemeActive; ?>img/thaianhimg/Ellip.png" alt="">
                </div>
                <div class="box-img-calendar">
                  <img src="<?php echo $urlThemeActive; ?>img/thaianhimg/Ellip.png" alt="">
                </div>
                <div class="box-img-calendar">
                  <img src="<?php echo $urlThemeActive; ?>img/thaianhimg/Ellip.png" alt="">
                </div>
                <div class="box-img-calendar">
                  <img src="<?php echo $urlThemeActive; ?>img/thaianhimg/Ellip.png" alt="">
                </div>
                <div class="box-img-calendar">
                  <img src="<?php echo $urlThemeActive; ?>img/thaianhimg/Ellip.png" alt="">
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
  function initMap() {
    var locations = [<?php
    if (!empty(getFindnear())) {
        $listShowMap= array();
        foreach (getFindnear() as $data) {
          if(!empty($data['lat']) & !empty($data['long'])){
              //$content = '<a href='.$data['urlSlug'].'></a>';
              $content   = '<img src='.$data['image'].' style=width:200px;height:156px;  ><br/><a href='.$data['urlSlug'].'>' . $data['name']. '</a>';
              $content.='<br/>Điện thoạt: ' . $data['phone'];
              $content.='<br/>Địa chỉ: ' . $data['address'];

              $listShowMap[]= '["' . $content . '", ' . $data['lat'] . ', ' . $data['long'] . ', "' . $data['icon'] . '","'.$data['type'].'"]';
            }
        }
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];
    console.log(locations);

      var lat = 21.057646992531012;
      var log = 105.83320869683257;

        var map = new google.maps.Map(document.getElementById('map_HS'), {
            zoom: 14,
            center: new google.maps.LatLng(lat, log),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                      {
                        "featureType": "administrative",
                        "elementType": "geometry",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "poi",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "road",
                        "elementType": "labels.icon",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      },
                      {
                        "featureType": "transit",
                        "stylers": [
                          {
                            "visibility": "off"
                          }
                        ]
                      }
                    ]
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;
        i= -1;
        marker = new google.maps.Marker({map: map});

        for (y = 1; y < 10; y++) {
          if($('#check-all'+y).is(":checked")){
            for (i = 0; i < locations.length; i++) {
              if($('#check-all'+y).val() == locations[i][4]){
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: locations[i][3]
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                  return function () {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                  }
                })(marker, i));
              }
            }
          }
        }


        var newPoint = {lat: lat, lng: log};
        marker.setIcon('');
        marker.setPosition(newPoint);
        map.setCenter(newPoint);
        i = locations.length;

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                infowindow.setContent('');
                infowindow.open(map, marker);
            }
        })(marker, i));
  }
</script> 
<script>
  function checkboxAll(source,idLoad) {
    var checkboxes = document.querySelectorAll('#'+idLoad+' input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

    initMap();
}
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDalp-JTnHUVHeh_u0d3mWnySFK204NkU0&callback=initMap"></script>

<script>
  $(document).ready(function() {
    var w = $(window).innerHeight();
    var h = $('.map_search').innerHeight();
    // var s = $('#search').innerHeight();
    var f = $('footer').innerHeight();

    var x = w-h-f-10;
    x= 800;
    // document.write(x);
    $('#map, #map_HS').css({'height':x});
  });
</script>


