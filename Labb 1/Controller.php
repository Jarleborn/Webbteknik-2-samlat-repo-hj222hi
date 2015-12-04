<?php
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
      echo "<meta charset='UTF-8'>";
      echo "<form method='posst'>
      <input type='text' name='URL' /><br/>
					<input id='submit' type='submit' name='stuff'  value='Kolla upp stuff' />
          </form>
          ";

  		$this->init();

    }

    public function init()
    {
      $DAysThatWork = $this->scrape->getMovieDayLink($this->compare->compareDatesAndGetbestDay($this->scrape->getThePersonsDates($this->scrape->getCalenderLinks())));
      $ArrayWithMoviesAndTimes = $this->scrape->getMovies($DAysThatWork,  $this->scrape->getMovieLink());
      $this->view->renderOutTheInformation($ArrayWithMoviesAndTimes);
      $this->view->renderoutresturnetInfo($this->scrape->getFreeDaysAtTheResturant());

    }
  }
