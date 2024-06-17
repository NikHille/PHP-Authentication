<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/Login.php';

session_start();

// check if csrf tokens match
if ($_SESSION['token'] !== $_POST['token']) {
    header('Location: /account/login?error=csrfmismatch');
    echo 'csrfmismatch';
    exit();
}

if (!Login::loginUser($_POST['email'], $_POST['pwd'])) {
    header('Location: /account/login?error=invalid');
    exit();
}

// login user and redirect to homepage
session_destroy();
session_start();
$_SESSION['isAuthenticated'] = TRUE;
header('Location: /');