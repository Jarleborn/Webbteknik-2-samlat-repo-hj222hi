//console.log("Kuik");

  var map;
  var trafficMessages;
  var marker ;
  var infoWindows = [];
  var preSortArray = [];
  var markers = [];

  function initMap(id) {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 62.00, lng: 15.00},
      zoom: 6
    });
    loopTheResponseAndPassOn();
}

function addMarker(result){
  marker = new google.maps.Marker({
   position: {lat: result.latitude, lng: result.longitude },
   map: map,
   animation: google.maps.Animation.DROP,
   title: result.title
 });
 markers.push(marker);
 setInfoWindow(marker, result)
}
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
  }
}
function clearMarkers() {
  setMapOnAll(null);
}
function deleteMarkers() {
  clearMarkers();
  markers = [];
}
function setInfoWindow(marker, result) {

  var infowindow = new google.maps.InfoWindow({
     content: "<h2>" + result.title +"</h2> <i>" + result.printAbleDate.day+"/"+result.printAbleDate.month+"-"+result.printAbleDate.year + "</i><br /><p>" + result.description + "</p><br /><i>" + result.subcategory +"</i>"
   });
   infoWindows.push(infowindow);
   marker.addListener('click', function() {
     for(var i = 0; i < infoWindows.length; i++){
       if (infoWindows[i] != null) {
         infoWindows[i].close();
       }
     }
       infowindow.open(map, marker);
      });
}

function getRadioInfo(){
  console.log("return data är: "+returnData());
  if(returnData() == undefined){
    console.log("Detta ska bara hända en gång")
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://hampusjarleborn.se:1312/", false);
    xhttp.send();
    saveData(JSON.parse(xhttp.responseText))

  }
  trafficMessages = returnData()
  console.log("Detta kan hända hur många gåner som helst");
  initButtons();
}

function initButtons() {

    document.getElementById(0).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheResponseAndPassOn();
    });
    document.getElementById(1).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheResponseAndPassOn(0);
    });
    document.getElementById(2).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheResponseAndPassOn(1);
    });
    document.getElementById(3).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
        loopTheResponseAndPassOn(2);
    });
    document.getElementById(4).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheResponseAndPassOn(3);
    });


}

function loopTheResponseAndPassOn(id) {
  var parsedTrafficMessages = JSON.parse(trafficMessages);
    for (var message in parsedTrafficMessages["messages"]) {
      var predate = new Date(parseInt(parsedTrafficMessages["messages"][message]["createddate"].replace("/Date(", "").replace(")/",""), 10));
      var  printAbleDate = setAndReturnDateObject(predate.getDate(),predate.getMonth(),predate.getFullYear());
      date = predate.getTime() ;
      var result =  setAndReturnTrafficRepportObject(
      printAbleDate,
        date,
        parsedTrafficMessages["messages"][message]["exactlocation"],
        parsedTrafficMessages["messages"][message]["latitude"],
        parsedTrafficMessages["messages"][message]["longitude"],
        parsedTrafficMessages["messages"][message]["category"],
        parsedTrafficMessages["messages"][message]["subcategory"],
        parsedTrafficMessages["messages"][message]["title"],
        parsedTrafficMessages["messages"][message]["description"],
        parsedTrafficMessages["messages"][message]["id"]);
        sortOutCategorys(id, result );
    }
    gatherAndSortResults(preSortArray);
}
function sortOutCategorys(category, result) {
  if(category != null){
      if(result.category == category){
        preSortArray.push(result);
      }
    }
    else{
      preSortArray.push(result);
    }

  }
function emptyList() {

  var list = document.querySelector("ol");
  list.innerText = null;
  for(var i = 0; i < list.childNodes.length; i++){
    list.removeChild(list.childNodes[i])
  }
}

function gatherAndSortResults(result) {
    preSortArray.sort(function(a, b){return b.date-a.date});
    for(var i = 0; i < preSortArray.length; i++ ){
      addMarker(preSortArray[i]);
       putToList(preSortArray[i]);
    }
    preSortArray = []
}

function putToList(result) {
  var list = document.querySelector("#list");
  var listItem = document.createElement("li");
  listItem.setAttribute("id", result.id);
  toggleBounce(listItem, marker);
  //listItem.textContent  = " - "+ result.printAbleDate.day + "/"+ result.printAbleDate.month+"-"+result.printAbleDate.year;
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
