<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/include/User.php';


class UserTest extends TestCase
{
    public function testForExistingUser()
    {
        $users = array(
            "lastIndex" => 0,
            "0" => array(
                "email" => "test@example.com",
                "pwdhash" => "$2y$10\$anXIfsYXtK7GYHceQ95rWed8U3Y5FFb3orBVAJwxFyo3xy4U3LtDm"
            )
        );

        $existingEmail = 'test@example.com';
        $newEmail = 'test2@example.com';

        $user = new User($users);

        // test if user exists in given users object
        $result = $user->checkForExistingUser($existingEmail);
        $this->assertTrue($result);

        // test if user is NOT already in users object
        $result = $user->checkForExistingUser($newEmail);
        $this->assertNotTrue($result);
    }
}
