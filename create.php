<?php
    require 'database.php';

    if (!empty($_POST)) {
        $titleError = null;
        $isbnError = null;
        $priceError = null;

        $title = $_POST['title'];
        $isbn = $_POST['isbn'];
        $price = $_POST['price'];

        $valid = true;
        if (empty($title)) {
            $titleError = 'Please enter title';
            $valid = false;
        }

        if (empty($isbn)) {
            $isbnError = 'Please enter ISBN';
            $valid = false;
        }

        if (empty($price)) {
            $priceError = 'Please enter price';
            $valid = false;
        }

        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = 'INSERT INTO Books (Title, ISBN, Price) values(?, ?, ?)';
            $q = $pdo->prepare($sql);
            $q->execute(array($title, $isbn, $price));
            Database::disconnect();
            header('Location: index.php');
        }
    }

    require 'header.php';
?>

<div class="container">
    <div class="row">
        <h3>Create a Book</h3>
    </div>

    <div class="row">
        <form class="form-horizontal" action="create.php" method="post">
            <div class="form-group <?php echo !empty($titleError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Title</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="title" type="text" placeholder="Title" value="<?php echo !empty($title) ? $title : ''; ?>">
                    <?php if (!empty($titleError)): ?>
                        <span class="help-block"><?php echo $titleError;?></span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($priceError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">ISBN</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="isbn" type="text" placeholder="ISBN" value="<?php echo !empty($isbn) ? $isbn : ''; ?>">
                    <?php if (!empty($isbnError)): ?>
                        <span class="help-block"><?php echo $isbnError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group <?php echo !empty($priceError) ? 'has-error' : ''; ?>">
                <label class="col-sm-2 control-label">Price</label>
                <div class="controls col-sm-6">
                    <input class="form-control" name="price" type="text" placeholder="Price" value="<?php echo !empty($price) ? $price : ''; ?>">
                    <?php if (!empty($priceError)): ?>
                        <span class="help-block"><?php echo $priceError;?></span>
                    <?php endif;?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a class="btn btn-default" href="index.php">Back</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require 'footer.php'; ?>