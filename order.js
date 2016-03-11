
$(function() {
    new google.maps.event.addDomListener(window, 'load', getLoc);   
});

function getLoc() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(init);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
}

var marker = null;

function init(position) {
    var latLng = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
    if ($("#lat").val() != "" && $("#lon").val() != "") {
        latLng = new google.maps.LatLng($("#lat").val(), $("#lon").val());
    }

    var mapProp = {
        center: latLng,
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
    //insertCoords(position.coords.latitude, position.coords.longitude);
    placeMarker(latLng, map, "You are here. Place a cat here at <br />");
    google.maps.event.addListener(map, 'click', function(event) {
        placeMarker(event.latLng, map, "Place cat at <br>");
    });
    getCats(position, map);
}

function insertCoords(lat, lng) {
    $("#lat").val(lat);
    $("#lon").val(lng);
}

function placeMarker(location, map, str) {
    if (marker != null) {
        marker.setMap(null);
    }

    marker = new google.maps.Marker({
        position: location,
        map: map,
    })

    var infowindow = new google.maps.InfoWindow({
        content: str + "latitude: " + location.lat() + '<br>longitude: ' + location.lng()
    });
    infowindow.open(map,marker);
    insertCoords(location.lat(), location.lng());
}

function getCats(position, map) {
    var postD = {
        mode: "location",
        lat: position.coords.latitude,
        lon: position.coords.longitude
    };
    $.post("service.php", postD)
    .done(function(data) {
        placeCats(data, map);
    })
    .fail(function(x) {
        console.log(x);
    });
}

function placeCats(data, map) {
    var free = data.free;
    var owned = data.owned;
    makeMarker(free, map, true);
    makeMarker(owned, map, false);
}

function makeMarker(catArr, map, avail) {
    for (var i = 0; i < catArr.length; i++) {
        var myCenter = new google.maps.LatLng(catArr[i].lat,catArr[i].lon);
        var catPic = catArr[i].url.replace("img", "mini");
        var marker = new google.maps.Marker({
            position:myCenter,
            icon: catPic
        });
        attachInfo(catArr[i], marker, map, avail);
    }
}

function attachInfo(cat, marker, map, avail) {
    var content = cat.name + " lives here. Come pick them up!";
    if (!avail) {
        content = cat.name + " lives here, but is currently visiting someone. Check back later to pick up " + cat.name + "!";
    }

    var infowindow = new google.maps.InfoWindow({
        content: content
    });

    marker.setMap(map);
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
}