<?php 
    // https://boardgamegeek.com/thread/2009486/using-api-get-game-weight
    require 'variables.php';
?>
<!DOCTYPE HTML>  
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.1">
        <!-- <link rel="stylesheet" href="style.css"> -->
    </head>
    <body>  
            <h2>No clue on what to play tonight let us choose for you</h2>
            <p id="intro">Enter your user name on BGG and we'll tell you what to play</p>
            <hr />
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                <input type="text" id="ZIPCode" name="Zip" placeholder="User name on BGG">
                <span class="error"><?php echo $userErr;?></span>
                <br />
                <input  id="getbutton" type="submit" name="submit" value="Submit">  
            </form>
            <hr />

            <p>Total games counted: <?= $i ?></p>
            <p id='city'>Today to are playing: 
                <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'> 
                    <?= $xmlGameList->item[$slashFour]->name ?>
                </a>
                <br />
                <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'>
                    <img src=" <?= $xmlGameList->item[$slashFour]->thumbnail ?>" />
                </a>
            </p>

            <p>Rating: <?= $highestRecommended ?></p>
            <div id="playerPolls" style="width:100%;display:flow-root;">
            <?php
                foreach ($xmlGameStatList->item->poll->results as $resultTotalCount) {
                    $result_i++;
                    $playerRankTotal=$resultTotalCount['numplayers'];
                    echo "<p style='max-width: 20%;float: left;display: inline;padding-right:1%'>Player count " . $playerRankTotal . "<br />";
                    foreach ($resultTotalCount->result as $result) {
                        echo $result->attributes()->value . " " . $result->attributes()->numvotes . "<br />";
                    }
                    echo "</p>";
                }  

                // while ( $result_i > ($xmlGameStatList->item->poll->results->attributes()->numplayers[$playerCount])){
                //     if ($xmlGameStatList->item->poll->results->attributes()->numplayers->result->attributes()->recommended > $highestRecommended) {
                //         $highestRecommended = $xmlGameStatList->item->poll->results->attributes()->numplayers->result->attributes()->recommended;
                //     }
                    // $playerCount++;
                    // echo "result count " . $result_i . " Player count " . $xmlGameStatList->item->poll->results->attributes()->numplayers . "<br />";
                    
                // }
                // else{continue;}
            ?>
            </div>
            <p><u>Your list</u></p>
        <?php
            foreach ($xmlGameList->item as $allGameItems ) { ?>
                <a href="https://boardgamegeek.com/<?= $allGameItems->attributes()->subtype ?> / <?= $allGameItems->attributes()->objectid ?> / <?= $allGameItems->name ?> " target="_blank"> <?= $allGameItems->name ?> </a> - 
                
                <?= $allGameItems->yearpublished ?> <br />
        <?php }  ?>
    </body>
</html>