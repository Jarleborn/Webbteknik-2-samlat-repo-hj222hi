/* Load the HTTP library */
var requeser = require("request");
var http = require("http");
var express = require('express')
var app = express()
app.use(express.static(__dirname + '/'));

requeser('http://api.sr.se/api/v2/traffic/messages?format=json', function (error, response, body) {
  //AIzaSyCWz0N2Fxg7jXfCYu_1Y_0HuOyaU8EZA8I
//     // req('http://api.sr.se/api/v2/traffic/messages?format=json', function (error, response, body) {
  if (!error && response.statusCode == 200) {
    console.log("It's hämtat")
    console.log(JSON.parse(body))
  //  response.send(body)// Show the HTML for the Google homepage.
  }
})


app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');

})

app.listen(1312)
/* Create an HTTP server to handle responses */
// http.createServer(function(request, response) {
//
//   req('https://maps.googleapis.com/maps/api/js?key=AIzaSyCWz0N2Fxg7jXfCYu_1Y_0HuOyaU8EZA8I&callback=initMap', function (error, response, body) {
//     // req('http://api.sr.se/api/v2/traffic/messages?format=json', function (error, response, body) {
//   if (!error && response.statusCode == 200) {
//     console.log(body) // Show the HTML for the Google homepage.
//   }
// })
//   response.writeHead(200, {"Content-Type": "text/plain"});
//   response.write("Fuck Aina");
//   response.end();
// }).listen(1312);
