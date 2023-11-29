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

  var keyMap = 'efe2301638f6af0bd594f5f607d6dc86ea53e3406d158d44';

  var locations = [<?php
    if (!empty($listAgency)) {
        $listShowMap= array();
        
        foreach ($listAgency as $data) {
          if(!empty($data->lat_gps) & !empty($data->long_gps)){
              $content   = '<img src='.$data->image.' style=width:200px;height:156px;  ><br/><a href=/store/?id='.$data->id.'>' . $data->name. '</a>';
              $content.='<br/>Điện thoại: ' . @$data->phone;
              $content.='<br/>Địa chỉ: ' . $data->address;

              $listShowMap[]= '["' . $content . '", ' . $data->lat_gps . ', ' . $data->long_gps . ', ""]';
            }
        }
        
        echo implode(',', $listShowMap);
    }
    ?>];

  const map = L.map('map_HS', {
    center: [21.02923538766046, 105.85243979738055],
    zoom: 15,
  });

  L.tileLayer('https://maps.vnpost.vn/api/tm/{z}/{x}/{y}@@2x.png?apikey='+keyMap, {
    attribution: 'Map data &copy; <a href="https://vmap.vn">Vmap</a>, <a href="http://openstreetmap.org">OSM Contributors</a>',
    maxZoom: 18,
    id: 'Vmap.streets',
    accessToken: keyMap
  }).addTo(map);

  var icon, y, i;

  for (y = 1; y < 10; y++) {
    if($('#check-all'+y).is(":checked")){
      for (i = 0; i < locations.length; i++) {
        if($('#check-all'+y).val() == locations[i][4]){
          icon = L.icon({
            iconUrl: locations[i][3],
            iconSize: [40, 40],
          });

          L.marker([locations[i][1], locations[i][2]], {icon: icon}).bindPopup(locations[i][0]).addTo(map);
        }
      }
    }
  }
</script>

<script>
	$(document).ready(function() {
		var w = $(window).innerHeight();
		var h = $('.map_search').innerHeight();
    // var s = $('#search').innerHeight();
		var f = $('footer').innerHeight();

		var x = w-h-f-10;
		x= 400;
		// document.write(x);
		$('#map, #map_HS').css({'height':x});
	});
</script>


