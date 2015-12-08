//console.log("Kuik");

  var map;
function initMap() {
  console.log("Kuik");

  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 8
  });
}

function getRadioInfo(){
  var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "http://localhost:1312/", false);
 xhttp.send();
 console.log(xhttp.responseText);
}

window.onload = getRadioInfo();
