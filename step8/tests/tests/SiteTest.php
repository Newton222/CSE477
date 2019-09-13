<?php
require __DIR__ . "/../../vendor/autoload.php";
/** @file
 * Empty unit testing template
 * @cond 
 * Unit tests for the class
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{
	public function test1() {
		//$this->assertEquals($expected, $actual);
	}

	public function test_GetterSetter(){
	    $site = new \Felis\Site();

	    $site->setEmail('123@123.com');
        $this->assertEquals('123@123.com', $site->getEmail());

        $site->setRoot('123123123');
        $this->assertEquals('123123123', $site->getRoot());

        $site->dbConfigure('host','user','password','prefix');
        $this->assertEquals('prefix', $site->getTablePrefix());
    }

    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test8_', $site->getTablePrefix());
    }
}

/// @endcond
