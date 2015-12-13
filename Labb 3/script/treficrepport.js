var TrefficRapport;

function setAndReturnTrafficRepportObject(printAbleDate, date, exactlocation, latitude, longitude, category, subcategory, title, description, id) {
 return   TrefficRapport = {printAbleDate:printAbleDate, date: date, exactlocation:exactlocation, latitude:latitude, longitude: longitude, category:category, subcategory:subcategory, title:title, description:description, id:id};
}

function setAndReturnDateObject(day, month, year) {
  return DateObject = {day:day, month:month, year:year};
  // body...
}
