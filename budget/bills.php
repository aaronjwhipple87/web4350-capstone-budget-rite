<?php
require 'functions.php';
require 'session.php';
$msg = "";


 //query that selects all the bills for user
$sql = $con->prepare('SELECT * FROM bills WHERE userId = ?');
$sql->bind_param("i", $_SESSION['id']);
$sql->execute();
$result = $sql->get_result();
$bills = $result->fetch_all(MYSQLI_ASSOC);

?>

<?=template_header('Bills');?>

<?=template_nav();?>

<!-- document main content goes here -->
<section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <h1 class="title">Bills</h1>
                    <p class="subtitle">Welcome, you can view, edit or delete bills below.</p>
                    <a href="createBill.php" class="button is-success is-small">
                        <span class="icon"><i class="fas fa-plus"></i></span>
                        <span>Create Bill</span>
                    </a>
                </div>
                <div class="column">
                    <div class="single-chart">
                        <svg viewBox="0 0 36 36" class="circular-chart red">
                            <path class="circle-bg" d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle" stroke-dasharray="30, 100" d="M18 2.0845
                              a 15.9155 15.9155 0 0 1 0 31.831
                              a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <text x="18" y="20.35" class="percentage">30%</text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-3">
            <table class="table is-bordered">
                <thead>
                <tr>
                    <td>#</td>
                    <td>Bill Type</td>
                    <td>Bill Name</td>
                    <td>Amount</td>
                    <td>Due Date</td>
                    <td>Created</td>
                    <td>Action</td>
                </tr>
                </thead>
                    <tbody>
                    <?php foreach ($bills as $row): ?>
                        <tr>
                            <td>
                                <?=$row['billID']?>
                            </td>
                            <td>
                                <?=$row['billType']?>
                            </td>
                            <td>
                                <?=$row['billName']?>
                            </td>
                            <td>
                                <?=$row['billAmount']?>
                            </td>
                            <td>
                                <?=$row['billdueDate']?>
                            </td>
                            <td>
                                <?=$row['created_at']?>
                            </td>
                            <td>
                                <a href="editBill.php?id=<?=$row['billID']?>" class="button is-link is-small" title="Edit Bill">
                                    <span class="icon"><i class="fas fa-edit"></i></span>
                                </a>
                                <a href="deleteBill.php?id=<?=$row['billID']?>" class="button is-danger is-small" title="Delete Bill">
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