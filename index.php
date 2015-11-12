<?php
  include_once 'Scraper.php';
  include_once 'Controller.php';


  error_reporting(E_ALL);
  ini_set('display_errors', 'on');

  //phpinfo();
  $scrape = new Scraper();
  $Controller = new Controller($scrape);

  
 ?>
