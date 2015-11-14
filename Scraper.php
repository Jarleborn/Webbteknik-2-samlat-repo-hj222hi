<?php
class Scraper{

  public $DOM;
  public $data;
  public $xpath;

  public function __construct(){

  }
  public function getURL()
  {
    //if(isset($_GET[URL])){
		//$var = "hoj";
		//echo "hoj";
    if(isset($_GET['URL'])){
		return $_GET['URL'];
    }
    return $_GET['URL'];
    //return "http://localhost:8080";
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
    //var_dump($files);
    $this->DOM = new DOMDocument();

    if ($this->DOM->loadHTML($this->getHTML($link))) {
      $this->xpath = new DOMXPath($this->DOM);

      return $this->xpath;
    }
    else {
      //die("hoj hoj nu blev det fel");
    }
  }

  public function getCalenderLinks(){
    $items = $this->getDOM($this->GetLinkToCalenders())->query('//ul //li //a');
    $arrayOfLinks = array();
    foreach ($items as $item) {
    array_push($arrayOfLinks, $item->getAttribute("href"));
    }
    //var_dump($arrayOfLinks);
    return $arrayOfLinks;
  }
  public function getMovieDayLink($theDaysThatWorks){
    $items = $this->getDOM($this->GetLinkToMovies())->query("//form /div /select[@id='day'] /option");
//  var_dump($theDaysThatWorks);
    $arrayOfLinks = array();
    foreach ($items as $item) {
  //  echo $item->nodeValue."";
    //echo $theDaysThatWorks[0]."<br />";
      if(in_array($item->nodeValue, $theDaysThatWorks)){

        array_push($arrayOfLinks, $item->getAttribute("value") );
      }
    //array_push($arrayOfLinks, $item->getAttribute("href"));
    }
  //  var_dump($arrayOfLinks);
    return $arrayOfLinks;
  }

  public function getMovieLink(){
    $items = $this->getDOM($this->GetLinkToMovies())->query("//div /div /form /select[@id='movie'] /option");
//  var_dump($theDaysThatWorks);
    $arrayOfLinks = array();
    $arrayOfNames = array();
    $arrayWithBothLinkAndNames = array();
    foreach ($items as $item) {
      //var_dump("<br />".$item->getAttribute("value")."<br />");
    array_push($arrayOfLinks, $item->getAttribute("value"));
    array_push($arrayOfNames, $item->nodeValue);
    }
    array_push($arrayWithBothLinkAndNames, $arrayOfLinks);
    array_push($arrayWithBothLinkAndNames, $arrayOfNames);
    //var_dump($arrayOfLinks);
    return $arrayWithBothLinkAndNames;
  }

  public function getMovieName(){
    $items = $this->getDOM($this->GetLinkToMovies())->query("//div /div /form /select[@id='movie'] /option");
//  var_dump($theDaysThatWorks);
    $arrayOfNames = array();
    foreach ($items as $item) {
      //var_dump("<br />".$item->getAttribute("value")."<br />");
    array_push($arrayOfNames, $item->nodeValue);
    }
    //var_dump($arrayOfLinks);
    return $arrayOfNames;
  }

  public function getMovies($daysOK, $movies)
  {

    $araryWithInfoAboutMoviesAndDates = array();
  //  var_dump($movies);
    foreach ($daysOK as $day) {
      foreach ($movies[0] as $movie) {
        //var_dump($movie);
        if (isset($movie)) {
          $var = $this->getHTML($this->GetLinkToMovies()."/check?day=".$day."&movie=".$movie);
          //var_dump($var);
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
    // echo "<pre>";
    //   print_r($arrayOfDays);
    // echo "</pre>";
    return $arrayOfDays;
  }
  public function GetDates($CalenderPage)
  {
    $items = $this->getDOM($this->GetLinkToCalenders()."/".$CalenderPage)->query(' //th');
    $arrayOfDays = array();
    foreach ($items as $item) {
    array_push($arrayOfDays, $item->nodeValue);
    }
    // echo "<pre>";
    //   print_r($arrayOfDays);
    // echo "</pre>";
    return $arrayOfDays;
  }
}
