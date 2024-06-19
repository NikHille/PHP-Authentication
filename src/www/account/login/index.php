<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Login';

// create csrf token for the form
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>


<main class="centered">
    <h1>Login</h1>

    <div class="content-tile centered">
        <form class="form__login" action="/auth/login.php" method="post">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <fieldset class="emails">
                <div class="form-input">
                    <label for="email">Enter your email</label>
                    <input type="email" name="email" id="email" autocomplete="username">
                </div>
            </fieldset>
            <fieldset class="pwds">
                <div class="form-input">
                    <label for="pwd">Enter your password</label>
                    <input type="password" name="pwd" id="pwd" autocomplete="password">
                </div>
            </fieldset>
            <button class="default" type="submit">Login</button>
        </form>
    
        <a href="/account/signup" title="Link: Signup Page">No account? Create one!</a>
    </div>
    
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php'; ?>

<script src="/js/login.js"></script>

</body>
</html>