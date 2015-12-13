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
loopTheShit();

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
     content: "<h2>" + result.title +"</h2>v <i>" + result.date + "</i><br /><p>" + result.description + "</p><br /><i>" + result.subcategory +"</i>"
   });
   infoWindows.push(infowindow);
  // console.log(infoWindows);

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
  //console.log("return fata är: "+returnData());
  if(returnData() == undefined){
    console.log("Detta ska bara hända en gång")
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "http://localhost:1312/", false);
    xhttp.send();
    saveData(JSON.parse(xhttp.responseText))

  }
  trafficMessages = returnData()
//  console.log("trafikmessage är: "+trafficMessages)
console.log("Detta kan hända hur många gåner som helst");
 //return returnData()
 //console.log(JSON.parse(trafficMessages));
initButtons();

}

function initButtons() {

    document.getElementById(0).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheShit();
    });
    document.getElementById(1).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheShit(0);
    });
    document.getElementById(2).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheShit(1);
    });
    document.getElementById(3).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
        loopTheShit(2);
    });
    document.getElementById(4).addEventListener("click",function(){
      emptyList();
      deleteMarkers();
      loopTheShit(3);
    });


}

function loopTheShit(id) {
//  emptyList();
  //console.log(id);
    for (var message in JSON.parse(trafficMessages)["messages"]) {
      var predate = new Date(parseInt(JSON.parse(trafficMessages)["messages"][message]["createddate"].replace("/Date(", "").replace(")/",""), 10));
      var  printAbleDate = setAndReturnDateObject(predate.getDate(),predate.getMonth(),predate.getFullYear());
      date = predate.getTime() ;
      var result =  setAndReturnTrafficRepportObject(
      printAbleDate,
        date,
        JSON.parse(trafficMessages)["messages"][message]["exactlocation"],
        JSON.parse(trafficMessages)["messages"][message]["latitude"],
        JSON.parse(trafficMessages)["messages"][message]["longitude"],
        JSON.parse(trafficMessages)["messages"][message]["category"],
        JSON.parse(trafficMessages)["messages"][message]["subcategory"],
        JSON.parse(trafficMessages)["messages"][message]["title"],
        JSON.parse(trafficMessages)["messages"][message]["description"],
        JSON.parse(trafficMessages)["messages"][message]["id"]);
        //preSortArray.push(result);
        sortOutCategorys(id, result );
    }
    //emptyList();

    gatherAndSortResults(preSortArray);
  //  console.log(preSortArray)
  //  preSortArray=[];
}
function sortOutCategorys(category, result) {
  if(category != null){
      if(result.category == category){

        preSortArray.push(result);
        //gatherAndSortResults(result);
      }
    }
    else{
      //addMarker(result);
      preSortArray.push(result);
      //gatherAndSortResults(result);
    }

  }

  // body...
function emptyList() {

  var list = document.querySelector("ol");
  list.innerText = null;
  // console.log(list);
  // console.log(list.childNodes);

  for(var i = 0; i < list.childNodes.length; i++){
    list.removeChild(list.childNodes[i])
  }
  // x.innerHTML = null;
  // console.log(x);
}

function gatherAndSortResults(result) {


//  if(preSortArray.length == JSON.parse(trafficMessages)["messages"].length){
    preSortArray.sort(function(a, b){return b.date-a.date});
  //  emptyList();
    for(var i = 0; i < preSortArray.length; i++ ){
      addMarker(preSortArray[i]);
       putToList(preSortArray[i]);
    }
    preSortArray = []
}

function putToList(result) {
//  console.log(result);
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
