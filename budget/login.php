<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

?>

<?=template_header('Register');?>

<?=template_nav();?>

<section class="section">
    <div class="container">
    <form action="login.php" class="form">
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" name="email" placeholder="e.g. johndoe@gmail.com">
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
                <button class="button is-success">Login</button>
                <button class="button is-primary" href="register.php">Register</button>
            </p>
        </div>
        
    </form>
    <a href="">Forgot Password?</a>
    </div>
</section>

<?=template_footer();?>