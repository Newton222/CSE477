<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 1/30/2018
 * Time: 2:37 AM
 */

/**
 * Create an array that represents the cave
 * @returns Array
 */
function cave_array() {
    $cave = array(1 => array(5, 6, 2),
        2 => array(1, 8, 3),
        3 => array(2,10,4),
        4 => array(3,12,5),
        5 => array(1,14,4),
        6 => array(1,7,15),
        7 => array(8,7,16),
        8 => array(2,7,9),
        9 => array(8,17,10),
        10 => array(3,9,11),
        11 => array(10,18,12),
        12 => array(11,4,13),
        13 => array(19,12,14),
        14 => array(13,5,15),
        15 => array(6,14,20),
        16 => array(7,17,20),
        17 => array(9,16,18),
        18 => array(17,11,19),
        19 => array(20,18,13),
        20 => array(15,16,19));

    return $cave;
}


/**
 * Decide what text to print about birds
 * @param $room, the room number
 * @param $cave, the cave array
 * @param $birds, the room number that the birds in
 * @return string
 */
function hear_birds($room, $cave, $birds) {
    $html = '<p>';
    if ($cave[$room][0] == $birds or $cave[$room][1] == $birds or $cave[$room][2] == $birds) {
        $html .= "You hear birds!";
    } else {
        $html .= "&nbsp;";
    }
    $html .= '</p>';
    return $html;
}


/**
 * Decide what text to print about draft
 * @param $room, the room number
 * @param $cave, the cave array
 * @param $pits, the room number that pits are in
 * @return string
 */
function feel_draft($room, $cave, $pits) {
    $html = '<p>';
    if (in_array($cave[$room][0], $pits) or in_array($cave[$room][1], $pits) or in_array($cave[$room][2], $pits)) {
        $html .= "feel a draft!";
    } else {
        $html .= "&nbsp;";
    }
    $html .= '</p>';
    return $html;
}

/**
 * Decide what text to print about the wumpus
 * @param $room, the room number
 * @param $cave, the cave array
 * @param $wumpus, the room that the wumpus in
 * @return string
 */

function smell_wumpus($room, $cave, $wumpus) {
    $html = '<p>';
    $found = false;
    for ($i = 0; $i <= 2; $i++) {
        if ($cave[$room][$i] == $wumpus and !$found) {
            $found = true;
            $html .= "You smell a wumpus!";
            break;
        } else {
            $tmp = $cave[$room][$i];
            for ($j = 0; $j <= 2; $j++) {
                if ($cave[$tmp][$j] == $wumpus and !$found) {
                    $found = true;
                    $html .= "You smell a wumpus!";
                    break;
                }
            }
        }
    }
    if (!$found) {
        $html .= "&nbsp;";
    }
    $html .= '</p>';
    return $html;
}