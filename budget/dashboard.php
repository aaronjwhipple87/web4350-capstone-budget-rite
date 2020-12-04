<?php
require 'functions.php';
require 'session.php';
$msg = "";

// get user info from db
$sql = $con->prepare('SELECT firstName, lastName FROM users WHERE userId = ?');

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$sql->bind_result($firstName, $lastName);
$sql->fetch();
$sql->close();


// get top 10 transactions from db
$sql = $con->prepare("
SELECT 
	t.transactionName, t.transactionType, b.budgetName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate
FROM transactions t
INNER JOIN
    budgets b 
    on t.budgetID = b.budgetID
WHERE b.userId = ?
    AND t.published = 1
ORDER BY 
	transactionDate DESC
LIMIT 10
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

// get transaction type totals
$sql = $con->prepare("
SELECT t.transactionType, SUM(t.transactionAmount) AS transactionTypeSum
FROM transactions t
INNER JOIN
    budgets b 
    on t.budgetID = b.budgetID
WHERE b.userId = ?
    AND t.published = 1
GROUP BY
	t.transactionType
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$transactionTypeTotals = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

// get budget totals
$sql = $con->prepare("
SELECT b.budgetName, SUM(t.transactionAmount) as budgetSum
FROM transactions t
INNER JOIN
    budgets b 
    on t.budgetID = b.budgetID
WHERE b.userId = ?
    AND t.published = 1
GROUP BY
	b.budgetName
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$budgetTotals = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

// google chart query
$sql = $con->prepare("
SELECT
    expenses.transactionDate as transactionDate,
    IFNULL(income.income, 0) as income,
    IFNULL(expenses.expenses, 0) as expenses
FROM
(
        SELECT
            DATE_FORMAT(t.transactionDate, '%b, %D') as transactionDate, 
            SUM(t.transactionAmount) as expenses
	    FROM
	        transactions as t
        LEFT JOIN
            budgets as b on t.budgetID = b.budgetID
        WHERE
            b.userID = ?
            AND t.published = 1
            AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
            AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
            AND t.transactionType != 'Income'
            AND t.transactionType != 'Savings'
        GROUP BY
            DATE_FORMAT(t.transactionDate, '%b, %D')
    ) as expenses
LEFT JOIN
    (
        SELECT
            DATE_FORMAT(t.transactionDate, '%b, %D') as transactionDate, 
            SUM(t.transactionAmount) as income
	    FROM
	        transactions as t
	    LEFT JOIN
		    budgets as b on t.budgetID = b.budgetID
	    WHERE
            b.userID = ?
            AND t.published = 1
            AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
            AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
            AND t.transactionType = 'Income'
            OR t.transactionType = 'Savings'
        GROUP BY
            DATE_FORMAT(t.transactionDate, '%b, %D')
    ) as income
    
ON expenses.transactionDate = income.transactionDate
");

$sql->bind_param('ss', $_SESSION['id'], $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$chartTransactions = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();
?>



<?=template_header('Dashboard');?>

<?=template_nav();?>

<?=template_menu();?>

<div class="column">
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-three-quarters">
                <h1 class="title">Welcome, <?=$firstName?> <?=$lastName?>!</h1>
                <p class="subtitle">Here is your monthly review for : <span class="has-text-weight-bold"> <?= date("F, Y") ?> </span></p>
            </div>
            <div class="column">
                <a href="addTrans.php" class="button is-primary is-outlined">Add Transaction</a>
                <a href="addBudget.php" class="button is-primary is-outlined">Create Budget</a>
            </div>
        </div>
    </div>
</section>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Date', 'Income', 'Expenses'],
                <?php foreach ($chartTransactions as $row): ?>
                    ["<?=$row['transactionDate']?>", <?=$row['income']?>, <?=abs($row['expenses'])?>],
                <?php endforeach;?>
            ]);

            var options = {
                curveType: 'function',
                legend: { position: 'bottom' },
                animation: {
                    startup: true,
                    duration: 500,
                    easing: 'in',
                },
                vAxis: {
                    format: 'currency',
                },
                series: {
                    0: { color: '#298046'},
                    1: { color: '#f14668'},
                }
            };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        }
    </script>
<div class="section">
    <div class="container">
        <p class="title">Monthly Income & Expenses: </p>
        <div class="card" id="curve_chart"></div>
    </div>
</div>
</section>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="card is-fullheight">
                    <div class="card-header is-justify-content-center">
                        <p class="title has-text-centered m-2">Category Totals</p>
                    </div>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile has-text-centered">
                            <?php foreach ($transactionTypeTotals as $row): ?>
                            <div class="column is-half">
                                <p class="has-text-weight-bold is-size-5"><?= $row['transactionType'] ?></p>
                            </div>
                            <div class="column is-half">
                                <p class="is-size-5">$<?= $row['transactionTypeSum'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column has-text-centered">
                <div class="card is-fullheight">
                    <div class="card-header is-justify-content-center">
                        <p class="title m-2">Budget Totals</p>
                    </div>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile has-text-centered">
                            <?php foreach ($budgetTotals as $row): ?>
                            <div class="column is-half">
                                <p class="has-text-weight-bold is-size-5"><?= $row['budgetName'] ?></p>
                            </div>
                            <div class="column is-half">
                                <p class="is-size-5">$<?= $row['budgetSum'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <p class="title">Most Recent Transactions:</p>
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Budget</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $row): ?>
                    <tr class="<?= $row['transactionType'] == 'Income' ? 'is-selected' : '' ?>">
                        <td class="has-text-weight-bold"><?=$row['transactionName']?></td>
                        <td><?=$row['transactionType']?></td>
                        <td><?=$row['budgetName']?></td>
                        <td><?=$row['transactionAmount']?></td>
                        <td><?=$row['transactionDate']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>
</div>
</div>