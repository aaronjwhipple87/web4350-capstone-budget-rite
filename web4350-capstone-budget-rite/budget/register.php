<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

?>

<?=template_header('Register');?>

<?=template_nav();?>

<section class="section">
    <div class="container">

    <form action="register.php" class="form">
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" placeholder="e.g. johndoe@gmail.com">
            </div>
        </div>
        <div class="field">
            <label class="label">First Name</label>
            <div class="control">
                <input class="input" type="text" placeholder="John">
            </div>
        </div>
        <div class="field">
            <label class="label">Last Name</label>
            <div class="control">
                <input class="input" type="text" placeholder="Doe">
            </div>
        </div>
        <div class="field">
            <label class="label">Phone Number</label>
            <div class="control">
                <input type="tel" class="input">
            </div>
        </div>
        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input type="password" class="input">
            </div>
        </div>
        <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
                <input type="password" class="input">
            </div>
        </div>
        <div class="field is-grouped">
            <p class="control">
                <a class="button is-primary">
                Register
                </a>
            </p>
            <p class="control">
                <a class="button is-light">
                Back
                </a>
            </p>
        </div>


    </form>
    </div>
</section>

<?=template_footer();?>