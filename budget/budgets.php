<?php
require 'functions.php';
require 'session.php';
$msg = "";


//query that selects all the transactions for user
$sql = $con->prepare("SELECT budgetID, budgetName, plannedAmount, appliedAmount, DATE_FORMAT(dueDate, '%m-%d-%y') AS dueDate, notes
FROM budgets
WHERE userId = ?");
$sql->bind_param("i", $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$budgets = $result->fetch_all(MYSQLI_ASSOC);


?>

<?=template_header('Transactions');?>

<?=template_nav();?>

    <section class="section">
        <div class="container">
            <h1 class="title">Budgets</h1>
            <p class="subtitle">Welcome, you can view, edit or delete budgets below.</p>
            <a href="addBudget.php" class="button is-success is-small">
                <span class="icon"><i class="fas fa-plus"></i></span>
                <span>Add Budget</span>
            </a>
        </div>
        <div class="container pt-3">
            <table class="table is-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Budget Name</td>
                    <td>Planned Amount</td>
                    <td>Applied Amount</td>
                    <td>Due Date</td>
                    <td>Notes</td>
                    <td>Action</td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($budgets as $row): ?>
                    <tr>
                        <td>
                            <?=$row['budgetID']?>
                        </td>
                        <td>
                            <?=$row['budgetName']?>
                        </td>
                        <td>
                            <?=$row['plannedAmount']?>
                        </td>
                        <td>
                            <?=$row['appliedAmount']?>
                        </td>
                        <td>
                            <?=$row['dueDate']?>
                        </td>
                        <td>
                            <?=$row['notes']?>
                        </td>
                        <td>
                            <a href="editBudget.php?id=<?=$row['budgetID']?>" class="button is-link is-small" title="Edit Trans">
                                <span class="icon"><i class="fas fa-edit"></i></span>
                            </a>
                            <a href="deleteBudget.php?id=<?=$row['budgetID']?>" class="button is-danger is-small" title="Delete Trans">
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