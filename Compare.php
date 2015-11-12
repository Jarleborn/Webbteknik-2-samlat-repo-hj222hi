<?php

class compare
{

  function __construct()
  {
    # code...
  }

  public function compareDatesAndGetbestDay($arrayOfDaysWithAllTheInfo){
    //var_dump("Den kör");
    for ($i=0; $i < count($arrayOfDaysWithAllTheInfo) ; $i++) {
      // var_dump(strtolower($arrayOfDaysWithAllTheInfo[0][1][$i]));
      // var_dump(strtolower($arrayOfDaysWithAllTheInfo[1][1][$i]));
      // var_dump(strtolower($arrayOfDaysWithAllTheInfo[2][1][$i]) );
      //
    //  var_dump($i);
      if(strtolower($arrayOfDaysWithAllTheInfo[0][1][$i]) == "ok" && strtolower($arrayOfDaysWithAllTheInfo[1][1][$i]) == "ok" && strtolower($arrayOfDaysWithAllTheInfo[2][1][$i]) == "ok"){
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Friday"){
          return "Fredag fungerar <br />";
        }
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Saturday"){
          return  "Lördag fungerar <br />";
        }
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Sunday"){
        return  "Söndag fungerar <br />";
        }
      }
    }
    return "Det finns ingen dag som alla tre är lediga :( <br />";
  }
}
