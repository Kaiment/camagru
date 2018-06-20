<?php require('header.php'); ?>

<div class="container-fluid content">
    <div class="row">
        <div class="col-lg-2 offset-lg-3 control_bar">
            <div class="row"><a href="/view/account.php?edit_profile=y" class="col-lg-12 control_bar_button">EDIT LOGIN</a></div>
            <div class="row"><a href="/view/account.php?edit_email=y" class="col-lg-12 control_bar_button">CHANGE E-MAIL ADDRESS</a></div>
            <div class="row"><a href="/view/account.php?edit_password=y" class="col-lg-12 control_bar_button">CHANGE PASSWORD</a></div>
        </div>
        <div class="col-lg-4 content_container">
            <?php if (isset($_GET['edit_profile'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">Login</h5>
                        <input class="col-lg-7" type="text" name="login" value="<?= htmlspecialchars($_SESSION['loggued']); ?>" />
                    </div>
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">Password</h5>
                        <input class="col-lg-7" type="password" name="password" />
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form>
            <?php elseif (isset($_GET['edit_email'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">New e-mail</h5>
                        <input class="col-lg-7" type="email" name="new_email" value="<?= htmlspecialchars($_SESSION['email']); ?>" />
                    </div>
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">Password</h5>
                        <input class="col-lg-7" type="password" name="password" />
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form>
                <?php if (isset($_GET['edit_email']) && $_GET['edit_email'] == 'fail'): ?>
                    <p class='error'>Password is incorrect or e-mail already exists.</p>
                <?php elseif (isset($_GET['edit_email']) && $_GET['edit_email'] == 'success'): ?>
                    <p class='success'>E-mail update successful.</p>
                <?php endif; ?>
            <?php elseif (isset($_GET['edit_password'])): ?>
                <form class="auth_form" action="../controller/edit_profile.php" method="post">
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">Old Password</h5>
                        <input class="col-lg-7" type="password" name="old_pw" />
                    </div>
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">New Password</h5>
                        <input class="col-lg-7" type="password" name="new_pw" />
                    </div>
                    <div class="row">
                        <h5 class="col-lg-3 offset-lg-1">Confirm password</h5>
                        <input class="col-lg-7" type="password" name="confirm_new_pw" />
                    </div>
                    <input class="menu_button" type="submit" value="UPDATE" />
                </form> 
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require('footer.php'); ?>