<?php

session_start();

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/Login.php';

if (!Login::loginUser($_POST['email'], $_POST['pwd'])) {
    header('Location: /account/login?error=invalid');
    exit();
}

// login user and redirect to homepage
$_SESSION['isAuthenticated'] = TRUE;
header('Location: /');