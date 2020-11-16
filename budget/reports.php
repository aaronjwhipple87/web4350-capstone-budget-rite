<?php
require 'functions.php';
require 'session.php';
$msg = "";





?>

<?=template_header('Reports');?>

<?=template_nav();?>

<!-- document main content goes here -->
<section class="section">
    <div class="container">
        <h1 class="title">Reports</h1>
        <div class="columns">
            <div class="column">
                <h3>Planned</h3>
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart brown">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">30%</text>
                    </svg>
                </div>
<!--                <h3>Income Type</h3>-->
<!--                <p></p>-->
<!--                <h3>Name</h3>-->
<!--                <p></p>-->
<!--                <h3>Amount</h3>-->
<!--                <p></p>-->
            </div>
            <div class="column">
                <h3>Spent</h3>
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">30%</text>
                    </svg>
                </div>
                <!--                <h3>Income Type</h3>-->
                <!--                <p></p>-->
                <!--                <h3>Name</h3>-->
                <!--                <p></p>-->
                <!--                <h3>Amount</h3>-->
                <!--                <p></p>-->
            </div>
            <div class="column">
                <h3>Remaining</h3>
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <text x="18" y="20.35" class="percentage">30%</text>
                    </svg>
                </div>
                <!--                <h3>Income Type</h3>-->
                <!--                <p></p>-->
                <!--                <h3>Name</h3>-->
                <!--                <p></p>-->
                <!--                <h3>Amount</h3>-->
                <!--                <p></p>-->
            </div>
<!--            <div class="column">-->
<!--                <h2>Enter Report</h2>-->
<!--                <form action="">-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="reportType" class="label">Report Type</label>-->
<!--                            <input type="text" class="input" name="reportType">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="name" class="label">Name</label>-->
<!--                            <input type="text" class="input" name="name">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="amount" class="label">Amount</label>-->
<!--                            <input type="number" class="input" name="amount">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <button type="submit" class="button is-success" name="submit">Submit</button>-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!---->
<!---->
<!---->
<!--                </form>-->
<!--            </div>-->
        </div>
    </div>
</section>

<?=template_footer();?>