<?php
    require 'database.php';

    $id = null;
    if (!empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }

    if (null === $id) {
        header('Location: index.php');
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('SELECT * FROM Books where BookID = ?');
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

    require 'header.php';
?>

<div class="container">
    <div class="row">
        <h3>Read a Book</h3>
    </div>

    <div class="row">
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-2 control-label">Book Title</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['Title'];?>
                </p>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">ISBN</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['ISBN'];?>
                </p>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Price</label>
                <p class="checkbox col-sm-6">
                    <?php echo $data['Price'];?>
                </p>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <a class="btn btn-default" href="index.php">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>