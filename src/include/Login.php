<?php

require_once __DIR__ . '/User.php';

class Login
{      
    public static function loginUser($email, $pwd)
    {
        $user = new User();
        if (!$user->checkForExistingUser($_POST['email'])) return FALSE;
        if (!password_verify($pwd, $user->getPwdHash($email))) return FALSE;
        return TRUE;
    }
}
