<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 2/7/2018
 * Time: 6:52 PM
 */

require 'lib/game.inc.php';
$controller = new Wumpus\WumpusController($wumpus, $_REQUEST);
if($controller->isReset()) {
    unset($_SESSION[WUMPUS_SESSION]);
}

if ($controller->isCheat()){
    unset($_SESSION[WUMPUS_SESSION]);
    $_SESSION[WUMPUS_SESSION] = new Wumpus\Wumpus(1422668587);
}

//echo "<p>" . $controller->getPage() . "</p>";
header('Location: ' . $controller->getPage());