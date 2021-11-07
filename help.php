<?php
    /////////////// TEST ////////////////////////////
    echo "ID: " . $gameIdNumber . "<br />"; 
    echo "result count: " . $result_i . "<br />";
    echo "Player count: " . $playerRankTotal . "<br />";
    echo "Link to Stats: <a href=https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1 target='_blank'>https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1</a> <br />";
    echo "Collection of: <a href=https://boardgamegeek.com/xmlapi2/collection?username=" . $user . "&excludesubtype=boardgameexpansion&preordered=0 target='_blank'>". $user . "</a><br />";
    echo "player count: " . $xmlGameStatList->item->poll->results->attributes()->numplayers . "<br />";
    /////////////////////////////////////////////////////
?>