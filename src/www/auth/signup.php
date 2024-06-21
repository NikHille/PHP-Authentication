<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../include/Signup.php';

session_start();

// check for secure connection or local
$whitelist = array('127.0.0.1', 'localhost');
if (!(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')) {
    if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
        header('Location: /account/signup?error=insecureconnection');
        exit();
    }
}

// check if csrf tokens match
if ($_SESSION['token'] !== $_POST['token']) {
    header('Location: /account/signup?error=csrfmismatch');
    exit();
}

$emailVerified = Signup::verifyEmail($_POST['email'], $_POST['email_rpt']);
$pwdVerified = Signup::verifyPassword($_POST['pwd'], $_POST['pwd_rpt']);

// if email or password are not valid, return error
if (!$emailVerified || !$pwdVerified) {
    header('Location: /account/signup?error=invalidinput');
    exit();
}

$signup = Signup::createUser($_POST['email'], $_POST['pwd']);

// if email signup failed, return error
if (!$signup) {
    header('Location: /account/signup?error=emailinuse');
    exit();
}

// login user and redirect to homepage
session_destroy();
session_start();
$_SESSION['isAuthenticated'] = TRUE;
header('Location: /');