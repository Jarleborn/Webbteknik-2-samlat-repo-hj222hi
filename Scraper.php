<?php
class Scraper{

  public $DOM;
  public $data;
  public $xpath;

  public function __construct(){

  }
  public function getURL()
  {
    return "http://localhost:8080";
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
      die("hoj hoj nu blev det fel");
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
    echo $item->nodeValue."";
    echo $theDaysThatWorks[0]."<br />";
      if(in_array($item->nodeValue, $theDaysThatWorks)){

        array_push($arrayOfLinks, $item->nodeValue );
      }
    //array_push($arrayOfLinks, $item->getAttribute("href"));
    }
    var_dump($arrayOfLinks);
    return $arrayOfLinks;
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
    $items = $this->getDOM("http://localhost:8080/calendar/".$CalenderPage)->query(' //td');
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
    $items = $this->getDOM("http://localhost:8080/calendar/".$CalenderPage)->query(' //th');
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
