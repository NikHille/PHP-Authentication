<?php

use PhpParser\Node\Expr\Cast\Array_;

class User
{
    protected string $usersJsonPath;
    private array $users;

    public function __construct($users = 0)
    {
        $this->usersJsonPath = __DIR__ . '/users.json';
        if ($users !== 0) {
            $this->users = $users;
        } else {
            $this->loadUsers();
        }
    }

    
    /**
     * Load users from users.json and add to users property.
     * @return void
     */
    private function loadUsers()
    {
        $jsonString = file_get_contents($this->usersJsonPath);
        $this->users = json_decode($jsonString, true);
    }

    
    /**
     * Save users array to file.
     * @return void
     */
    private function setUsers()
    {
        file_put_contents($this->usersJsonPath, json_encode($this->users));
    }


    public function getUsers()
    {
        return $this->users;
    }


    public function getPwdHash($email)
    {
        foreach ($this->users as $key => $value) {
            if ($key === 'lastIndex') continue;
            if ($value['email'] === $email) {
                return $value['pwdhash'];
            }
        }
    }
    
    
    /**
     * Checking given user object for given email.
     * @param  array $users User object.
     * @param  string $email Email to be searched for.
     * @return bool Returns TRUE if user already exists, otherwise FALSE.
     */
    public function checkForExistingUser($email) : bool
    {
        foreach ($this->users as $key => $value) {
            if ($key === 'lastIndex') continue;
            if ($value['email'] === $email) {
                return TRUE;
            }
        }
        return FALSE;
    }

    
    /**
     * Adding user to users array.
     * @param  mixed $email Email for new user.
     * @param  mixed $pwdHashed Hashed Password for new user.
     * @return void
     */
    public function addUser($email, $pwdHashed)
    {
        $this->users[++$this->users['lastIndex']] = array(
            'email' => $email,
            'pwdhash' => $pwdHashed
        );
        $this->setUsers();
    }
}