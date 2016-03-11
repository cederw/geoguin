
$(function() {
    google.maps.event.addDomListener(window, 'load', getLoc);   
});

function getLoc() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(init);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
}

function init(position) {
    var mapProp = {
        center:new google.maps.LatLng(position.coords.latitude,position.coords.longitude),
        zoom:15,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        scrollwheel: false
    };
    var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    getCats(position, map);
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