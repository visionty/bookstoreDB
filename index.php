<?php require 'header.php'; ?>

<div class="container">
    <div class="row">
        <h3>Bookstore</h3>
    </div>

    <div class="row">
        <p><a href="create.php" class="btn btn-success">Create</a></p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>BookID</th>
                    <th>Title</th>
                    <th>ISBN</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'database.php';

                    $pdo = Database::connect();
                    $getBooks = $pdo->prepare('SELECT * FROM Books ORDER BY BookID DESC');
                    $getBooks->execute();

                    if($getBooks->rowCount() > 0) {
                        while ($row = $getBooks->fetch()) {
                            echo '<tr>';
                            echo '<td>'. $row['BookID'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['Title'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['ISBN'] . '</td>' . PHP_EOL;
                            echo '<td>'. $row['Price'] . '</td>' . PHP_EOL;
                            echo '<td>' . PHP_EOL;
                            echo '<a class="btn btn-default" href="read.php?id='.$row['BookID'].'">Read</a>' . PHP_EOL;
                            echo '<a class="btn btn-success" href="update.php?id='.$row['BookID'].'">Update</a>' . PHP_EOL;
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['BookID'].'">Delete</a>' . PHP_EOL;
                            echo '</td>' . PHP_EOL;
                            echo '</tr>' . PHP_EOL;
                        }
                    } else {
                        echo '<tr>';
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '<td>Nothing here...</td>' . PHP_EOL;
                        echo '</tr>';
                    }

                    Database::disconnect();
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php require 'footer.php'; ?>