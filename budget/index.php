<?php
include 'functions.php';

// Connect to MySQL
$pdo = pdo_connect_mysql();


?>

<?=template_header('Budget Rite');?>

<?=template_nav();?>

<!-- document main content goes here -->
<section class="section">
    <div class="container">
        <h1 class="title">Budget Application</h1>
    </div>
</section>

<?=template_footer();?>
