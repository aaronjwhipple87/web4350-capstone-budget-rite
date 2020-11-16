<?php
include 'functions.php';

?>

<?=template_header('Budget Rite');?>

<?=template_nav();?>

<!-- document main content goes here -->
<section class="section homePage">
    <div class="container">
        <h1 class="title">Budget Application</h1>
        <div class="columns">
            <div class="column">
                <div class="register">
                    <h2>To Register for an account, click the button below</h2>
                    <button class="button" href="register.php">Register</button>
                </div>
            </div>
        </div>
        <div class="columns circles">
            <div class="column">
            <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart blue">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">100% Free</text>
                    </svg>
                </div>
                <p>No payments necessary</p>
            </div>
            <div class="column">
            <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart blue">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">Works Offline</text>
                    </svg>
                </div>
                <p>Great to use offline <br> in case you lose internet <br> connection</p>
            </div>
            <div class="column">
            <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart blue">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="100, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">Simple</text>
                    </svg>
                </div>
                <p>Easy to utilize</p>
            </div>
        </div>
    </div>
</section>

<?=template_footer();?>
