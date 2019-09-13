<?php

require __DIR__ . "/../../vendor/autoload.php";

use Guessing\Guessing as Guessing;
use Guessing\GuessingController as Controller;

/** @file
 * Unit tests for the class GuessingController
 */
class GuessingControllerTest extends \PHPUnit_Framework_TestCase {
    const SEED = 1234;

    public function test_reset() {
        $guessing = new Guessing(self::SEED);
        $controller = new Controller($guessing, array('value' => 12));
        $this->assertFalse($controller->isReset());
        $this->assertEquals(12, $controller->getValue());

        $guessing = new Guessing(self::SEED);
        $controller = new Controller($guessing, array('clear' => 'New Game'));
        $this->assertTrue($controller->isReset());
    }

}
/// @endcond
