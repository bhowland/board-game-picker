<?php 
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
                <input type="text" id="userID" name="ID" placeholder="User name on BGG">
                <span class="error"><?php echo $userErr;?></span>
                <br />
                <input  id="getbutton" type="submit" name="submit" value="Submit">  
            </form>
            <hr />
            <?php 
                getRandomGame($i, $xmlGameList, $result_i);
                
                if(array_key_exists('hateButton', $_POST)) {
                    getRandomGame($i, $xmlGameList, $result_i);
                }
            ?>
            <form method="post">
                <input type="submit" name="hateButton" class="button" value="New choices" />
            </form>
            <p><u>Your list of a total: <?= $i ?></u></p>
            <?php
                foreach ($xmlGameList->item as $allGameItems ) { ?>
                    <a href="https://boardgamegeek.com/<?= $allGameItems->attributes()->subtype ?>/<?= $allGameItems->attributes()->objectid ?>/<?= $allGameItems->name ?> " target="_blank"><?= $allGameItems->name ?></a> - 
                    <?= $allGameItems->yearpublished ?> <br />
            <?php }  ?>
        </body>
</html>