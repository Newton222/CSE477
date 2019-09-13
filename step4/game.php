<?php
require 'format.inc.php';
require 'lib/game.inc.php';
$view = new Wumpus\WumpusView($wumpus);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="game.css" type="text/css" rel="stylesheet" />
    <title>Stalking the Wumpus</title>
</head>

<body>

<?php echo present_header("Stalking the Wumpus"); ?>

<div class="game">
    <div class="topImg">
        <img src="cave.jpg" width="600" height="325" alt="cave">

        <div class="textBelowImg">
            <?php
            echo $view->presentStatus();
            ?>
        </div>
    </div>


    <div class="rooms">
        <?php
        echo $view->presentRoom(0);
        echo $view->presentRoom(1);
        echo $view->presentRoom(2);
        ?>

    </div>

    <div class="textBelowImg">
        <?php
        echo $view->presentArrows();
        ?>
    </div>
</div>

</body>
</html>