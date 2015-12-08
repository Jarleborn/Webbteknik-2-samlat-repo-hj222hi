//console.log("Kuik");

  var map;
function initMap() {
  console.log("Kuik");

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}

window.onload = initMap();
