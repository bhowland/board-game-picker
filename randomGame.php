<?php 
function getRandomGame($i, $xmlGameList, $result_i){
    $whileLoop_i=0; 
    while ( $whileLoop_i <= 2 ) { 
        $slashFour = rand(0, ($i-1));
        if($whileLoop_i == 0){ 
        ?>
            <p id='city'>Today you are playing: 
        <?php
        }
        if($whileLoop_i >= 1){ 
        ?>
            <p id='city'>OR maybe you are playing: 
        <?php 
        } 
        ?>
                <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'> 
                     <?= $xmlGameList->item[$slashFour]->name ?>
                </a>
            </p>
            <p>
                <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'>
                    <img src=" <?= $xmlGameList->item[$slashFour]->thumbnail ?>" />
                </a>
            </p>

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
    <?php
    $whileLoop_i++; 
    }
    ?>
<?php 
}
?>
