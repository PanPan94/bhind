<?php
require_once 'inc/header.php';
?>
<head>
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.43.0/mapbox-gl.css' rel='stylesheet' />
</head>
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

    ol {
        display: block;
        margin-left: 50px;
    }

    ol li {
        color: #363333;
    }

    .article_title {
        margin-bottom: 30px;
    }

</style>
<div class="page">
    <div class="p--container section-container">
        <div class="section-title">
            <h2><?= _ABOUT_ ?></h2>
            <div class="intro-banner-content">
                    <div class="team">

                        <div class="team-comp">
                            <img src="img/team/alyssia.png" alt="">
                            <p>
                                <a class="team-comp-name">Alyssia Cyrille</a> <br>
                                <a class="team-comp-role">Chef de projet</a>
                            </p>
                        </div>

                        <div class="team-comp">
                            <img src="img/team/zohra.png" alt="">
                            <p>
                                <a class="team-comp-name">Zohra Elkadiri</a> <br>
                                <a class="team-comp-role">Directeur artistique</a>
                            </p>
                        </div>
                        
                        <div class="team-comp">
                            <img src="img/team/dylan.png" alt="">
                            <p>
                                <a class="team-comp-name">Dylan Francilliette</a> <br>
                                <a class="team-comp-role">Communicant</a>
                            </p>
                        </div>

                        <div class="team-comp">
                            <img src="img/team/sakina.png" alt="">
                            <p>
                                <a class="team-comp-name">Sakina Selhami</a> <br>
                                <a class="team-comp-role">Graphiste</a>
                            </p>
                        </div>


                        <div class="team-comp">
                            <img src="img/team/ewa.png" alt="">
                            <p>
                                <a class="team-comp-name">Eugénie Hua</a> <br>
                                <a class="team-comp-role">Communicante</a>
                            </p>
                        </div>

                        <div class="team-comp">
                            <img src="img/team/ptp.png" alt="">
                            <p>
                                <a class="team-comp-name">Paartheepan Raveenthiran</a> <br>
                                <a class="team-comp-role">Développeur</a>
                            </p>
                        </div>
                    </div>
                </div>
            
            </div>
            <p class="team-define">
            Notre équipe composé de 6 membres, allie toutes ses compétences nécessaires afin de répondre aux demandes et aux besoins de sa clientèle amoureux des voyages.
            <br><br>
            Notre objectif est d'aider et d'informer les touristes ainsi que les voyageurs durants leur visites mais aussi de diffuser nos valeurs qui sont de valoriser et de transmettre l'histoire des banlieues culturels et attractives, le plus souvent oubliées. 
            <br><br>
            Site de l'agence MyOrbis : <a href="https://myorbis.fr/">myorbis.fr</a>
            </p>
            <div id="map"></div>
    </div>
</div>
<!-- <script src="js/mapbox.js"></script> -->
<script>

        mapboxgl.accessToken = 'pk.eyJ1IjoicGFucGFuOTQiLCJhIjoiY2piMHo1YmthN3o1cjJ3cDhrbGhxcGgwMyJ9.3gzXvZbBYOB_VxdHxTV9Vg';

        var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/light-v9',
        center: [2.419058, 48.913926],
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
                coordinates: [2.419058, 48.913926]
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

        let imarker = document.querySelector('#marker')
        imarker.addEventListener('click', () => {
            window.open('http://www.iut-bobigny.univ-paris13.fr/')
        })
    </script>
<?php
    require_once 'inc/footer.php';
?>