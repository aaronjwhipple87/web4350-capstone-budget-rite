<?php
require 'functions.php';
require 'session.php';
$msg = "";


// MySQL query that selects all the polls and poll answers
//$sql = $con->prepare('SELECT transType, transName, transAmount FROM transactions WHERE userId = ?');
//$sql->bind_param('i', $_SESSION['id']);
//$sql->execute();
//$trans = $sql->fetch();


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
                        <td>Transaction Type</td>
                        <td>Transaction Name</td>
                        <td>Amount</td>
                        <td>Created</td>
                        <td>Action</td>
                    </tr>
                </thead>
<!--                <tbody>-->
<!--                --><?php //foreach ($posts as $post): ?>
<!--                    <tr>-->
<!--                        <td>-->
<!--                            --><?//=$post['transType']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//=$post['transName']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//=$post['transAmount']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//=$post['created']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            <a href="update.php?id=--><?//=$post['transID']?><!--" class="button is-link is-small" title="Edit Trans">-->
<!--                                <span class="icon"><i class="fas fa-edit"></i></span>-->
<!--                            </a>-->
<!--                            <a href="delete.php?id=--><?//=$post['transID']?><!--" class="button is-danger is-small" title="Delete Trans">-->
<!--                                <span class="icon"><i class="fas fa-trash"></i></span>-->
<!--                            </a>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach;?>
<!--                </tbody>-->
            </table>
        </div>
    </section>

<!-- document main content goes here -->
<!--<section class="section">-->
<!--    <div class="container">-->
<!--        <h1 class="title">Transactions</h1>-->
<!--        <div class="columns">-->
<!--            <div class="column">-->
<!--                <h3>Transaction Type</h3>-->
<!--                <p></p>-->
<!--            </div>-->
<!--            <div class="column">-->
<!--                <h3>Name</h3>-->
<!--                <p></p>-->
<!--            </div>-->
<!--            <div class="column">-->
<!--                <h3>Amount</h3>-->
<!--                <p></p>-->
<!--            </div>-->
<!--            <table class="table is-bordered">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <td>Type</td>-->
<!--                    <td>Name</td>-->
<!--                    <td>Amount</td>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php //foreach ($trans as $post): ?>
<!--                    <tr>-->
<!--                        <td>-->
<!--                            --><?//=$post['transType']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//=$post['transName']?>
<!--                        </td>-->
<!--                        <td>-->
<!--                            --><?//=$post['transAmount']?>
<!--                        </td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach;?>
<!--                </tbody>-->
<!--            </table>-->
<!---->
<!--            <div class="column">-->
<!--                <h2>Enter New Transaction</h2>-->
<!--                <form action="">-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="incomeType" class="label">Transaction Type</label>-->
<!--                            <div class="select" >-->
<!--                                <select name="transType">-->
<!--                                    <option>Select</option>-->
<!--                                    <option>Debt</option>-->
<!--                                    <option>Income</option>-->
<!--                                </select>-->
<!--                            </div>-->
<!--                           <input type="text" class="input" name="transType">-->
<!--                        </div>-->
<!---->
<!--                    </div>-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="name" class="label">Name</label>-->
<!--                            <input type="text" class="input" name="transName">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="field">-->
<!--                        <div class="control">-->
<!--                            <label for="amount" class="label">Amount</label>-->
<!--                            <input type="number" class="input" name="transAmount">-->
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
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<?=template_footer();?>