//console.log("Kuik");

  var map;
  var trafficMessages;
  var marker ;

function initMap(id) {


  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 62.00, lng: 15.00},
    zoom: 6
  });
loopTheShit(id);

}

function addMarker(result){
  marker = new google.maps.Marker({
   position: {lat: result.latitude, lng: result.longitude },
   map: map,
   animation: google.maps.Animation.DROP,
   title: result.title

 });

 setInfoWindow(marker, result)
}

function setInfoWindow(marker, result) {
  var infowindow = new google.maps.InfoWindow({
     content: "<h2>" + result.title +"</h2>v <i>" + result.date + "</i><br /><p>" + result.description + "</p><br /><i>" + result.subcategory +"</i>"
   });

   marker.addListener('click', function() {
     console.log(infowindow != null)
     if (infowindow != null) {
       console.log(infowindow.close())
      infowindow.close();
  }
     infowindow.open(map, marker);
   });
}

function getRadioInfo(){
  var xhttp = new XMLHttpRequest();
 xhttp.open("GET", "http://localhost:1312/", false);
 xhttp.send();
 trafficMessages = JSON.parse(xhttp.responseText);
 console.log(JSON.parse(trafficMessages));
initButtons();

}

function initButtons() {

    document.getElementById(0).addEventListener("click",function(){
      //console.log(i);
      initMap();
    });
    document.getElementById(1).addEventListener("click",function(){
    //  console.log(i);
      initMap(0);
    });
    document.getElementById(2).addEventListener("click",function(){
      //console.log(i);
      initMap(1);
    });
    document.getElementById(3).addEventListener("click",function(){
      //console.log(i);
      initMap(2);
    });
    document.getElementById(4).addEventListener("click",function(){
      //console.log(i);
      initMap(3);
    });


}

function loopTheShit(id) {
  emptyList();
  console.log(id);
    for (var message in JSON.parse(trafficMessages)["messages"]) {
      var predate = new Date(parseInt(JSON.parse(trafficMessages)["messages"][message]["createddate"].replace("/Date(", "").replace(")/",""), 10));
       //new Date(JSON.parse(trafficMessages)["messages"][message]["createddate"]);
      date = setAndReturnDateObject(predate.getDate(),predate.getMonth(),predate.getFullYear());
      console.log(date);
    var result =  setAndReturnTrafficRepportObject(
        date,
        JSON.parse(trafficMessages)["messages"][message]["exactlocation"],
        JSON.parse(trafficMessages)["messages"][message]["latitude"],
        JSON.parse(trafficMessages)["messages"][message]["longitude"],
        JSON.parse(trafficMessages)["messages"][message]["category"],
        JSON.parse(trafficMessages)["messages"][message]["subcategory"],
        JSON.parse(trafficMessages)["messages"][message]["title"],
        JSON.parse(trafficMessages)["messages"][message]["description"],
        JSON.parse(trafficMessages)["messages"][message]["id"]);
        sortOutCategorys(id, result );





      console.log(result.date.month);
      // console.log("long"+ result.longitude);
    }
    //console.log(result)
}
function sortOutCategorys(category, result) {
  //  console.log(category);
  // console.log(result);
  if(category != null){
    //  console.log(res);
      if(result.category == category){
        console.log("true")
        addMarker(result);
        putToList(result);
      }
    }
    else{
      addMarker(result);
      putToList(result);
    }

  }

  // body...
function emptyList() {
  var list = document.querySelector("#list");
  list.textContent = null;
}


function putToList(result) {

  var list = document.querySelector("#list");
  var listItem = document.createElement("li");
  listItem.setAttribute("id", result.id);
  toggleBounce(listItem, marker);
  listItem.textContent  = result.title + " "+ result.date;
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
