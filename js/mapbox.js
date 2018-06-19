window.onload = getLocation
let auth
function getLocation() {
    if(navigator.geolocation) {
        auth = true
        navigator.geolocation.getCurrentPosition(displayLocation);
    }else{
        auth = false
        navigator.geolocation.getCurrentPosition(displayLocation);
    }
}

function displayLocation(position, auth) {
    let lat;
    let lng;

    lat = position.coords.latitude
    lng = position.coords.longitude

    mapboxgl.accessToken = 'pk.eyJ1IjoicGFucGFuOTQiLCJhIjoiY2piMHo1YmthN3o1cjJ3cDhrbGhxcGgwMyJ9.3gzXvZbBYOB_VxdHxTV9Vg'

    let map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: [lng, lat],
        zoom: 13,
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true
    }) 

    map.on('click', function(e) {
        let features = map.queryRenderedFeatures(e.point, {
            layers: ['bhind'] // name of the layer
        });
      
        if (!features.length) {
            return;
        }
      
        let feature = features[0];
        
        let popup = new mapboxgl.Popup({ offset: [0, -15] })
            .setLngLat(feature.geometry.coordinates)
            .setHTML(`<h3><a href="oui/${feature.properties.path}">` + feature.properties.title + '</a></h3><p>' + feature.properties.description + '</p>')
            .setLngLat(feature.geometry.coordinates)
            .addTo(map);
    });

    // Locate the user 
    map.addControl(new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true
    },
        trackUserLocation: true
    }));    

    let geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken
    });

    map.addControl(geocoder);
   
    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    map.on('load', function() {
        map.addSource('single-point', {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": []
            }
        });

        map.addLayer({
            "id": "point",
            "source": "single-point",
            "type": "circle",
            "paint": {
                "circle-radius": 10,
                "circle-color": "#007cbf"
            }
        });

        // Listen for the `geocoder.input` event that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            console.log(ev.result.geometry);
            let lng = document.querySelector('#lng');
            let lat = document.querySelector('#lat');
            lng.setAttribute('value', ev.result.geometry.coordinates[0])
            lat.setAttribute('value', ev.result.geometry.coordinates[1])
            map.getSource('single-point').setData(ev.result.geometry.coordinates);
        });
    });
      
}