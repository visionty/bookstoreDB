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
        $titleError = null;
        $isbnError = null;
        $priceError = null;

        $title = $_POST['title'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];

        $valid = true;

        if (empty($title)) {
            $titleError = 'Please enter Title of Book';
            $valid = false;
        }

        if (empty($isbn)) {
            $isbnError = 'Please enter ISBN';
            $valid = false;
        }

        if (empty($price)) {
            $priceError = 'Please enter Price of Book';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q = $pdo->prepare('UPDATE Books set Title = ?, ISBN = ?, Price = ? WHERE BookID = ?');
            $q->execute(array($title, $isbn, $price, $id));
            Database::disconnect();
            header('Location: index.php');
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare('SELECT * FROM Books where BookID = ?');
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $title = $data['title'];
        $isbn = $data['isbn'];
        $price = $data['price'];
        Database::disconnect();
    }

    require 'header.php';
?>

<div class="container">
    <div class="row">
        <h3>Update a Book</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="update.php?id=<?php echo $id; ?>" method="post">
            <div class="form-group <?php echo !empty($titleError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Title</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="title" type="text" placeholder="Title" value="<?php echo !empty($title) ? $title : ''; ?>">
                    <?php if (!empty($titleError)): ?>
                        <span class="help-inline"><?php echo $titleError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($isbnError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">ISBN</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="isbn" type="text" placeholder="ISBN" value="<?php echo !empty($isbn) ? $isbn : ''; ?>">
                    <?php if (!empty($isbnError)): ?>
                        <span class="help-inline"><?php echo $isbnError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($priceError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Price</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="price" type="text" placeholder="Price" value="<?php echo !empty($price) ? $price : ''; ?>">
                    <?php if (!empty($priceError)): ?>
                        <span class="help-inline"><?php echo $priceError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn btn-default" href="index.php">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>