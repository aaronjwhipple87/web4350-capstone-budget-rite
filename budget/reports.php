<?php
require 'functions.php';
require 'session.php';
$msg = "";


//finds all budget names, amounts, and arithmetic to calculate remaining total.
$sql = $con->prepare("SELECT budgetID, budgetName, plannedAmount, appliedAmount, (plannedAmount - appliedAmount) as resultAmount
FROM budgets
WHERE userId = ? and published = 1");
$sql->bind_param("i", $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$budgets = $result->fetch_all(MYSQLI_ASSOC);

//calculates sum of all amounts
$sql2 = $con->prepare("SELECT SUM(plannedAmount) as plannedSum, SUM(appliedAmount) as appliedSum, SUM(plannedAmount - appliedAmount) as resultSum
FROM budgets
WHERE userId = ? and published = 1");
$sql2->bind_param("i", $_SESSION['id']);
$sql2->execute();
$result2 = $sql2->get_result();
$budgets2 = $result2->fetch_all(MYSQLI_ASSOC);

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
                    <?php $percentage1 = 100;
                ?>
                    <svg viewBox="0 0 36 36" class="circular-chart brown">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <path class="circle" stroke-dasharray="<?=$percentage1;?>, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
          <?php foreach($budgets2 as $row):?>
                        <text x="18" y="20.35" class="percentage"><?=$row['plannedSum']?></text>
          <?php endforeach;?>
                    </svg>
                </div>
                <?php foreach ($budgets as $row): ?>

                <p><?=$row['budgetName'];?></p>

                <p><?=$row['plannedAmount'];?></p>
                <br>
                <?php endforeach;?>
                <?php foreach ($budgets2 as $row):?>
                <h3>Total</h3>
                <p><?=$row["plannedSum"];?></p>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h3>Spent</h3>
                <div class="single-chart">
                    <?php foreach($budgets2 as $row):
                if ($row['plannedSum'] == 0) {
                    $percentage2 = 0;
                } else {
                    $percentage2 = $row['appliedSum'] / $row['plannedSum'] * 100;
                }
            endforeach;
                ?>
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />

                        <path class="circle" stroke-dasharray="<?=$percentage2;?>, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />

          <?php foreach($budgets2 as $row):?>
                        <text x="18" y="20.35" class="percentage"><?=$row['appliedSum']?></text>
          <?php endforeach;?>
                    </svg>
                </div>
                <?php foreach ($budgets as $row):?>

                <p><?=$row['budgetName'];?></p>

                <p><?=$row['appliedAmount'];?></p>
                <br>
                <?php endforeach;?>
                <?php foreach ($budgets2 as $row):?>
                <h3>Total</h3>
                <p><?=$row["appliedSum"];?></p>
                <?php endforeach; ?>
            </div>
            <div class="column">
                <h3>Remaining</h3>
                <div class="single-chart">
                    <?php foreach($budgets2 as $row):
                if ($row['plannedSum'] == 0) {
                    $percentage3 = 0;
                } else {
                    $percentage3 = $row['resultSum'] / $row['plannedSum'] * 100;
                }
            endforeach;
                ?>
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                        <path class="circle-bg" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <?php foreach($budgets2 as $row):?>
                        <path class="circle" stroke-dasharray="<?=$percentage3;?>, 100" d="M18 2.0845
          a 15.9155 15.9155 0 0 1 0 31.831
          a 15.9155 15.9155 0 0 1 0 -31.831" />
                        <?php endforeach; ?>
                        <?php foreach($budgets2 as $row):?>
                        <text x="18" y="20.35" class="percentage"><?=$row['resultSum']?></text>
          <?php endforeach;?>
                    </svg>
                </div>
                <?php foreach($budgets as $row):?>
                <p><?=$row['budgetName'];?></p>

                <p><?=$row['resultAmount'];?></p>
                <br>
                <?php endforeach;?>
                <?php foreach ($budgets2 as $row):?>
                <h3>Total</h3>
                <p><?=$row["resultSum"];?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<?=template_footer();?>