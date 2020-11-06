<?php
include 'functions.php';

?>

<?=template_header('Account');?>

<?=template_nav();?>

<!-- document main content goes here -->
<section class="section">
    <div class="container">
        <h1 class="title">My Account</h1>
        <h2>Username</h2>
        <div class="columns">
            <div class="column">
                <div>
                    <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart orange">
                            <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">30%</text>
                        </svg>
                    </div>
                    <h3>Income</h3>

                </div>
            </div>
            <div class="column">
                <div>
                    <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart green">
                            <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="60, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">60%</text>
                        </svg>
                    </div>
                    <h3>Savings</h3>

                </div>
            </div>
            <div class="column">
                <div>
                    <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart blue">
                            <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="90, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">90%</text>
                        </svg>
                    </div>
                    <h3>Debt</h3>

                </div>
            </div>
        </div>
    </div>
</section>

<?=template_footer();?>

<div class="flex-wrapper">





</div>