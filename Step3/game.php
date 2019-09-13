<?php
require 'format.inc.php';
require 'wumpus.inc.php';

$room = 1; // The room we are in.;
$birds = 7;  // Room with the birds
$wumpus = 16;

$cave = cave_array(); // Get the cave
$pits = array(3, 10, 13);    // Rooms with a bottomless pit

if(isset($_GET['r']) && isset($cave[$_GET['r']])) {
    // We have been passed a room number
    $room = $_GET['r'];
}

if(isset($_GET['a']) && isset($cave[$_GET['a']])) {
    // We have been passed a room number
    $arrow = $_GET['a'];
    if ($arrow == $wumpus){
        header("Location: win.php");
        exit;
    }
}

if ($room  == $birds) {
    $room = 10;
}

if (in_array($room, $pits) or $room == $wumpus){
    header("Location: lose.php");
    exit;
}
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
            echo '<p>' . date("g:ia l, F j, Y") . '</p>';
            ?>
            <p>You are in room <?php echo $room; ?></p>
        </div>




        <div class="textBelowImg">
            <?php
            echo hear_birds($room, $cave, $birds);

            echo feel_draft($room, $cave, $pits);

            echo smell_wumpus($room, $cave, $wumpus);
            ?>
        </div>
    </div>


    <div class="rooms">
        <div class="room">
            <p><img src="cave2.jpg" width="180" height="135" alt="cave2"></p>
            <p><a href="game.php?r=<?php echo $cave[$room][0]; ?>">
                    <?php echo $cave[$room][0]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][0]; ?>">
                    ShootArrow</a></p>
        </div>
        <div class="room">
            <p><img src="cave2.jpg" width="180" height="135" alt="cave2"></p>
            <p><a href="game.php?r=<?php echo $cave[$room][1]; ?>">
                    <?php echo $cave[$room][1]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][1]; ?>">
                    ShootArrow</a></p>
        </div>
        <div class="room">
            <p><img src="cave2.jpg" width="180" height="135" alt="cave2"></p>
            <p><a href="game.php?r=<?php echo $cave[$room][2]; ?>">
                    <?php echo $cave[$room][2]; ?></a></p>
            <p><a href="game.php?r=<?php echo $room; ?>&a=<?php echo $cave[$room][2]; ?>">
                    ShootArrow</a></p>
        </div>
    </div>

    <div class="textBelowImg">
        <p>You have 3 arrows remaining.</p>
    </div>
</div>

</body>
</html>