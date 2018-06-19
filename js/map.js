window.onload = getMyLocation;

var map;
var latLng;
var markresults = new Array();
function getMyLocation() {
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(displayLocation);
    }else{
        alert('Please activate your location')
    }
}

function displayLocation(pos) {
    var lat = pos.coords.latitude
    var lng = pos.coords.longitude

    latLng = new google.maps.LatLng(lat,lng)

    showMap(latLng)
    addNearByPlaces(latLng)
    apiMarkerCreate(latLng)
}

function showMap(latLng) {
    var opt = {
        center: latLng,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        styles: style
    }

    map = new google.maps.Map(document.querySelector('#map'), opt)
}

function addNearByPlaces(latLng) {
    var nearByService = new google.maps.places.PlacesService(map)

    var request = {
        query: "restaurant",
        location: latLng,
        radius: 1500
    }

    nearByService.textSearch(request, searchNearBy)
}

function searchNearBy(results, status) {
    if(status == google.maps.places.PlacesServiceStatus.OK) {
        for(var i = 0; i < results.length; i++) {
            var place = results[i]
            apiMarkerCreate(place.geometry.location, place)
            markresults.push(place)
        }
    }

    
    
    var list = document.querySelector('#infoWindow #resto')
    var limit = 0;
    markresults.forEach((m) => {
        var item = document.createElement('li')
        itemSearchLink = m.formatted_address
        // if(!itemSearchLink.includes("Paris, France")) {
            itemSearchLink = itemSearchLink.split(' ').join('+')
            var itemContent = '<h3>' + m.name + '</h3>' +  m.formatted_address
            item.innerHTML = '<a target="_blank" href="https://www.google.fr/maps/place/' + itemSearchLink + '" target="_blank">' + itemContent + '</a>'
            list.appendChild(item)
        // }
    })
}

function apiMarkerCreate(latLng, placeResult) {
    /**
     * Contains the option to create the marker of each position near the user
     * @var {object} markerOptions
     */
    var markerOptions = {
        position: latLng,
        map: map,
        animation: google.maps.Animation.DROP,
        clickable: true,
        icon: 'img/resto.png'
    }

    
    /**
     * @var {object} myOptions
     * Contains the option to create the marker of the user
     */
    var myOptions = {
        position: latLng,
        map: map,
        animation: google.maps.Animation.DROP,
        clickable: true,
        icon: 'img/mypos.png'
    }
    
    if(placeResult) {
        var marker = new google.maps.Marker(markerOptions)
        var content = placeResult.name + '<br>' + placeResult.formatted_address + '<br> <a href="http://maps.google.com/maps?q=' + latLng.lat() + ',' + latLng.lng() + '">S\'y rendre</a>'
        windowInfoCreate(marker, latLng, content)
    }else {
        var marker2 = new google.maps.Marker(myOptions)
        var content = 'Your position ' + latLng.lat() + ', ' + latLng.lng()
        windowInfoCreate(marker2, latLng, content)
    }
}

function windowInfoCreate(marker, latLng, content) {
    var infoWindowOptions = {
        content: content,
        position: latLng
    }

    var infoWindow = new google.maps.InfoWindow(infoWindowOptions);

    google.maps.event.addListener(marker, 'click', function() {
        infoWindow.open(map)
        openedIw = infoWindow
    })
    

}