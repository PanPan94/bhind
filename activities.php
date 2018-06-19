<?php
/**
 * Displaying the nearest restaurant 
 */
require('inc/header.php');
?>
<div class="page" style="padding-top: 70px">
    <div class="map-container">
        <div class="infoWindow" id="infoWindow">
            <h2>Divertissements</h2>
            <ul>
                <li>
                    <a href="https://goo.gl/maps/GpFcyMKy84p">
                        <h3>O'Parinor</h3>
                        Centre commercial - Le Haut de Galy, 93600 Aulnay-sous-Bois
                    </a>
                </li>
                <li>
                    <a href="https://goo.gl/maps/N4uyZvweYMz">
                        <h3>Aéroville</h3>
                        Centre commercial - Rue des Buissons, 95700 Roissy-en-France
                    </a>
                </li>
            </ul>
            <h2 style="margin-top: 25px">Restaurants</h2>
            <ul id="resto"></ul>

            <h2 style="margin-top: 25px">Hotels</h2>
            <ul>
                <li>
                    <a href="https://goo.gl/maps/N4uyZvweYMz">
                        <h3>B&B Hôtel Paris Est Bobigny Université</h3>
                        6 Rue René Goscinny, 93000 Bobigny
                    </a>
                </li>
                <li>
                    <a href="https://goo.gl/maps/N4uyZvweYMz">
                        <h3>Balladins Bobigny</h3>
                        302, avenue Paul Vaillant-Couturier, 93000, Bobigny
                    </a>
                </li>
            </ul>
        </div><div id="map" class="map"></div>
    </div>
</div>
<!-- SCRIPTS -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMQbMb3GhxVJ0RdGIvnBNVTDb15QF84DA&language=fr&libraries=places,geometry"></script>
<script src="js/style.js" async defer></script>
<script src="js/map.js" async defer></script>
<?php
require('inc/footer.php');
?>