<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 2/6/2018
 * Time: 3:25 PM
 */

namespace Wumpus;

class WumpusView
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     */
    public function __construct(Wumpus $wumpus) {
        $this->wumpus = $wumpus;
    }

    /** Generate the HTML for the number of arrows remaining */
    public function presentArrows() {
        $a = $this->wumpus->numArrows();
        return "<p>You have $a arrows remaining.</p>";
    }

    public function presentStatus() {
        $html = "<div class=\"textBelowImg\">";

        $roomnum = $this->wumpus->getCurrent()->getNum();
        $html .= "<p>You are in room $roomnum</p>";

        if ($this->wumpus->hearBirds()){
            $html .= "<p>You hear birds!</p>";
        }

        if ($this->wumpus->feelDraft()){
            $html .= "<p>You feel a draft!</p>";
        }

        if ($this->wumpus->smellWumpus()){
            $html .= "<p>You smell a wumpus!</p>";
        }

        if ($this->wumpus->wasCarried()){
            $html .= "<p>You are carried by the birds</p>";
        }

        $html .= "</div>";

        return $html;
    }

    /** Present the links for a room
     * @param $ndx An index 0 to 2 for the three rooms */
    public function presentRoom($ndx) {
        $room = $this->wumpus->getCurrent()->getNeighbors()[$ndx];
        $roomnum = $room->getNum();
        $roomndx = $room->getNdx();
        $roomurl = "game-post.php?m=$roomndx";
        $shooturl = "game-post.php?s=$roomndx";

        $html = <<<HTML
<div class="room">
  <figure><img src="cave2.jpg" width="180" height="135" alt=""/></figure>
  <p><a href="$roomurl">$roomnum</a></p>
<p><a href="$shooturl">Shoot Arrow</a></p>
</div>
HTML;

        return $html;
    }

    private $wumpus;    // The Wumpus object
}