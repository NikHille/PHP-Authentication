<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Homepage';

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>

<main>
    
    <?php if ($_SESSION['isAuthenticated']) :

    include $_SERVER['DOCUMENT_ROOT'] . '/../components/pages/homepage.php';
    
    else: ?>
    
    <h1>Welcome to the PHP Authentication!</h1>

    <div class="content-tile">
        <p>You need to <a href="/account/login" title="Link: Login Page">login</a> so you can see everything.</p>
    </div>

    <?php endif; ?>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php'; ?>

</body>
</html>