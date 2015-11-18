<?php
class Scraper{

  public $DOM;
  public $data;
  public $xpath;

  public function __construct(){

  }
  public function getURL()
  {
    if(isset($_GET['URL'])){
		return $_GET['URL'];
    }
    return $_GET['URL'];
  }

  public function GetLinkToCalenders()
  {
    $items = $this->getDOM($this->getURL())->query('//ol //li //a');
    $arrayOfLinks = array();
    foreach ($items as $item) {
    array_push($arrayOfLinks, $item);
    }
    foreach ($arrayOfLinks as $link) {
      if($link->nodeValue == "Kalendrar"){
        return $this->getURL().$link->getAttribute("href");
      }
    }
  }

  public function GetLinkToResturant()
  {
    $items = $this->getDOM($this->getURL())->query('//ul //li //a');
    $arrayOfLinks = array();
    foreach ($items as $item) {
    array_push($arrayOfLinks, $item);
    }
    foreach ($arrayOfLinks as $link) {
      if($link->nodeValue != "Kalendrar" && $link->nodeValue != "Stadens biograf!"){
        return $this->getURL().$link->getAttribute("href");

      }

    }
    //TODO fixa detta bre
    return "http://46.101.232.43/dinner/";
  }

  public function GetLinkToMovies()
  {
    $items = $this->getDOM($this->getURL())->query('//ol //li //a');
    $arrayOfLinks = array();
    foreach ($items as $item) {
    array_push($arrayOfLinks, $item);
    }
    foreach ($arrayOfLinks as $link) {
      if($link->nodeValue == "Stadens biograf!"){
        return $this->getURL().$link->getAttribute("href");
      }
    }
  }


  public function getHTML($url){
    $this->data = file_get_contents($url);
    return $this->data;
  }

  public function getDOM($link){
    $this->DOM = new DOMDocument();

    if ($this->DOM->loadHTML($this->getHTML($link))) {
      $this->xpath = new DOMXPath($this->DOM);

      return $this->xpath;
    }
  }

  public function getCalenderLinks(){
    $items = $this->getDOM($this->GetLinkToCalenders())->query('//ul //li //a');
    $arrayOfLinks = array();
    foreach ($items as $item) {
    array_push($arrayOfLinks, $item->getAttribute("href"));
    }
    return $arrayOfLinks;
  }
  public function getMovieDayLink($theDaysThatWorks){
    $items = $this->getDOM($this->GetLinkToMovies())->query("//form /div /select[@id='day'] /option");
    $arrayOfLinks = array();
    foreach ($items as $item) {
      if(in_array($item->nodeValue, $theDaysThatWorks)){
        array_push($arrayOfLinks, $item->getAttribute("value") );
      }
    }
    return $arrayOfLinks;
  }

  public function getMovieLink(){
    $items = $this->getDOM($this->GetLinkToMovies())->query("//div /div /form /select[@id='movie'] /option");
//  var_dump($theDaysThatWorks);
    $arrayOfLinks = array();
    $arrayOfNames = array();
    $arrayWithBothLinkAndNames = array();
    foreach ($items as $item) {
      array_push($arrayOfLinks, $item->getAttribute("value"));
      array_push($arrayOfNames, $item->nodeValue);
    }
    array_push($arrayWithBothLinkAndNames, $arrayOfLinks);
    array_push($arrayWithBothLinkAndNames, $arrayOfNames);
    return $arrayWithBothLinkAndNames;
  }

  public function getFreeDaysAtTheResturant(){
    $items = $this->getDOM($this->GetLinkToResturant())->query('//input[@type="radio"]');
    $arrayOfdaysAndTimesThatAreFreeAtTheResturant = array();
    $arrayOfTImes = array();
    $arrayOfDays = array();
    $arrayOfRenamedDays = array();


    foreach ($items as $item) {
        $ArrayWithDay = array();
      $ArrayWithExplodedeDaysAndTImes = array();

      array_push($ArrayWithExplodedeDaysAndTImes, str_split($item->getAttribute("value"), 3));
      $timeConciller = "".$ArrayWithExplodedeDaysAndTImes[0][1]."".$ArrayWithExplodedeDaysAndTImes[0][2]."";

        if($ArrayWithExplodedeDaysAndTImes[0][0] == "fre"){
          array_push($ArrayWithDay,"01");
        }
        elseif($ArrayWithExplodedeDaysAndTImes[0][0] == "lor"){
          array_push($ArrayWithDay,"02");
        }
        elseif($ArrayWithExplodedeDaysAndTImes[0][0] == "son"){
          array_push($ArrayWithDay,"03");
        }
      array_push($ArrayWithDay, $timeConciller);
      array_push($arrayOfdaysAndTimesThatAreFreeAtTheResturant, $ArrayWithDay );
    }
    return $arrayOfdaysAndTimesThatAreFreeAtTheResturant;
  }

  public function getMovies($daysOK, $movies)
  {
    $araryWithInfoAboutMoviesAndDates = array();
    foreach ($daysOK as $day) {
      foreach ($movies[0] as $movie) {
        if (isset($movie)) {
          $var = $this->getHTML($this->GetLinkToMovies()."/check?day=".$day."&movie=".$movie);
          foreach (json_decode($var) as $value) {
            if($value->status == 1){
              if ($value->movie == 01) {
                $movieNameHolder = $movies[1][1];
              }
              elseif ($value->movie == 02) {
                $movieNameHolder = $movies[1][2];
              }
              elseif ($value->movie == 03) {
                $movieNameHolder = $movies[1][3];
              }
            $result[] = array(
              "time" => $value->time,
              "movieid" => $value->movie,
              "movieName" =>$movieNameHolder,
              "day" =>$day

            );}
            array_push($araryWithInfoAboutMoviesAndDates, $result);
        }

        }
      }

    }


    return $result;
  }

  public function getThePersonsDates($ArrayOfLinksToCallenders)
  {
    $arrayOfPersons= array();
    foreach ($ArrayOfLinksToCallenders as $calender) {
        $PersonalArray= array();
        array_push($PersonalArray,   $this->GetDates($calender), $this->GetPersonsOppinionOnDates($calender) );
        array_push( $arrayOfPersons ,$PersonalArray);
    }

    return $arrayOfPersons;
  }

  public function GetPersonsOppinionOnDates($CalenderPage)
  {
    $items = $this->getDOM($this->GetLinkToCalenders()."/".$CalenderPage)->query(' //td');
    $arrayOfDays = array();
    foreach ($items as $item) {
    array_push($arrayOfDays, $item->nodeValue);
    }
    return $arrayOfDays;
  }
  public function GetDates($CalenderPage)
  {
    $items = $this->getDOM($this->GetLinkToCalenders()."/".$CalenderPage)->query(' //th');
    $arrayOfDays = array();
    foreach ($items as $item) {
    array_push($arrayOfDays, $item->nodeValue);
    }
    return $arrayOfDays;
  }
}
