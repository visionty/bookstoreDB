<?php
include_once 'dbconfig.php';
error_reporting(0);

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="create.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
     <th>#</th>
     <th>Title</th>
     <th>ISBN</th>
     <th>Price</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
		$query = "SELECT BookID, title, isbn, price FROM Books";
		$records_per_page=5;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

