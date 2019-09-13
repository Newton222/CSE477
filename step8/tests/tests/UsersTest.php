<?php
require __DIR__ . "/../../vendor/autoload.php";
/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */

class EmailMock extends Felis\Email {
    public function mail($to, $subject, $message, $headers)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->message = $message;
        $this->headers = $headers;
    }

    public $to;
    public $subject;
    public $message;
    public $headers;
}

class UsersTest extends \PHPUnit_Extensions_Database_TestCase
{
    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

	/**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    public function getConnection()
    {

        return $this->createDefaultDBConnection(self::$site->pdo(), 'xuchensh');
    }


    public function test_construct() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }

    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);
        // Test user information
        $this->assertEquals('Dudess, The', $user->getName());
        $this->assertEquals(7, $user->getId());
        $this->assertEquals('dudess@dude.com', $user->getEmail());
        $this->assertEquals('Dudess Address', $user->getAddress());
        $this->assertEquals('111-222-3333', $user->getPhone());
        $this->assertEquals('Dudess Notes', $user->getNotes());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'),
            $user->getJoined());
        $this->assertEquals('S', $user->getRole());

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);
    }

    public function test_getid(){
        $users = new Felis\Users(self::$site);

        // Test a valid user id
        $user = $users->get(7);
        $this->assertInstanceOf('Felis\User', $user);
        // Test user information
        $this->assertEquals('Dudess, The', $user->getName());
        $this->assertEquals(7, $user->getId());
        $this->assertEquals('dudess@dude.com', $user->getEmail());
        $this->assertEquals('Dudess Address', $user->getAddress());
        $this->assertEquals('111-222-3333', $user->getPhone());
        $this->assertEquals('Dudess Notes', $user->getNotes());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'),
            $user->getJoined());
        $this->assertEquals('S', $user->getRole());

        // Test a valid user id
        $user = $users->get(10);
        $this->assertInstanceOf('Felis\User', $user);
        // Test user information
        $this->assertEquals('Simpson, Marge', $user->getName());
        $this->assertEquals(10, $user->getId());
        $this->assertEquals('marge@bartman.com', $user->getEmail());
        $this->assertEquals('', $user->getAddress());
        $this->assertEquals('', $user->getPhone());
        $this->assertEquals('', $user->getNotes());
        $this->assertEquals(strtotime('2015-02-01 01:50:26'),
            $user->getJoined());
        $this->assertEquals('C', $user->getRole());

        // Test a invalid user id
        $user = $users->get(6);
        $this->assertNull($user);

    }

    function test_update(){
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);
        // Test user information
        $this->assertEquals('Dudess, The', $user->getName());
        $this->assertEquals(7, $user->getId());
        $this->assertEquals('dudess@dude.com', $user->getEmail());
        $this->assertEquals('Dudess Address', $user->getAddress());
        $this->assertEquals('111-222-3333', $user->getPhone());
        $this->assertEquals('Dudess Notes', $user->getNotes());
        $this->assertEquals(strtotime('2015-01-22 23:50:26'),
            $user->getJoined());
        $this->assertEquals('S', $user->getRole());

        // Update user's information
        $user->setEmail("newEmail@mse.edu");
        $user->setName("new name");
        $user->setPhone("00000000");
        $user->setAddress("new address");
        $user->setNotes("new note");
        $user->setRole("C");

        $success = $users->update($user);
        $this->assertEquals(true, $success);

        // Log in
        // Test a valid login based on email address
        $user = $users->login("newEmail@mse.edu", "87654321");
        // Test user information
        $this->assertEquals('new name', $user->getName());
        $this->assertEquals('newEmail@mse.edu', $user->getEmail());
        $this->assertEquals('new address', $user->getAddress());
        $this->assertEquals('00000000', $user->getPhone());
        $this->assertEquals('new note', $user->getNotes());
        $this->assertEquals('C', $user->getRole());

        // When Email address conflict
        //Update user's information
        $user->setEmail("cbowen@cse.msu.edu");
        $user->setName("new name2");
        $user->setPhone("000000002");
        $user->setAddress("new address2");
        $user->setNotes("new note2");
        $user->setRole("A");

        $success = $users->update($user);
        $this->assertEquals(false, $success);

        // When id not exist
        $user = new \Felis\User(1);
        $success = $users->update($user);
        $this->assertEquals(false, $success);
    }

    public function test_exists() {
        $users = new Felis\Users(self::$site);

        $this->assertTrue($users->exists("dudess@dude.com"));
        $this->assertFalse($users->exists("dudess"));
        $this->assertFalse($users->exists("cbowen"));
        $this->assertTrue($users->exists("cbowen@cse.msu.edu"));
        $this->assertFalse($users->exists("nobody"));
        $this->assertFalse($users->exists("7"));
    }

    public function test_add() {
        $users = new Felis\Users(self::$site);

        $mailer = new EmailMock();

        $user7 = $users->get(7);
        $this->assertContains("Email address already exists",
            $users->add($user7, $mailer));
        $row = array('id' => 0,
            'email' => 'dude@ranch.com',
            'name' => 'Dude, The',
            'phone' => '123-456-7890',
            'address' => 'Some Address',
            'notes' => 'Some Notes',
            'password' => '12345678',
            'joined' => '2015-01-15 23:50:26',
            'role' => 'S'
        );
        $user = new Felis\User($row);
        $users->add($user, $mailer);

        $table = $users->getTableName();
        $sql = <<<SQL
select * from $table where email='dude@ranch.com'
SQL;

        $stmt = $users->pdo()->prepare($sql);
        $stmt->execute();
        $this->assertEquals(1, $stmt->rowCount());

        $this->assertEquals("dude@ranch.com", $mailer->to);
        $this->assertEquals("Confirm your email", $mailer->subject);
    }

    public function test_setPassword() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on user ID
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());

        // Change the password
        $users->setPassword(7, "dFcCkJ6t");

        // Old password should not work
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertNull($user);

        // New password does work!
        $user = $users->login("dudess@dude.com", "dFcCkJ6t");
        $this->assertNotNull($user);
        $this->assertEquals("Dudess, The", $user->getName());
    }

}

/// @endcond
