<?php
require 'functions.php';
require 'session.php';
$msg = "";


//query that selects all the transactions for user
$sql = $con->prepare("SELECT  t.published, t.transactionID, b.budgetName, t.transactionType, t.transactionName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate 
FROM transactions t
INNER JOIN
    budgets b 
    on t.budgetID = b.budgetID
WHERE b.userId = ?
AND t.transactionType = 'Income'
AND t.published = 1
ORDER BY 
	transactionDate DESC");
$sql->bind_param("i", $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$trans = $result->fetch_all(MYSQLI_ASSOC);


?>

<?=template_header('Income');?>

<?=template_nav();?>

<?=template_menu();?>

<div class="column">
    <section class="section">
        <div class="container">
            <h1 class="title">Current Income</h1>
            <p class="subtitle">Welcome, you can view, edit or delete current income below.</p>
            <a href="addTrans.php" class="button is-success is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add Transaction</span>
            </a>
            <a href="allIncome.php" class="button is-primary is-small">
                <span>See All Income</span>
            </a>
        </div>
        <div class="container pt-3">
            <table class="table is-bordered is-fullwidth">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Budget Name</td>
                    <td>Transaction Type</td>
                    <td>Transaction Name</td>
                    <td>Amount</td>
                    <td>Created</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($trans as $row): ?>
                    <tr>
                        <td>
                            <?=$row['transactionID']?>
                        </td>
                        <td>
                            <?=$row['budgetName']?>
                        </td>
                        <td>
                            <?=$row['transactionType']?>
                        </td>
                        <td>
                            <?=$row['transactionName']?>
                        </td>
                        <td class="<?= ($row['transactionType'] == 'Bills' || $row['transactionType'] == 'Expenses') ? 'has-text-danger' : 'has-text-black' ?>">

                            <?=$row['transactionAmount']?>

                        </td>
                        <td>
                            <?=$row['transactionDate']?>
                        </td>
                        <td>
                            <a href="editTrans.php?id=<?=$row['transactionID']?>" class="button is-link is-small" title="Edit Income">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                            </a>
                            <a href="deleteTrans.php?id=<?=$row['transactionID']?>" class="button is-danger is-small" title="Delete Income">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>
</div>
</div>