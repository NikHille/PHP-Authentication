<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/include/Login.php';
require_once __DIR__ . '/../src/include/User.php';


class LoginTest extends TestCase
{
    public function testIfUserAdded()
    {
        $users = array(
            "lastIndex" => 0,
            "0" => array(
                "email" => "test@example.com",
                "pwdhash" => "$2y$10\$anXIfsYXtK7GYHceQ95rWed8U3Y5FFb3orBVAJwxFyo3xy4U3LtDm"
            )
        );
        $user = new User($users);
        $email = 'test2@example.com';
        $pwdHashed = '$2y$10\$anXIfsYXtK7GYHceQ95rWed8U3Y5FFb3orBVAJwxFyo3xy4U3LtDm';

        // test if user exists in given users object
        $user->addUser($email, $pwdHashed);
        $this->assertArrayHasKey('1', $user->getUsers());
    }
}
