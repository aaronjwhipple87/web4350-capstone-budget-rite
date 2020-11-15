<?php
require 'functions.php';
require 'session.php';
$msg = "";

//get user info from db


// get top 10 transactions from db
$sql = $con->prepare("
SELECT t.transactionName, c.categoryName, b.budgetName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate
FROM
	transactions as t 
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
lEFT JOIN
	categories as c on b.categoryID = c.categoryID
WHERE
	t.userID = ?
ORDER BY
    transactionDate DESC
LIMIT 10
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$transactions = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

//get spent amount
$sql = $con->prepare("
SELECT sum(t.transactionAmount)
FROM
    transactions as t
LEFT JOIN
    budgets as b on t.budgetID = b.budgetID
LEFT JOIN
    categories as c on b.categoryID = c.categoryID
WHERE 
    t.userID = ?
    AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
    AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
    AND c.categoryName != 'income'
    AND c.categoryName != 'savings'
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$sql->bind_result($monthlySpent);
$sql->fetch();
$sql->close();

//get income amount
$sql = $con->prepare("
SELECT sum(t.transactionAmount)
FROM
    transactions as t
LEFT JOIN
    budgets as b on t.budgetID = b.budgetID
LEFT JOIN
    categories as c on b.categoryID = c.categoryID
WHERE 
    t.userID = ?
    AND MONTH(t.transactionDate) = MONTH(CURRENT_DATE())
    AND YEAR(t.transactionDate) = YEAR(CURRENT_DATE())
    AND c.categoryName != 'bills'
    AND c.categoryName != 'expenses'
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$sql->bind_result($monthlyIncome);
$sql->fetch();
$sql->close();

// get category totals
$sql = $con->prepare("
SELECT c.categoryName, SUM(t.transactionAmount) as categorySum
FROM	
	transactions as t
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
LEFT JOIN
	categories as c on b.categoryID = c.categoryID
WHERE
	t.userID = ?
GROUP BY
	c.categoryName
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$categoryTotals = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

// get budget totals
$sql = $con->prepare("
SELECT b.budgetName, SUM(t.transactionAmount) as budgetSum
FROM
	transactions as t 
LEFT JOIN
	budgets as b on t.budgetID = b.budgetID
WHERE 
	t.userID = ?
GROUP BY
	b.budgetName
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$budgetTotals = $result->fetch_all(MYSQLI_ASSOC);
$sql->close();

?>



<?=template_header('Dashboard');?>

<?=template_nav();?>

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-three-quarters">
                <h1 class="title">Welcome, User's Name</h1>
                <p class="subtitle">Your daily spending cash limit is: <span class="has-text-primary">(cash limit)</span></p>
            </div>
            <div class="column">
                <a href="addTrans.php" class="button is-primary is-outlined">Add Transaction</a>
                <a class="button is-primary is-outlined">Create Budget</a>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="card has-text-centered is-vcentered" id="dashboardMoney">
            <p class="title"> <span class="has-text-danger has-text-weight-bold">$<?=$monthlySpent?></span> spent out of <span class="has-text-primary has-text-weight-bold">$<?=$monthlyIncome?></span></p>
            <?php
                $percentage = $monthlySpent / $monthlyIncome * 100;
            ?>
            <progress class="progress <?= $percentage >= 100 ? 'is-danger' : 'is-primary' ?>" value="<?= $percentage; ?>" max="100"><?= $percentage; ?>%</progress>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-header is-justify-content-center">
                        <p class="title has-text-centered m-2">Category Totals</p>
                    </div>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile has-text-centered">
                            <?php foreach ($categoryTotals as $row): ?>
                            <div class="column is-half">
                                <p class="has-text-weight-bold is-size-5"><?= $row['categoryName'] ?></p>
                            </div>
                            <div class="column is-half">
                                <p class="is-size-5">$<?= $row['categorySum'] ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="column has-text-centered">
                <div class="card">
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
                    <tr class="<?= $row['categoryName'] == 'Income' ? 'is-selected' : '' ?>">
                        <td class="has-text-weight-bold"><?=$row['transactionName']?></td>
                        <td><?=$row['categoryName']?></td>
                        <td><?=$row['budgetName']?></td>
                        <td><?=$row['transactionAmount']?></td>
                        <td><?=$row['transactionDate']?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
</section>

<?=template_footer();?>