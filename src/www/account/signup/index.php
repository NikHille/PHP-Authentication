<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/../include/session.php';

$pageTitle = 'Signup';

// create csrf token for the form
$_SESSION['token'] = md5(uniqid(mt_rand(), true));

?>


<!-- CONTENT -->

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/header.php'; ?>

<main class="centered">
    <h1>Create an account</h1>

    <div class="content-tile centered">
        <form class="form__register" action="/auth/signup.php" method="post">
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <fieldset class="emails">
                <div class="form-input">
                    <label for="email">Enter your email</label>
                    <input required="required" type="email" name="email" id="email" autocomplete="username">
                </div>
                <div class="form-input">
                    <label for="email_rpt">Repeat your email</label>
                    <input required="required" type="email" name="email_rpt" id="email_rpt" autocomplete="off">
                </div>
            </fieldset>
            <fieldset class="pwds">        
                <div class="form-input">
                    <label for="pwd">Enter your password</label>
                    <input required="required" type="password" name="pwd" id="pwd" autocomplete="new-password">
                </div>
                <div class="form-input">
                    <label for="pwd_rpt">Repeat your password</label>
                    <input required="required" type="password" name="pwd_rpt" id="pwd_rpt" autocomplete="new-password">
                </div>
            </fieldset>
            <details>
                <summary>Password Requirements</summary>
                <ul>
                    <li>at least 8 characters</li>
                    <li>lower case character</li>
                    <li>upper case character</li>
                    <li>number</li>
                    <li>*, $, %, !, ^ or #</li>
                </ul>
            </details>
            <button class="default" type="submit">Signup</button>
        </form>

        <a href="/account/login" title="Link: Login Page">Already signed up? Login!</a>
    </div>

</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/../components/partials/footer.php'; ?>

<script src="/js/signup.js"></script>

</body>
</html>