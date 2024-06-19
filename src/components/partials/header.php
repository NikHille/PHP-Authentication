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
    <div class="header-content">
        <a class="header-title" href="/">Authentication Webapp</a>
    
        <?php if ($_SESSION['isAuthenticated']): ?>
        <a href="/auth/logout.php">Logout</a>
        <?php else: ?>
        <a href="/account/login" title="Link: Login Page">Login</a>
        <?php endif; ?>
    </div>
</header>
