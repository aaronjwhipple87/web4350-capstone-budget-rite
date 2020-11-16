<?php
require "functions.php";
require 'session.php';
$msg = '';

if(isset($_POST["delete"])){
    if ($sql = $con->prepare('SELECT * FROM transactions WHERE budgetID = ?')) {
        $sql->bind_param('i', $_GET['id']);
        $sql->execute();
        $sql->store_result();

        if ($sql->num_rows > 0) {
            $sql->fetch();
            $stmt = $con->prepare('DELETE FROM transactions WHERE budgetID = ?');
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();

        }else {
            $msg = "Could not prepare statement";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }

    if ($sql = $con->prepare('SELECT * FROM budgets WHERE budgetID = ?')) {
        $sql->bind_param('i', $_GET['id']);
        $sql->execute();
        $sql->store_result();

        if ($sql->num_rows > 0) {
            $sql->fetch();
            $stmt = $con->prepare('DELETE FROM budgets WHERE budgetID = ?');
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();

            $msg = 'Budget deleted successfully!';
            echo "<script type='text/javascript'>alert('$msg');</script>";
            header( "Refresh:1; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/budgets.php");

        }else {
            $msg = "Could not prepare statement";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }else {

        $msg= 'No record with that ID!';
        echo "<script type='text/javascript'>alert('$msg');</script>";
        header("Refresh:1; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/budgets.php");


    }
    $sql->close();
}

?>

<?=template_header('Delete Budget');?>

<?=template_nav();?>



    <!---document main content goes here -->
    <section class="section">
        <div class="container">
            <h1 class="title">Delete Budget</h1>
            <h2 class="subtitle">Are you sure you want to delete budget?</h2>
            <form action="deleteBudget.php?id=<?=$_GET['id']?>" method="post">
                <div class="buttons">
                    <button type="submit" name="delete" class="button is-success">Yes</button>
                    <a href="budgets.php" class="button is-danger">No</a>
                </div>
            </form>
        </div>
    </section>



<?=template_footer();?>