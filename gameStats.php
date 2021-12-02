<?php
    $gameIdNumber = $xmlGameList->item[$slashFour]->attributes()->objectid;
    $gameStatList = rest_call("GET","https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1");
    $xmlGameStatList = simplexml_load_string($gameStatList);
?>
    <p>
        Rating: <?= $xmlGameStatList->item->statistics->ratings->average->attributes()->value  ?>
    <br />
        Weight: <?= $xmlGameStatList->item->statistics->ratings->averageweight->attributes()->value   ?>
    </p>
        <div id="playerPolls" style="width:100%;display:flow-root;">
        <?php
            $test = $xmlGameStatList->item->poll->results;
            // $limitIterator = new LimitIterator($test);

            foreach ($test as $resultTotalCount) {
                $result_i++;
                $playerRankTotal=$resultTotalCount['numplayers'];
                echo "<p style='max-width: 30%;float: left;display: inline;padding-right:1%'>Player count " . $playerRankTotal . "<br />";
                foreach ($resultTotalCount->result as $result) {
                    echo $result->attributes()->value . " " . $result->attributes()->numvotes . "<br />";
                }
                echo "</p>";
            }  
        ?>
    </div>