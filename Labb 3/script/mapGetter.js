//console.log("Kuik");

  var map;
  var trafficMessages;

function initMap() {


  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 62.00, lng: 15.00},
    zoom: 6
  });
loopTheShit();

}

function addMarker(result){
  var marker = new google.maps.Marker({
   position: {lat: result.latitude, lng: result.longitude },
   map: map,
   title: result.title
 });

 var infowindow = new google.maps.InfoWindow({
    content: "<h2>" + result.title +"</h2>v <i>" + result.date + "</i><br /><p>" + result.description + "</p><br /><i>" + result.subcategory +"</i>"
  });

  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
}

function getRadioInfo(){
  var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "http://localhost:1312/", false);
 xhttp.send();
 trafficMessages = JSON.parse(xhttp.responseText);
 console.log(JSON.parse(trafficMessages));
}

function loopTheShit() {
    for (var message in JSON.parse(trafficMessages)["messages"]) {
    var result =  setAndReturnTrafficRepportObject(
        JSON.parse(trafficMessages)["messages"][message]["createddate"],
        JSON.parse(trafficMessages)["messages"][message]["exactlocation"],
        JSON.parse(trafficMessages)["messages"][message]["latitude"],
        JSON.parse(trafficMessages)["messages"][message]["longitude"],
        JSON.parse(trafficMessages)["messages"][message]["subcategory"],
        JSON.parse(trafficMessages)["messages"][message]["title"],
        JSON.parse(trafficMessages)["messages"][message]["description"]);
        addMarker(result);
      console.log("lat" + result);
      // console.log("long"+ result.longitude);
    }
}

window.onload = getRadioInfo();
