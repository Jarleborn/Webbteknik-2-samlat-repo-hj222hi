<?php
  /**
   *
   */
  class Controller
  {
    public $scrape;
    public $compare;
    public $view;

    function __construct(Scraper $scrape, compare $compare, View $view)
    {
      $this->compare = $compare;
      $this->scrape = $scrape;
      $this->view = $view;

      echo "<form method='posst'>
      <input type='text' name='URL' /><br/>
					<input id='submit' type='submit' name='stuff'  value='Kolla upp stuff' />
          </form>
          ";

  		$this->init();

    }

    public function init()
    {

      //  var_dump();
      $DAysThatWork = $this->scrape->getMovieDayLink($this->compare->compareDatesAndGetbestDay($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks())));;
      $var2 = $this->scrape->getMovieLink();
      $this->view->renderOutTheInformation($this->scrape->getMovies($DAysThatWork,  $this->scrape->getMovieLink()));
      //print_r($this->compare->compareDatesAndGetbestDay($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks())));
      // echo "<pre>";
      //   print_r($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks()));
      // echo "</pre>";

  }
  }
