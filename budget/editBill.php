<?php
require 'functions.php';
require 'session.php';
$msg = "";


if(isset($_GET['id'])) {
    // Select the record that is going to be updated
    $sql = $con->prepare('SELECT billType, billName, billAmount, billdueDate FROM bills WHERE billID = ?');
    $sql->bind_param('i', $_GET['id']);
    $sql->execute();
    $sql->bind_result($billType, $billName, $billAmount, $billdueDate);
    $sql->fetch();
    $sql->close();
}

if(isset($_POST["edit"])) {

    // get info from db
    if ($sql = $con->prepare('SELECT * FROM bills WHERE billID = ?')) {
        $sql->bind_param('i', $_GET['id']);
        $sql->execute();
        $sql->store_result();

        if ($stmt = $con->prepare('UPDATE bills SET billType = ?, billName = ?, billAmount = ?, billdueDate = ? WHERE billID = ?')) {

            $stmt->bind_param('ssisi', $_POST['billType'], $_POST['billName'], $_POST['billAmount'], $_POST['billdueDate'], $_GET['id']);
            $stmt->execute();

            $msg = 'You have successfully changed your Bill!';
            echo "<script type='text/javascript'>alert('$msg');</script>";
            header("Refresh:.5; url=http://icarus.cs.weber.edu/~aw54652/web_4350/budget/bills.php");
        } else {
            $msg = "Could not prepare ";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }

        $sql->close();

    }else {
        //something went wrong with sql statement
        $msg = "Could not prepare statement!";
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
}





?>

<?=template_header('Edit Bill');?>

<?=template_nav();?>


<section class="section">
    <div class="container">
        <h1 class="title">Create Bill</h1>
        <form action="editBill.php?id=<?=$_GET['id']?>" method="post">

            <div class="field">
                <label class="label">Bill Type</label>
                <div class="select" >
                    <select name="billType" >
                        <option ><?=$billType?></option>
                        <div class="select" >
                            <option>Monthly</option>
                            <option>Yearly</option>
                            <option>Weekly</option>
                            <option>Bi-weekly</option>
                            <option>One-time</option>
                        </div>
                    </select>
                </div>
            </div>
            <div class="field">
                <label class="label">Bill Name</label>
                <div class="control">
                    <input class="input" type="text" name="billName" value="<?=$billName?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Amount</label>
                <div class="control">
                    <input type="number" class="input" step="any" name="billAmount" value="<?=$billAmount?>" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Due Date</label>
                <div class="control">
                    <input type="date" class="input" name="billdueDate" value="<?=$billdueDate?>"required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" name="edit" class="button is-link">Submit</button>
                </div>
            </div>
        </form>
    </div>
</section>



<?=template_footer();?>
