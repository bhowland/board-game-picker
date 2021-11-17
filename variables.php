<?php
    require 'curlFile.php';
    include 'validate.php';
    $gamelist = rest_call("GET","https://boardgamegeek.com/xmlapi2/collection?username=" . $user . "&excludesubtype=boardgameexpansion&preordered=0");
    $xmlGameList = simplexml_load_string($gamelist);
    $i = 0;
    $result_i = 0 ;
    $playerCount = 0;
    $SuggestedPlayerCount = 0;
    $highestRecommended = 0;
    foreach ($xmlGameList->item as $allGameItems ) {
        $i++;
    } 
    $slashFour = rand(0, ($i-1));     
