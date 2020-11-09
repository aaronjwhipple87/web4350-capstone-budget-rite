<?php
require "functions.php";
require 'session.php';
$msg = '';

if(isset($_POST["delete"])){
    if ($sql = $con->prepare('SELECT * FROM bills WHERE billID = ?')) {
        $sql->bind_param('i', $_GET['id']);
        $sql->execute();
        $sql->store_result();

        if ($sql->num_rows > 0) {
            $sql->fetch();
            $stmt = $con->prepare('DELETE FROM bills WHERE billID = ?');
            $stmt->bind_param("i", $_GET['id']);
            $stmt->execute();

            $msg = 'Bill deleted successfully!';
            echo "<script type='text/javascript'>alert('$msg');</script>";
            header( "Refresh:1; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/bills.php");

        }else {
            $msg = "Could not prepare statement";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
    }else {

        $msg= 'No record with that ID!';
        echo "<script type='text/javascript'>alert('$msg');</script>";
        header("Refresh:1; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/bills.php");


    }
    $sql->close();
}

?>

<?=template_header('Delete Bill');?>

<?=template_nav();?>



    <!---document main content goes here -->
    <section class="section">
        <div class="container">
            <h1 class="title">Delete Bill</h1>
            <h2 class="subtitle">Are you sure you want to delete bill?</h2>
            <form action="deleteBill.php?id=<?=$_GET['id']?>" method="post">
                <div class="buttons">
                    <button type="submit" name="delete" class="button is-success">Yes</button>
                    <a href="bills.php" class="button is-danger">No</a>
                </div>
            </form>
        </div>
    </section>



<?=template_footer();?>