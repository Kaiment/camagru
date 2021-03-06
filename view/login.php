<?php require('header.php'); ?>

<div class='container content_auth'>
    <?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
        <p class='col-lg-6 offset-lg-3 success'>You are succesfully registered. A confirm mail has been sent to your email adress, click on the link you've received to confirm your account.</p>
    <?php elseif (isset($_GET['reset']) && $_GET['reset'] === 'success'): ?>
        <p class='col-lg-6 offset-lg-3 success'>Your password has been succesfully modified. You can now check your e-mails to get your new password and change it once loggued on.</p>
    <?php endif; ?>
    <div class='row'>
        <div class='col-lg-4 offset-lg-4'>
            <form class='auth_form' action='../controller/login.php' method='post'>
                <div class='auth_text'>
                    <h3>Log in</h3>
                    <h4>Gain access to your galerie.</h4>
                </div>
                <input class='col-lg-8 offset-lg-2' placeholder='LOGIN' id='login_co' type='text' name='login' /><br />
                <input class='col-lg-8 offset-lg-2' placeholder='PASSWORD' id='password_co' type='password' name='password' /><br />
                <a class='col-lg-6 offset-lg-6 forgot_pass' href='reset_password.php'>Mot de passe oublié</a><br />
                <input class='col-lg-6 offset-lg-3 menu_button' type='submit' name='submit' value='LOG IN' />
                <?php if (isset($_GET['log']) && $_GET['log'] === 'fail'): ?>
                    <p class='error'>Connexion failed. Please retry...</p>
                <?php endif; ?>
            </form>
        </div>
    </div>

    <div class='row'>
        <div class='col-lg-4 offset-lg-4'>
            <form id='auth_form' class='auth_form' action='../controller/signin.php' method='post'>
                <div class='auth_text'>
                    <h3>Sign up</h3>
                    <h4>Create an account to share your photos and videos.</h4>
                </div>
                <input class='col-lg-8 offset-lg-2' placeholder='EMAIL' id='email' type='email' name='email' />
                <input class='col-lg-8 offset-lg-2' placeholder='LOGIN' id='login' type='text' name='login' />
                <input class='col-lg-8 offset-lg-2' placeholder='PASSWORD' id='password1' type='password' name='password' />
                <input class='col-lg-8 offset-lg-2' placeholder='CONFIRM PASSWORD' id='confirm_password' type='password' name='confirm_password' />
                <input class='col-lg-6 offset-lg-3 menu_button' id='submit_register' type='submit' name='submit' value='REGISTER' />
                <?php if (isset($_GET['register']) && $_GET['register'] === 'incomplete'): ?>
                    <p class='error'>You have to complete every fields.</p>
                <?php elseif (isset($_GET['register']) && $_GET['register'] === 'confirm_fail'): ?>
                    <p class='error'>It seems like the 2 passwords you entered aren't the same. Please retry...</p>
                <?php elseif (isset($_GET['register']) && $_GET['register'] === 'invalid_pw'): ?>
                    <p class='error'>Your password doesn't match the requirements. Please retry...</p>
                <?php elseif (isset($_GET['register']) && $_GET['register'] === 'forbidden'): ?>
                    <p class='error'>Your login or e-mail is already taken, please retry...</p>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>

<script type='text/javascript' src='../public/js/login.js'></script>
<script type='text/javascript' src='../public/js/check_pw_requirements.js'></script>
<?php require('footer.php'); ?>