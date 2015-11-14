<?php
  /**
   *
   */
  class View
  {
    public function renderOutTheInformation($infoToRender){

      //TODO: Inoutfält

      echo "<ul>";
      for ($i=0; $i < count($infoToRender) ; $i++) {
        if($infoToRender[$i]['day'] == 01){
          $day = "Fredag";
        }
        elseif($infoToRender[$i]['day'] == 02){
          $day = "Lördag";
        }
        elseif($infoToRender[$i]['day'] == 03){
          $day = "Söndag";
        }
        echo "<li>Filmen ".$infoToRender[$i]['movieName']." klockan ".$infoToRender[$i]['time']." på ".$day." <a href='#'> Välj denna och boka bord</a></li> <br />";

      }
      echo "</ul>";

    }
  }
