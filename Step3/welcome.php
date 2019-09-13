<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="game.css" type="text/css" rel="stylesheet" />
    <title>Welcome to Stalking the Wumpus</title>
</head>

<body>

<?php echo present_header("Stalking the Wumpus"); ?>

<div class="game">
    <div class="topImg">
        <img src="cave-evil-cat.png" width="600" height="325" alt="cave evil cat">

        <div class="textBelowImg">
            <p>Welcome to <a class="style1">Stalking the Wumpus</a></p>
        </div>

        <div class="textBelowImg">
            <p><a href="instructions.php">Instructions</a> </p>
        </div>

        <div class="textBelowImg">
            <p><a href="game.php">Start Game</a> </p>
        </div>
    </div>
</div>

</body>
</html>