<?php
include_once 'dbconfig.php';
if(isset($_POST['submit']))
{
	$id = $_GET['edit_id'];
	$title = $_POST['title'];
	$isbn = $_POST['isbn'];
	$price = $_POST['price'];
	
	if($crud->update($id,$title,$isbn,$price))
	{
		$msg = "<div class='alert alert-info'>
				<strong>WOW!</strong> Record was updated successfully <a href='index.php'>HOME</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getID($id));
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
error_reporting(0);
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
     <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>Title</td>
            <td><input type='text' name='title' class='form-control' value="<?php echo $title; ?>" required></td>
        </tr>
 
        <tr>
            <td>ISBN</td>
            <td><input type='text' name='isbn' class='form-control' value="<?php echo $isbn; ?>" required></td>
        </tr>
 
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' value="<?php echo $price; ?>" required></td>
        </tr>
        
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="submit">
    			<span class="glyphicon glyphicon-edit"></span>  Update this Record
				</button>
                <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

