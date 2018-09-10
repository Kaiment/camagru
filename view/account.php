<?php require('header.php'); ?>

<div class="container-fluid content">
    <div class="row">
        <div class="col-lg-2 offset-lg-3 control_bar">
            <div class="row"><a href="/view/account.php?edit_profile=y" class="col-lg-12 control_bar_button">EDIT LOGIN</a></div>
            <div class="row"><a href="/view/account.php?edit_email=y" class="col-lg-12 control_bar_button">CHANGE E-MAIL ADDRESS</a></div>
            <div class="row"><a href="/view/account.php?edit_password=y" class="col-lg-12 control_bar_button">CHANGE PASSWORD</a></div>
            <div class="row"><a href="/view/account.php?edit_notif=y" class="col-lg-12 control_bar_button">EDIT NOTIF</a></div>
        </div>
        <div class="col-lg-4 content_container">
            <?php if (isset($_GET['edit_profile'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <label for='login' class="col-lg-3 offset-lg-1">Login</label>
                        <input class="col-lg-7" type="text" id='login' name="login" value="<?= htmlspecialchars($_SESSION['loggued']); ?>" />
                    </div>
                    <div class="row">
                        <label for='password' class="col-lg-3 offset-lg-1">Password</label>
                        <input class="col-lg-7" type="password" id='password' name="password" />
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form>
            <?php elseif (isset($_GET['edit_email'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <label for='email' class="col-lg-3 offset-lg-1">New e-mail</label>
                        <input class="col-lg-7" type="email" id='email' name="new_email" value="<?= htmlspecialchars($_SESSION['email']); ?>" />
                    </div>
                    <div class="row">
                        <label for='password' class="col-lg-3 offset-lg-1">Password</label>
                        <input class="col-lg-7" type="password" id='password' name="password" />
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form>
                <?php if (isset($_GET['edit_email']) && $_GET['edit_email'] == 'fail'): ?>
                    <p class='error'>Password is incorrect or e-mail already exists.</p>
                <?php elseif (isset($_GET['edit_email']) && $_GET['edit_email'] == 'success'): ?>
                    <p class='success'>E-mail update successful.</p>
                <?php endif; ?>
            <?php elseif (isset($_GET['edit_password'])): ?>
                <form class="auth_form" id='auth_form' action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <label for='old_pw' class="col-lg-3 offset-lg-1">Old Password</label>
                        <input class="col-lg-7" type="password" id='old_pw' name="old_pw" />
                    </div>
                    <div class="row">
                        <label for='new_pw' class="col-lg-3 offset-lg-1">New Password</label>
                        <input id='password1' class="col-lg-7" type="password" id='new_pw' name="new_pw" />
                    </div>
                    <div class="row">
                        <label for='confirm' class="col-lg-3 offset-lg-1">Confirm password</label>
                        <input class="col-lg-7" type="password" id='confirm' name="confirm_new_pw" />
                    </div>
                    <input id='submit_register' class="menu_button" type="submit" value="UPDATE" />
                </form> 
            <?php elseif (isset($_GET['edit_notif'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <?php
                        require("../controller/Controller_users.class.php");
                        $controller_user = new Controller_users();
                        $notif_enabled = $controller_user->notif_enabled_by_userid($_SESSION['user_id']);
                    ?>
                    <div class='row'>
                        <input id="notif_e" type="radio" name="notif" value='1' <?= $notif_enabled ? 'checked' : ''; ?> >
                        <label for="notif_e">Notifications enabled</label>
                    </div>
                    <div class='row'>
                        <input id="notif_d" type="radio" name="notif" value='0' <?= $notif_enabled ? '' : 'checked'; ?> >
                        <label for="notif_d">Notifications disabled</label>
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type='text/javascript' src='../public/js/check_pw_requirements.js'></script>
<?php require('footer.php'); ?>