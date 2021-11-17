<?php 
if($whileLoop_i == 0){ ?>
<p id='city'>Today you are playing: 
<?php } ?>
<?php if($whileLoop_i >= 1){ ?>
<p id='city'>OR maybe you are playing: 
<?php } ?>
    <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'> 
        <?= $xmlGameList->item[$slashFour]->name ?>
    </a>
</p>
<p>
    <a href='https://boardgamegeek.com/<?= $xmlGameList->item[$slashFour]->attributes()->subtype ?>/<?= $xmlGameList->item[$slashFour]->attributes()->objectid ?>/<?= $xmlGameList->name ?>' target='_blank'>
        <img src=" <?= $xmlGameList->item[$slashFour]->thumbnail ?>" />
    </a>
</p>