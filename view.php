<?php
require_once './inc/db.php';
require_once './inc/functions.php';
logged_only();
if($_SESSION['language'] == "fr") {
    include('./lang/fr-lang.php');
}elseif($_SESSION['language'] == "en") {
    include('./lang/en-lang.php');
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/froala_style.min.css">

    <meta property="og:title" content="Bhind">
    <meta property="og:description" content="Découvrez le Grand Paris.">
    <meta property="og:image" content="img/bhind.png">
    <meta property="og:url" content="https://myorbis.fr/bhind">
    <meta property="twitter:title" content="Bhind">
    <meta property="twitter:description" content="Découvrez le Grand Paris.">
    <meta property="twitter:card" content="img/bhind.png">
    <meta property="twitter:url" content="https://myorbis.fr/bhind">

    <link rel="icon" type="image/png" href="bhind.png" />
    <style>

        h2 {
            color: #C72727;
        }

        hr {
            width: 40%;
            color: #C72727;
            margin: 0 auto;
        }
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

        ol, ul {
            display: block;
            margin-left: 50px;
        }

        ol li, ul li {
            color: #363333;
        }

        table {
            border-collapse: collapse;
        }
        
        td {
            border: solid #e2e2e2 1px;
            border-collapse: collapse;
            padding: 50px;
        }
        .article_title {
            margin-bottom: 30px;
        }

    </style>
    <?php 
        $res = $pdo->prepare('SELECT * FROM articles WHERE article_id = ?');
        $res->execute([$_GET['id']]);

        if($line = $res->fetch()) {
            $pname = $line->article_title;
        }else {
            $pname = 'none';
        }
    ?>

    <title>Bhind - <?= $pname ?></title>
</head>
<body>
<div class="nav-container">
    <div class="container">
        <div class="nav-logo"><a class="nav-logo-link" href="index.php"></a></div>
        <div class="nav-nav" id="nav-nav">
            <div class="nav-toggler" id="nav-toggler"></div>
            <nav>
            <a class="nav-items" href="./index.php"><?= _HOME_ ?></a>
            <a class="nav-items" href="./visit.php"><?= _VISIT_ ?></a>
            <a class="nav-items" href="./activities.php"><?= _ACTIVITIES_ ?></a>
            <a class="nav-items" href="./chooselanguage.php"><?= _LANGUAGE_ ?></a>    
            <a class="nav-items" href="./about.php"><?= _ABOUT_ ?></a>      
            </nav>
        </div>
    </div>
</div>

<div class="page">
        <div class="p--container">
            <div class="section-container container">
                <?php
                    require_once 'inc/db.php';
                    $req = $pdo->prepare('SELECT * FROM articles WHERE article_id = ?');
                    $req->execute([$_GET['id']]);
                    
                    if($ligne = $req->fetch()) {
                        echo '<h1 class="article_title"style="text-align: center; color: #C72727;">' . $ligne->article_title . '</h1>';

                        echo $ligne->article_content;
                        $_POST['lat'] = $ligne->article_lat;
                        $_POST['lng'] = $ligne->article_lng;
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
        center: [<?= $_POST['lng']; ?>, <?= $_POST['lat']; ?>],
        zoom: 13
        });

        map.addControl(new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
                trackUserLocation: true
        }));    


        var geojson = {
            type: 'FeatureCollection',
            features: [{
                type: 'Feature',
                geometry: {
                type: 'Point',
                coordinates: [<?= $_POST['lng']; ?>, <?= $_POST['lat']; ?>]
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
        el.id = 'marker';
        // make a marker for each feature and add to the map
        new mapboxgl.Marker(el)
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);
        });




    </script>
    <footer>
        <div class="author">
            <p></p>
        </div>
        <div class="social-links">
            <a href="http://www.facebook.com/bhind"><div class="icon facebook"></div></a>
            <a href="http://www.instagram.com/bhind"><div class="icon instagram"></div></a>
            <a href="http:/www.youtube.com/bhind/"><div class="icon youtube"></div></a>
        </div>
    </footer>
</body>
<script src="js/nav.js"></script>
<script>
    let imarker = document.querySelector('#marker')
    imarker.addEventListener('click', () => {
        window.open('http://maps.google.com/maps?q=' + <?= $_POST['lat']; ?> + ',' + <?= $_POST['lng']; ?>)
    })
</script>
</html>