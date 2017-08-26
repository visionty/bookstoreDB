<?php
    require 'database.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null === $id) {
        header('Location: index.php');
    }

    if (!empty($_POST)) {
        $id = $_POST['id'];

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('DELETE FROM Books WHERE BookID = ?');
        $q->execute(array($id));
        Database::disconnect();
        header('Location: index.php');
    }

    include 'header.php';
?>

//
<div class="container">
    <div class="row">
        <h3>Delete a Book</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <p class="bg-danger alert">Are you sure you want to delete this Book?</p>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <a class="btn btn-default" href="index.php">No</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>