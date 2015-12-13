/* Load the HTTP library */
var requeser = require("request");
//var http = require("http");
var express = require('express')
var app = express()


app.listen(1312)


app.all('/', function (req, res, next) {
  console.log("Den försöker");
  res.header("Access-Control-Allow-Origin", "*");
    res.header("Access-Control-Allow-Headers", "X-Requested-With");
    next();

});


app.get('/', function (req, res) {

    getResponse(function(result){
        res.json(JSON.stringify(result));
    }, "http://api.sr.se/api/v2/traffic/messages?pagination=false&format=json");


});



function getResponse(callback, url) {
  requeser(url, function (error, response, body) {

    if (!error && response.statusCode == 200) {
      console.log("It's hämtat")
      console.log(JSON.parse(body))
      callback(JSON.parse(body));
    }
  })

};
