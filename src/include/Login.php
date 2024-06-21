<?php

require_once __DIR__ . '/User.php';

class Login
{    
    /**
     * Checking if the email exists and verifying the password.
     * @param  string $email The email entered by the user.
     * @param  string $pwd The password entered by the user.
     * @return boolean Returns TRUE if email exists and the password matches the stored hash, otherwise returns FALSE.
     */
    public static function loginUser($email, $pwd)
    {
        $user = new User();
        if (!$user->checkForExistingUser($_POST['email'])) return FALSE;
        if (!password_verify($pwd, $user->getPwdHash($email))) return FALSE;
        return TRUE;
    }
}
