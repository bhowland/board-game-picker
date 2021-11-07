<?php 
    // TODO 
    // Add player count &stats=1 <stats minplayers="2" maxplayers="4" minplaytime="60" maxplaytime="60" playingtime="60" numowned="69100">
    // Add time range ie I want to play this long &stats=1
    // coop vs competive 
    // add expantions options
    // a ban list
    // statistics->ratings->average['value'], 1);
    // https://boardgamegeek.com/thread/2009486/using-api-get-game-weight
    require 'curlFile.php';
    include 'validate.php'
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

        <?php
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
        ?>

        <?php
            $slashFour = rand(0, ($i-1));
            
            $gameIdNumber = $xmlGameList->item[$slashFour]->attributes()->objectid;
            $gameStatList = rest_call("GET","https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1");
            $xmlGameStatList = simplexml_load_string($gameStatList);

            foreach ($xmlGameStatList->item->poll->results as $resultTotalCount) {
                $result_i++;
                $playerRankTotal=$resultTotalCount['numplayers'];
                echo "result count " . $result_i . " Player count " . $playerRankTotal . "<br />";
                foreach ($resultTotalCount->result as $result) {
                    echo $result->attributes()->value . " " . $result->attributes()->numvotes . "<br />";
                }
                echo "<br />";
            }  

            // while ( $result_i > ($xmlGameStatList->item->poll->results->attributes()->numplayers[$playerCount])){
            //     if ($xmlGameStatList->item->poll->results->attributes()->numplayers->result->attributes()->recommended > $highestRecommended) {
            //         $highestRecommended = $xmlGameStatList->item->poll->results->attributes()->numplayers->result->attributes()->recommended;
            //     }
                // $playerCount++;
                // echo "result count " . $result_i . " Player count " . $xmlGameStatList->item->poll->results->attributes()->numplayers . "<br />";
                
            // }
            // else{continue;}
            /////////////// TEST ////////////////////////////
            echo "ID: " . $gameIdNumber . "<br />"; 
            echo "result count: " . $result_i . "<br />";
            echo "Player count: " . $playerRankTotal . "<br />";
            echo "Link to Stats: <a href=https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1 target='_blank'>https://boardgamegeek.com/xmlapi2/thing?id=" . $gameIdNumber . "&stats=1</a> <br />";
            echo "Collection of: <a href=https://boardgamegeek.com/xmlapi2/collection?username=" . $user . "&excludesubtype=boardgameexpansion&preordered=0 target='_blank'>". $user . "</a><br />";
            echo "player count: " . $xmlGameStatList->item->poll->results->attributes()->numplayers . "<br />";
            /////////////////////////////////////////////////////

            echo "<p>Total games counted:" . $i . "</p>";
            echo "<p id='city'>Today to are playing: 
                <a href='https://boardgamegeek.com/" . $xmlGameList->item[$slashFour]->attributes()->subtype . "/" . $xmlGameList->item[$slashFour]->attributes()->objectid . "/" . $xmlGameList->name . "' target='_blank'>" 
                    . $xmlGameList->item[$slashFour]->name . "
                </a>
                <br />
                <a href='https://boardgamegeek.com/" . $xmlGameList->item[$slashFour]->attributes()->subtype . "/" . $xmlGameList->item[$slashFour]->attributes()->objectid . "/" . $xmlGameList->name . "' target='_blank'>
                    <img src=" . $xmlGameList->item[$slashFour]->thumbnail . " />
                </a>
            </p>";

            echo "<p>Rating:" . $highestRecommended . "</p>";

            echo "<p><u>Your list</u></p>";

            foreach ($xmlGameList->item as $allGameItems ) {
                echo "<a href='https://boardgamegeek.com/" . $allGameItems->attributes()->subtype . "/" . $allGameItems->attributes()->objectid . "/" . $allGameItems->name . "' target='_blank'>" . $allGameItems->name . "</a> - ";
                
                echo $allGameItems->yearpublished, '<br /> ';
            }  
        ?>
    </body>
</html>