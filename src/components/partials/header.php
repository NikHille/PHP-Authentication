<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    
<header>
    <a href="/">Home</a>

    <?php if ($_SESSION['isAuthenticated']): ?>
    <a href="/auth/logout.php"><button>Logout</button></a>
    <?php else: ?>
    <a href="/account/login"><button>Login</button></a>
    <?php endif; ?>
</header>