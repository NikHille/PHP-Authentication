<?php

session_start();

require $_SERVER['DOCUMENT_ROOT'] . '/../include/Signup.php';

$emailVerified = Signup::verifyEmail($_POST['email'], $_POST['email_rpt']);
$pwdVerified = Signup::verifyPassword($_POST['pwd'], $_POST['pwd_rpt']);

if (!$emailVerified || !$pwdVerified) {
    header('Location: /account/signup?error=invalidinput');
    exit();
}

$signup = Signup::createUser($_POST['email'], $_POST['pwd']);

if (!$signup) {
    header('Location: /account/signup?error=emailinuse');
    exit();
}

// login user and redirect to homepage
$_SESSION['isAuthenticated'] = TRUE;
header('Location: /');