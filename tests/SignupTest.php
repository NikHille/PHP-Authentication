<?php

use PHPUnit\Framework\TestCase;

require(__DIR__ . '/../src/include/Signup.php');


class SignupTest extends TestCase
{
    public function testForValidEmail()
    {
        $email = 'name@example.com';
        $emailWrong = 'example.com';

        $result = Signup::verifyEmail($email, $email);
        $this->assertTrue($result);

        $result = Signup::verifyEmail($email, $emailWrong);
        $this->assertNotTrue($result);
    }


    public function testForEmailEquality()
    {
        $email = 'test@example.com';
        $emailRptWrong = 'tset@example.com';

        $resultEqual = Signup::verifyEmail($email, $email);
        $this->assertTrue($resultEqual);

        $resultNotEqual = Signup::verifyEmail($email, $emailRptWrong);
        $this->assertNotTrue($resultNotEqual);
    }


    public function testForValidPwd()
    {
        // test for valid password
        $pwd = 'Test123*';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertTrue($result);

        // test for password shorter than 8 characters
        $pwd = 'Test12*';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertNotTrue($result);

        // test for missing uppsercase letter
        $pwd = 'test123*';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertNotTrue($result);

        // test for missing lowercase letter
        $pwd = 'TEST123*';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertNotTrue($result);

        // test for missing number
        $pwd = 'TestTest*';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertNotTrue($result);

        // test for missing special character
        $pwd = 'Test1234';
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertNotTrue($result);
    }


    public function testForPasswordEquality()
    {
        $pwd = 'Test123*';
        $pwdWrong = 'Tset123*';

        // test for equal passwords
        $result = Signup::verifyPassword($pwd, $pwd);
        $this->assertTrue($result);

        $result = Signup::verifyPassword($pwd, $pwdWrong);
        $this->assertNotTrue($result);
    }


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

        // test if user exists in given users object
        $result = Signup::checkForExistingUser($users, $existingEmail);
        $this->assertTrue($result);

        // test if user is NOT already in users object
        $result = Signup::checkForExistingUser($users, $newEmail);
        $this->assertNotTrue($result);
    }
}
