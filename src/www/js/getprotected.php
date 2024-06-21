<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

// if unauthorized: return 403 and exit script
if (!$_SESSION['isAuthenticated']) {
    http_response_code(403);
    exit();
}


// check which file should be fetched
$jsFileName = $_GET['js'];

switch($jsFileName) {
    case 'bubble':
        $js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../protected/js/bubble.js');
        break;
    case 'libs/Bubble':
        $js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../protected/js/libs/Bubble.js');
        break;
    case 'libs/physics':
        $js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../protected/js/libs/physics.js');
        break;
    case 'libs/Vector2':
        $js = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../protected/js/libs/Vector2.js');
        break;
}


// returning file with correct MIME type
header('Content-type: application/javascript');
echo $js;