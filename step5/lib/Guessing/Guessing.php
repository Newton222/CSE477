<?php

namespace Guessing;


class Guessing
{
    const MIN = 1;
    const MAX = 100;

    const INVALID = 0;
    const TOOLOW = 1;
    const TOOHIGH = 2;
    const CORRECT = 3;
    const NOTGUESSED = 4;

    public function __construct($seed = null) {
        if($seed === null) {
            $seed = time();
        }

        srand($seed);
        $this->number = rand(self::MIN, self::MAX);
        $this->numGuesses = 0;
        $this->guessed = false;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getNumGuesses() {
        return $this->numGuesses;
    }

    public function getGuess() {
        return $this->guessInput;
    }

    public function check() {
        //echo 'guessed is' . $this->guessed;
        //echo 'guessed number is' . $this->guessInput;
        //echo 'correct number is' . $this->number;
        //echo 'number of guess is' . $this->numGuesses;
        if (!$this->guessed) {
            return Guessing::NOTGUESSED;
        }

        if (!is_numeric($this->guessInput) or $this->guessInput > Guessing::MAX or $this->guessInput < Guessing::MIN) {
            return Guessing::INVALID;
        }

        if ($this->guessInput < $this->number) {
            return Guessing::TOOLOW;
        } elseif ($this->guessInput > $this->number) {
            return Guessing::TOOHIGH;
        } elseif ($this->guessInput == $this->number) {
            return Guessing::CORRECT;
        }
    }

    public function guess($input) {
        if (is_numeric($input) and $input <= Guessing::MAX and $input >= Guessing::MIN) {
            $this->numGuesses ++;
        }
        $this->guessInput = $input;
        $this->guessed = true;
    }

    private $number;
    private $numGuesses;
    private $guessInput;
    private $guessed; // boolean that indicate if guessed

}