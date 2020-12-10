<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

?>

<?=template_header('Login');?>

<?=template_nav();?>

<section class="section">
    <div class="container">
    <form action="login.php" class="form">
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" placeholder="e.g. alexsmith@gmail.com">
            </div>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input class="input" type="password" name="password" placeholder="****">
            </div>
        </div>
        <div class="field">
            <p class="control">
                <button class="button">Login</button>
                <button class="button" href="register.php">Register</button>
            </p>
        </div>
        
    </form>
    <a href="">Forgot Password?</a>
    </div>
</section>

<?=template_footer();?>