<?php 

$listdestination = destination_ward();
$modelHistorical = modelHistoricalsite();


$locations = [];
$matchingLocations = [];

foreach ($listdestination as $destination) {
    foreach ($modelHistorical as $historical) {
        if ($destination['id'] == $historical['idward']) {
            $matchingLocations[] = [
                'name' => $destination['name'],
                'lat' => $historical['latitude'],
                'lng' => $historical['longitude'],
                'icon' => $destination['image'],
                'type' => $destination['urlSlug'],
                'content' => '<img src="' . $historical['image'] . '" style="width:200px;height:156px;" /><br/><a href="' . $historical['urlSlug'] . '">' . $historical['name'] . '</a>' .
                             '<br/>Điện thoại: ' . @$historical['phone'] .
                             '<br/>Địa chỉ: ' . $historical['address']
            ];
           
        }
    }
}

$locations = $matchingLocations;

?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <style>
        #map-page {
            padding: 20px;
        }
        #map {
            height: 500px;
            margin-top: 20px;
        }
        .filter-container {
            margin-bottom: 20px;
        }
        .filter-options label {
            display: block;
            margin-bottom: 5px;
        }
        .location-name span {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
    <div class='map-container' id='map-page'>
        <div class='container map-container'>
            <h2>Bản đồ số Di tích Thanh Hóa 360</h2>
            <span>Trải nghiệm tham quan ảo thông minh và tiện ích qua Bản đồ số di tích</span>
            <div id="map">
            <div class="filter-container">
                <h2>Danh sách điểm đến</h2>
                <div class="filter-options">
                    <?php foreach ($listdestination as $keydes => $des) { ?>
                        <label>
                            <input type="checkbox" id="check-all<?php echo $keydes ?>" value="<?php echo $des['urlSlug'] ?>" checked />
                            <?php echo $des['name'] ?>
                        </label>
                    <?php } ?>
                </div>
            </div>
            </div>
        </div>
    </div>

    <script>
const map = L.map('map').setView([19.806692, 105.776869], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
}).addTo(map);

var locations = <?php echo json_encode($locations); ?>;

const markersLayer = L.layerGroup().addTo(map);

function addMarkers(filteredLocations) {
    markersLayer.clearLayers();

    filteredLocations.forEach((location) => {
        const marker = L.marker([location.lat, location.lng], {
            icon: L.icon({
                iconUrl: location.icon,
                iconSize: [30, 30],
            }),
        }).bindPopup(location.content);

        markersLayer.addLayer(marker);
    });
}

function filterLocations() {
    const checkedValues = Array.from(document.querySelectorAll('.filter-options input[type="checkbox"]:checked'))
        .map((checkbox) => checkbox.value);

    if (checkedValues.length === 0) {
        markersLayer.clearLayers();
        return;
    }

    const filteredLocations = locations.filter((location) =>
        checkedValues.includes(location.type.toString())
    );

    addMarkers(filteredLocations);
}

document.querySelectorAll('.filter-options input[type="checkbox"]').forEach((checkbox) => {
    checkbox.addEventListener('change', filterLocations);
});

addMarkers(locations);

</script>