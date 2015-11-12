<?php
  include_once 'Scraper.php';
  include_once 'Controller.php';
  include_once 'Compare.php';

  error_reporting(E_ALL);
  ini_set('display_errors', 'on');

  //phpinfo();
  $Compare = new Compare();
  $scrape = new Scraper();
  $Controller = new Controller($scrape, $Compare);


 ?>
