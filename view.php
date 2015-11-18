<?php

  class View
  {
    public function renderOutTheInformation($infoToRender){
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

    public function renderoutresturnetInfo($resturntTImeAndDays)
    {
      echo "Ni kan ju bara Lördag och då kan man gå på resturang följande tider";
      for ($i =0; $i < count($resturntTImeAndDays[0]); $i++) {
        echo "<br />";
        echo "klockan ".$resturntTImeAndDays[$i][1];
      }
      echo "<br />";echo "<br />";echo "<br />";echo "<br />";echo "<br />";
      echo "Sen har ju Donken öppet dygnet runt typ.....";
    }
  }
