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

  public function compareDaysAndRsturantDaysAndGetTimes($DoubbleArrayThere0IsTimesAnd1IsDays, $DaysThatWorks)
  {
    $ArrayFOrSPecificDay = array();
    foreach ($DaysThatWorks as $DayThatWork) {

      for ($i=0; $i < count($DoubbleArrayThere0IsTimesAnd1IsDays)  ; $i++) {
           if($DayThatWork == $DoubbleArrayThere0IsTimesAnd1IsDays[$i][0]){
             $result[] = array(
               "time" => $DoubbleArrayThere0IsTimesAnd1IsDays[$i][1],
               "day" => $DoubbleArrayThere0IsTimesAnd1IsDays[$i][0]
                );
              }
           }
      }
      array_push($ArrayFOrSPecificDay,$result );
      //array_push($ArrayWithDaysAndTimesThatWorks, $ArrayFOrSPecificDay);
      // echo "<pre>";
      // print_r($ArrayFOrSPecificDay);
      // echo "</pre>";

       return $ArrayFOrSPecificDay;
  }

  // public function CompareTimes($MovieResultArray, $resturntTImeAndDays)
  // {
  //   echo "<pre>";
  //   print_r($MovieResultArray);
  //   echo "</pre>";
  //   echo "<pre>";
  //   print_r($resturntTImeAndDays);
  //   echo "</pre>";
  //
  //
  //   for ($i=0; $i < count($MovieResultArray); $i++) {
  //     if($MovieResultArray[$i]["time"]
  //     # code...
  //   }
  // }
}
