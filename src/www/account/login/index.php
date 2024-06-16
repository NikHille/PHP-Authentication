<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Login';

$_SESSION['isAuthenticated'] = true;

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>


<main>
    <h1>Login</h1>

    <form class="form__login" action="/auth/login" method="post">
        <fieldset class="emails">
            <label for="email">Enter your email</label>
            <input type="email" name="email" id="email">
        </fieldset>
        <fieldset class="pwds">
            <label for="pwd">Enter your password</label>
            <input type="password" name="pwd" id="pwd">
        </fieldset>
        <button type="submit">Login</button>
    </form>

    <a href="/account/signup">Create an account!</a>
</main>

<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php';
