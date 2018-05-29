<?php require('header.php'); ?>

<div class="content">
    <form action='../controller/signin.php' method='post'>
        Login <input type='text' name='login' /><br />
        Password <input type='password' name='password' /><br />
        Confirm Password <input type='password' name='confirm_password' /><br />
        <input type='submit' name='submit' value='OK' />
    </form>
</div>

<?php require('footer.php'); ?>