<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Signup';

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>

<main>
    <h1>Create an account</h1>

    <form class="form__register" action="/auth/signup.php" method="post">
        <fieldset class="emails">
            <label for="email">Enter your email</label>
            <input type="email" name="email" id="email">
            <label for="email_rpt">Repeat your email</label>
            <input type="email" name="email_rpt" id="email_rpt">
        </fieldset>
        <fieldset class="pwds">
            <label for="pwd">Enter your password</label>
            <input type="password" name="pwd" id="pwd">
            <label for="pwd_rpt">Repeat your password</label>
            <input type="password" name="pwd_rpt" id="pwd_rpt">
        </fieldset>
        <button type="submit">Signup</button>
    </form>

    <a href="/account/login">Already signed up? Login!</a>
</main>

<?php

require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php';