<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Login';

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>


<main>
    <h1>Login</h1>

    <form class="form__login" action="/auth/login.php" method="post">
        <fieldset class="emails">
            <div class="form-input">
                <label for="email">Enter your email</label>
                <input type="email" name="email" id="email" autocomplete="username" placeholder="Enter your email">
            </div>
        </fieldset>
        <fieldset class="pwds">
            <div class="form-input">
                <label for="pwd">Enter your password</label>
                <input type="password" name="pwd" id="pwd" autocomplete="password" placeholder="Enter your password">
            </div>
        </fieldset>
        <button type="submit">Login</button>
    </form>

    <a href="/account/signup">Create an account!</a>
</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php'; ?>

</body>
</html>