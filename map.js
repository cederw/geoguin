function initMap() {
  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map($("#cat-map"), {
    center: {lat: -34.397, lng: 150.644},
    scrollwheel: false,
    zoom: 8
  });
}