<?php
require_once '../inc/db.php';
require_once '../inc/functions.php';
logged_only();
if($_SESSION['language'] == "fr") {
    include('../lang/fr-lang.php');
}elseif($_SESSION['language'] == "en") {
    include('../lang/en-lang.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.css' rel='stylesheet' />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.3/css/froala_style.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/froala-editor/2.7.3/css/plugins/image.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="../css/style.css">

    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        .marker {
            background-color: #0066ff;
            background-size: cover;
            border: solid 3px #3399ff;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            cursor: pointer;
        }

    </style>

    <title><?= $_GET['id']; ?></title>
</head>
<body>
    <div class="nav-container">
        <div class="container">
            <div class="nav-logo"></div>
            <div class="nav-nav">
                <nav>
                <a class="nav-items" href="../index.php"><?= _HOME_ ?></a>
                <a class="nav-items" href="../visit.php"><?= _VISIT_ ?></a>
                <a class="nav-items" href="../activities.php"><?= _ACTIVITIES_ ?></a>
                <a class="nav-items" href="../chooselanguage.php"><?= _LANGUAGE_ ?></a>    
                <a class="nav-items" href="../about.php"><?= _ABOUT_ ?></a>      
                </nav>
            </div>
        </div>
    </div>
    <div class="page">
        <div class="p--container">
            <div class="section-container container">
                <?php
                    require_once '../inc/db.php';
                    $req = $pdo->prepare('SELECT * FROM cities WHERE city_id = ?');
                    $req->execute([$_GET['id']]);
                    
                    if($ligne = $req->fetch()) {
                        echo '<h1 style="text-align: center; color: #C72727;">' . $ligne->city_name . '</h1>';
                        echo $ligne->city_content;
                    }else {
                        echo "Cet article n'existe pas";
                    }
                    
                    ?>
            </div>
            <div id="map"></div>
        </div>
    </div>
    <script>

        mapboxgl.accessToken = 'pk.eyJ1IjoicGFucGFuOTQiLCJhIjoiY2piMHo1YmthN3o1cjJ3cDhrbGhxcGgwMyJ9.3gzXvZbBYOB_VxdHxTV9Vg';

        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v9',
        center: [<?= $ligne->city_lng; ?>, <?= $ligne->city_lat; ?>],
        zoom: 13
        });

        var geojson = {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                geometry: {
                type: 'Point',
                coordinates: [<?= $ligne->city_lng; ?>, <?= $ligne->city_lat; ?>]
                },
                properties: {
                title: 'Mapbox',
                description: 'Titre'
                }
            },
            ]
        };

        geojson.features.forEach(function(marker) {

        // create a HTML element for each feature
        var el = document.createElement('div');
        el.className = 'marker';

        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
        });
    </script>
<?php
require_once '../inc/footer.php';
?>