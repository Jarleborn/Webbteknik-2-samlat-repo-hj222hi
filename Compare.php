<?php

class compare
{

  function __construct()
  {
    # code...
  }

  public function compareDatesAndGetbestDay($arrayOfDaysWithAllTheInfo){
    $daysThatWorksWithAllOfThem = array();
    for ($i=0; $i < count($arrayOfDaysWithAllTheInfo) ; $i++) {

      if(strtolower($arrayOfDaysWithAllTheInfo[0][1][$i]) == "ok" && strtolower($arrayOfDaysWithAllTheInfo[1][1][$i]) == "ok" && strtolower($arrayOfDaysWithAllTheInfo[2][1][$i]) == "ok"){
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Friday"){
          array_push($daysThatWorksWithAllOfThem, "Fredag");

        }
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Saturday"){
            array_push($daysThatWorksWithAllOfThem, "Lördag");
        }
        if($arrayOfDaysWithAllTheInfo[0][0][$i] == "Sunday"){
          array_push($daysThatWorksWithAllOfThem, "Söndag");
        }
      }
    }
    //var_dump($daysThatWorksWithAllOfThem);
    return $daysThatWorksWithAllOfThem;
    //echo "Det finns ingen dag som alla tre är lediga :( <br />";
  }
}
