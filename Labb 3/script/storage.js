


function checkForStorage() {
  if(typeof(Storage) !== "undefined") {
      console.info("Yes We Can Store");
  } else {
      console.error("I'm Sorry This Dont't Work");
  }
}

function saveData(data) {
  
    localStorage.radioData = data;
    //console.log(sessionStorage.radioData)

    setTimeout(function(){

      //trafficMessages=""
      localStorage.removeItem("radioData");
      getRadioInfo()
      //console.log(localStorage.radioData)
    //},900000)
  },900000)
}

function returnData() {
  //localStorage.removeItem("radioData");

  return localStorage.radioData;
}

window.onload = checkForStorage();
