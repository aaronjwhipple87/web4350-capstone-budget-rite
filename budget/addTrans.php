<?php
require 'functions.php';
require 'session.php';
$msg = "";

if(isset($_POST["submit"])){
        if($sql = $con->prepare('INSERT INTO transactions ( budgetID, transactionName, transactionAmount, transactionDate, userID ) VALUES (?,?,?, NOW(),?)')) {
            $sql->bind_param('issi', $_POST['transType'],$_POST['transName'], $_POST['transAmount'], $_SESSION['id']);
            $sql->execute();
            $msg = 'Transaction created successfully!';
            echo "<script type='text/javascript'>alert('$msg');</script>";
            header( "Refresh:1; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/transactions.php");

        } else {
            $msg = "Could not prepare statement";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        $sql->close();
}


?>

<?=template_header('Add Transaction');?>

<?=template_nav();?>


    <section class="section">
        <div class="container">
            <h1 class="title">Create Transaction</h1>
            <form action="addTrans.php" method="post">

                <div class="field">
                    <label class="label">Transaction Type</label>
                    <div class="select" >
                        <select name="transType" required>
                            <div class="select">
                                <option value="">Select</option>
                                <option value="1">Bills</option>
                                <option value="3">Income</option>
                                <option value="2">Expenses</option>
                                <option value="4">Savings</option>
                            </div>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Transaction Name</label>
                    <div class="control">
                        <input class="input" type="text" name="transName" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Amount</label>
                    <div class="control">
                        <input type="number" class="input" step="any" name="transAmount" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button type="submit" name="submit" class="button is-link">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>



<?=template_footer();?>