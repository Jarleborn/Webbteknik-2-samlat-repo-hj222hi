<?php
  /**
   *
   */
  class Controller
  {
    public $scrape;
    public $compare;
    function __construct(Scraper $scrape, compare $compare)
    {
      $this->compare = $compare;
      $this->scrape = $scrape;
      $this->getLinksToCallenders();
    }

    public function getLinksToCallenders()
    {
      $this->compare->compareDatesAndGetbestDay($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks()));

      print_r($this->compare->compareDatesAndGetbestDay($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks())));
      // echo "<pre>";
      //   print_r($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks()));
      // echo "</pre>";
    }
  }
