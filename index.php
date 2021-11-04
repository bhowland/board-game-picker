<?php 
    // TODO 
    // Add player count &stats=1 <stats minplayers="2" maxplayers="4" minplaytime="60" maxplaytime="60" playingtime="60" numowned="69100">
    // Add time range ie I want to play this long &stats=1
    // coop vs competive 
    // add expantions options
    // a ban list
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
            foreach ($xmlGameList->item as $allGameItems ) {
                $i++;
            }    
        ?>

        <?php
            $slashFour = rand(0, ($i-1));
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

            echo "<p><u>Your list</u></p>";

            foreach ($xmlGameList->item as $allGameItems ) {
                echo "<a href='https://boardgamegeek.com/" . $allGameItems->attributes()->subtype . "/" . $allGameItems->attributes()->objectid . "/" . $allGameItems->name . "' target='_blank'>" . $allGameItems->name . "</a> - ";
                
                echo $allGameItems->yearpublished, '<br /> ';
            }  
        ?>
    </body>
</html>