<?php
// Creating session and setting default settings if needed
session_start();

if (!isset($_SESSION['isAuthenticated'])) $_SERVER['isAuthenticated'] = FALSE;