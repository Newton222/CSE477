<?php
/**
 * Created by PhpStorm.
 * User: newto
 * Date: 2/7/2018
 * Time: 6:57 PM
 */

namespace Wumpus;


class WumpusController
{
    /**
     * Constructor
     * @param Wumpus $wumpus The Wumpus object
     * @param $request The $_REQUEST array
     */
    public function __construct(Wumpus $wumpus, $request) {
        $this->wumpus = $wumpus;

        if(isset($request['m'])) {
            $this->move($request['m']);
        } else if(isset($request['s'])) {
            $this->shoot($request['s']);
        } else if(isset($request['n'])) {
            // New game!
            $this->cheat = false;
            $this->reset = true;
        } else if(isset($request['c'])) {
            $this->cheat = true;
            //$this->reset = true;
            //$this->wumpus = new wumpus(1422668587);
        }

    }

    public function isReset(){
        return $this->reset;
    }

    public function getPage(){
        return $this->page;
    }

    /** Move request
     * @param $ndx Index for room to move to */
    private function move($ndx) {
        // Simple error check
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        switch($this->wumpus->move($ndx)) {
            case Wumpus::HAPPY:
                break;

            case Wumpus::EATEN:
            case Wumpus::FELL:
                $this->reset = true;
                $this->page = 'lose.php';
                break;
        }
    }

    /** Shoot request
     * @ndx Index for room to shoot to */
    private function shoot($ndx) {
        // Simple error check
        if(!is_numeric($ndx) || $ndx < 1 || $ndx > Wumpus::NUM_ROOMS) {
            return;
        }

        if ($this->wumpus->shoot($ndx)){
            $this->reset = true;
            $this->page = 'win.php';
        }
    }

    public function isCheat(){
        return $this->cheat;
    }

    private $wumpus;                // The Wumpus object we are controlling
    private $page = 'game.php';     // The next page we will go to
    private $reset = false;         // True if we need to reset the game
    private  $cheat = false;
}