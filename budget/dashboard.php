<?php
require 'functions.php';
require 'session.php';
$msg = "";


// get top 10 transactions from db
$sql = $con->prepare("
SELECT t.transactionName, b.budgetName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate
FROM
    users as u
LEFT JOIN
    usersTransactions as us
    ON u.userID = us.userID
LEFT JOIN
    transactions as t
    ON us.transactionID = t.transactionID
LEFT JOIN
    budgets as b
    ON t.budgetID = b.budgetID
WHERE
    u.userID = ?
ORDER BY
    transactionDate LIMIT 10
");

$sql->bind_param('i', $_SESSION['id']);
$sql->execute();
$sql->bind_result($transactionaName, $budgetName, $transactionDate);
$sql->fetch();
$sql->close();

?>

<?=template_header('Dashboard');?>

<?=template_nav();?>

<section class="section">
    <div class="container">
        <h1 class="title">Welcome, User's Name</h1>
        <p class="subtitle">Your daily spending cash limit is: <span class="has-text-primary">(cash limit)</span></p>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="card has-text-centered is-vcentered" id="dashboardMoney">
            <p class="title"> <span class="has-text-primary has-text-weight-bold">$900 </span> spent of <span class="has-text-danger has-text-weight-bold">$1,000</span></p>
            <?php
                $value = 900;
                $total = 1000;
                $percentage = $value / $total * 100;
            ?>
            <progress class="progress is-primary" value="<?php echo $percentage; ?>" max="100"><?php echo $percentage; ?>%</progress>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column">
                <div class="card">
                    <div class="card-header is-justify-content-center">
                        <p class="title has-text-centered m-2">Categories</p>
                    </div>
                </div>
            </div>
            <div class="column has-text-centered">
                <div class="card">
                    <div class="card-header is-justify-content-center">
                        <p class="title m-2">Budgets</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <p class="title">Most Recent Transactions (top 10)</p>
        <table class="table is-fullwidth is-hoverable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Budget</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Spotify</td>
                    <td>Recurring</td>
                    <td>$5.99</td>
                    <td>11/10/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
                <tr>
                    <td>Smith's Food and Drug</td>
                    <td>Groceries</td>
                    <td>$52.39</td>
                    <td>11/11/2020</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?=template_footer();?>