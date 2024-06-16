<?php

class Signup
{      
    /**
     * Verifying valid email adress. Checking if valid email adress and if email and email_rpt are equal.
     * @param  string $email The given email address.
     * @return bool Returns TRUE if valid email, otherwise FALSE.
     */
    public static function verifyEmail($email, $email_rpt) : bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return FALSE;
        if ($email !== $email_rpt) return FALSE;
        return TRUE;
    }

    
    /**
     * Verifying valid password. Checking for occuring characters and minimum length.
     * @param  string $pwd The password chosen by the user.
     * @param  string $pwd_rpt The repeated password of the user.
     * @return bool Returning TRUE if checks pass, otherwise FALSE.
     */
    public static function verifyPassword($pwd, $pwd_rpt) : bool
    {
        $minLength = 8;
        $expressions = array(
            '/[A-Z]/', '/[a-z]/', '/[0-9]/', '/[*$%!^]/'
        );
        if (strlen($pwd) < $minLength) return FALSE;
        for ($i = 0; $i < count($expressions); $i++) {
            if (!preg_match($expressions[$i], $pwd)) return FALSE;
        }
        if ($pwd !== $pwd_rpt) return FALSE;
        return TRUE;
    }

    
    /**
     * Creating user from given email and password.
     * @param  string $email New users email address.
     * @param  string $pwd User password.
     * @return bool Returns TRUE on success, else FALSE.
     */
    public static function createUser($email, $pwd) : bool
    {
        $usersJsonPath = $_SERVER['DOCUMENT_ROOT'] . '/../include/users.json';
        
        // read json
        $jsonString = file_get_contents($usersJsonPath);
        $users = json_decode($jsonString, true);

        // check if email already exists
        if (Signup::checkForExistingUser($users, $email)) {
            echo 'User already exists!<br>';
            return FALSE;
        }

        // hash password
        $pwdHashed = password_hash($pwd, PASSWORD_DEFAULT);
        echo $pwdHashed;

        // add user to users.json
        $users[++$users['lastIndex']] = array(
            'email' => $email,
            'pwdhash' => $pwdHashed
        );

        // write updated users to users.json
        file_put_contents($usersJsonPath, json_encode($users));

        return TRUE;
    }

    
    /**
     * Checking given user object for given email.
     * @param  array $users User object.
     * @param  string $email Email to be searched for.
     * @return bool Returns TRUE if user already exists, otherwise FALSE.
     */
    public static function checkForExistingUser($users, $email) : bool
    {
        foreach ($users as $key => $value) {
            if ($key === 'lastIndex') continue;
            if ($value['email'] === $email) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
