<?php

/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
require __DIR__ . "/../../vendor/autoload.php";

use Guessing\GuessingView as GuessingView;
use Guessing\Guessing as Guessing;

class GuessingViewTest extends \PHPUnit_Framework_TestCase
{
    const SEED = 1234;

	public function test_construct() {
        $guessing = new Guessing(self::SEED);
        $guessingView = new GuessingView($guessing);

        $this->assertContains("Try to guess the number.", $guessingView->present());

	}

	public function test_test_invalids() {
        $guessing = new Guessing(self::SEED);
        $guessingView = new GuessingView($guessing);

        $this->assertContains("Try to guess the number.", $guessingView->present());

        // Try invalid guess
        $guessing->guess(0);    // Below minimum
        $this->assertContains("Your guess of 0 is invalid!", $guessingView->present());

        // Try invalid guess
        $guessing->guess(101);    // Above maximum
        $this->assertContains("Your guess of 101 is invalid!", $guessingView->present());

        // Try invalid guesses - not a number
        $guessing->guess("garbage");    // Garbage
        $this->assertContains("Your guess of garbage is invalid!", $guessingView->present());

    }

    public function test_game() {
        $guessing = new Guessing(self::SEED);
        $guessingView = new GuessingView($guessing);

        $guessing->guess(18);
        $this->assertContains("After 1 guesses you are too low!", $guessingView->present());

        $guessing->guess(55);
        $this->assertContains("After 2 guesses you are too high!", $guessingView->present());

        $guessing->guess(23);
        $this->assertContains("After 3 guesses you are correct!", $guessingView->present());

    }
}

/// @endcond
