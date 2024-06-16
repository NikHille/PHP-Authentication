<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Homepage';

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>

<main>
    <h1>Welcome to the PHP Authentication!</h1>
    
    <?php if ($_SESSION['isAuthenticated']) : ?>
    <p>You are now LOGGED IN! :)</p>
    <?php else: ?>
    <p>You need to login so you can see everything.</p>
    <?php endif; ?>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php'; ?>

</body>
</html>