<?php require_once('header.php'); ?>

<div class='container content_auth'>
    <div class='row'>
        <div class='col-lg-4 offset-lg-4'>
            <form class='auth_form' action='../controller/reset_password.php' method='post'>
                <div class='auth_text'>
                    <h3>Reset password</h3>
                    <h4>Please enter your email address. You'll get a new password by e-mail</h4>
                </div>
                <input class='col-lg-8 offset-lg-2' placeholder='EMAIL ADDRESS' id='email' type='text' name='email' /><br />
                <input class='col-lg-6 offset-lg-3 menu_button' type='submit' name='submit' value='RESET PASSWORD' />
                <?php if (isset($_GET['reset']) && $_GET['reset'] === 'fail'): ?>
                    <p class='error'>It seems like the e-mail address you entered does not exist.</p>
                <?php elseif (isset($_GET['reset']) && $_GET['reset'] === 'empty'): ?>
                    <p class='error'>Please enter an email in the field.</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>