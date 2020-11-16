<?php
require 'functions.php';
require 'session.php';
$msg = "";


 //query that selects all the transactions for user
$sql = $con->prepare("SELECT  t.transactionID, b.budgetName, t.transactionType, t.transactionName, t.transactionAmount, DATE_FORMAT(t.transactionDate, '%m-%d-%y') AS transactionDate 
FROM transactions t
INNER JOIN
    budgets b 
    on t.budgetID = b.budgetID
WHERE b.userId = ?");
$sql->bind_param("i", $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$trans = $result->fetch_all(MYSQLI_ASSOC);


?>

<?=template_header('Transactions');?>

<?=template_nav();?>

    <section class="section">
        <div class="container">
            <h1 class="title">Transactions</h1>
            <p class="subtitle">Welcome, you can view, edit or delete transactions below.</p>
            <a href="addTrans.php" class="button is-success is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add Transaction</span>
            </a>
        </div>
        <div class="container pt-3">
            <table class="table is-bordered">
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
                        <td>
                            <?=$row['transactionAmount']?>
                        </td>
                        <td>
                            <?=$row['transactionDate']?>
                        </td>
                        <td>
                            <a href="editTrans.php?id=<?=$row['transactionID']?>" class="button is-link is-small" title="Edit Trans">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                            </a>
                            <a href="deleteTrans.php?id=<?=$row['transactionID']?>" class="button is-danger is-small" title="Delete Trans">
                                <span class="icon"><i class="fas fa-trash"></i></span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </section>

<?=template_footer();?>