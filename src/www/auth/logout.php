<?php
// Logging user out and redirecting to hompage
session_start();
session_destroy();

header('Location: /');