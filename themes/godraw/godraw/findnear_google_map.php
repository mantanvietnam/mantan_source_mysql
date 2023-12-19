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
  #map_HS{
    min-height: 400px;
    height: 100%;
    width: 100%;
  }
</style>

<div class="container-fluid wr-map page-section" id="bando">
  <div class="row">
    <div class="col-md-12 set-pd-col clsFlex-wrap" style="overflow: hidden;">
      <div class="iframe-map">
        <div id="map_HS"></div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function initMap() {
    var locations = [<?php
    if (!empty($listAgency)) {
        $listShowMap= array();
        
        foreach ($listAgency as $data) {
          if(!empty($data->lat_gps) & !empty($data->long_gps)){
              $content   = '<img src='.$data->image.' style=width:200px;height:156px;><br/><a href=/store/?id='.$data->id.'>' . $data->name. '</a>';
              $content.='<br/>Điện thoại: ' . $data->phone;
              $content.='<br/>Địa chỉ: ' . $data->address;

              $listShowMap[]= '["' . $content . '", ' . $data->lat_gps . ', ' . $data->long_gps . ', ""]';
            }
        }
        //  $listShowMap[]= '[]';
        echo implode(',', $listShowMap);
    }
    ?>];
    //console.log(locations);
        var lat = 21.02923538766046;
        var log = 105.85243979738055;

        var map = new google.maps.Map(document.getElementById('map_HS'), {
            zoom: 8,
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

        
            for (i = 0; i < locations.length; i++) {
              
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    //icon: locations[i][3]
                });

                google.maps.event.addListener(marker, 'click', (function (marker, i) {
                  return function () {
                      infowindow.setContent(locations[i][0]);
                      infowindow.open(map, marker);
                  }
                })(marker, i));
              
            }
          
        
  }
</script> 

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDalp-JTnHUVHeh_u0d3mWnySFK204NkU0&callback=initMap"></script>


