<?php
  /**
   *
   */
  class Controller
  {
    public $scrape;
    function __construct(Scraper $scrape)
    {
      $this->scrape = $scrape;
      $this->getLinksToCallenders();
    }

    public function getLinksToCallenders()
    {
      $this->scrape->getThePersonsDates($this->scrape->getCalenderLinks());

      echo "<pre>";
        print_r($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks()));
      echo "</pre>";
    }
  }
