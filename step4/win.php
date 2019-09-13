<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="game.css" type="text/css" rel="stylesheet" />
    <title>You Killed the Wumpus</title>
</head>

<body>

<?php echo present_header("Stalking the Wumpus"); ?>

<div class="game">
    <div class="topImg">
        <img src="dead-wumpus.jpg" width="600" height="325" alt="dead wumpus">
    </div>

    <div class="textBelowImg">
        <p>You killed the Wumpus</p>
    </div>

    <div class="textBelowImg">
        <a href="welcome.php">New Game</a>
    </div>
</div>
</body>
</html>