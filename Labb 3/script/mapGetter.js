//console.log("Kuik");

  var map;
  var trafficMessages;
  var marker ;

function initMap() {


  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 62.00, lng: 15.00},
    zoom: 6
  });
loopTheShit();

}

function addMarker(result){
  marker = new google.maps.Marker({
   position: {lat: result.latitude, lng: result.longitude },
   map: map,
   animation: google.maps.Animation.DROP,
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
        JSON.parse(trafficMessages)["messages"][message]["category"],
        JSON.parse(trafficMessages)["messages"][message]["title"],
        JSON.parse(trafficMessages)["messages"][message]["description"],
        JSON.parse(trafficMessages)["messages"][message]["id"]);
        addMarker(result);
        console.log(marker);
        putToList(result);





      console.log("lat" + result);
      // console.log("long"+ result.longitude);
    }
}

function putToList(result) {
  var list = document.querySelector("#list");
  var listItem = document.createElement("li");
  listItem.setAttribute("id", result.id);
  toggleBounce(listItem, marker);
  listItem.textContent  = result.title;
  list.appendChild(listItem);


}

function toggleBounce(listItem, marker) {
  listItem.addEventListener("click", function(argument) {
    if (marker.getAnimation() !== null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  })

}

window.onload = getRadioInfo();
