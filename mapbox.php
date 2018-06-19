<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.js'></script>
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.1/mapbox-gl-geocoder.min.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.1/mapbox-gl-geocoder.css'  />
    <script src="js/mapbox.js"></script>

    <style>
        #map {
            height: 500px;
            width: 100%;
        }
    </style>
    <title>Document</title>
</head>
<body>



    <div id="map">
        <div id="info"></div>
    </div>

    <form action="view.php" method="GET">
        <input type="hidden" name="lat" id="lat">
        <input type="hidden" name="lng" id="lng">
        <button type="submit" class="btn">Envoyer</button>
    </form>
</body>
</html>