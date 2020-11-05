<?php
include 'functions.php';
$msg = "";

if(isset($_POST["submit"])){

    //field validations
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $msg = 'Email is not valid';
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }

    //validate account exists, if so resend activation code
}
?>

<?=template_header('Forgot Password');?>

<?=template_nav();?>

    <section class="section">
        <div class="container">
            <h1 class="title">
                Forgot Password?
            </h1>
            <form action="forgot.php" method="post">
                <div class="field">
                    <label class="label">Enter your email:</label>
                    <div class="control">
                        <input class="input" name="email" type="email" placeholder="e.g. johndoe@gmail.com" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-link">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>

<?=template_footer();?>