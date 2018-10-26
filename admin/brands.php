<?php 
require_once '../core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
//get brands from database
$sql = "SELECT * FROM brand ORDER BY brand";
$results = $dtbs->query($sql);
$errors = array();

//editing brand
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($edit_id);
	$sql2 = "SELECT * FROM brand WHERE id = '$edit_id'";
	$edit_result = $dtbs->query($sql2);
	$eBrand = mysqli_fetch_assoc($edit_result);
}

//delete brand
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($delete_id);
	$sql = "DELETE FROM brand WHERE id = '$delete_id'";
	$dtbs->query($sql);
	header('Location: brands.php');
}

//if add form is submitted
if (isset($_POST['add_submit'])) {
	$brand = sanitize($_POST['brand']);
	//check if brand is blank
	if ($_POST['brand'] == '') {
		//add to errors array
		$errors[].='You must enter a brand!';
	}
	//check if brand already exist in DB
	$sql = "SELECT * FROM brand WHERE brand = '$brand'";
	if(isset($_GET['edit'])){
		$sql = "SELECT * FROM brand WHERE brand = '$brand' AND id != '$edit_id' ";
	}
	$result = $dtbs->query($sql);
	$count = mysqli_num_rows($result);
	//echo $count;
	if ($count > 0){
		$errors[].= $brand.' already exists. Please choose another brand name..';
	}


	if (!empty($errors)) {
		//display errors
		echo display_errors($errors);
	}else{
		//Add brand to DB 
		$sql = "INSERT INTO brand (brand) VALUES ('$brand')";
		if(isset($_GET['edit'])){
		  $sql = "UPDATE brand SET brand = '$brand' WHERE id = '$edit_id' ";
		}
	  
		$dtbs->query($sql);
		header('Location: brands.php');
	}
	
}

?>

<h2 class="text-center">Brands</h2><hr>

<!-- Brand form -->
<div class="text-center">
	<form class="form-inline" action="brands.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
		<div class="form-group">
			<?php 
				$brand_value = '';
			    if (isset($_GET['edit'])){
			    	$brand_value = $eBrand['brand'];
			    }else{
			    	if (isset($_POST['brand'])){
			    		$brand_value = sanitize($_POST['brand']);
			    	}
			    }
			 ?>

			<label for="brand"><?php echo((isset($_GET['edit']))?'Edit':'Add a'); ?> Brand: </label>
			<input type="text" name="brand" id="brand" class="form-control" value="<?php echo $brand_value; ?>">
			<!-- adding the cancel button -->
			<?php if(isset($_GET['edit'])): ?>
				<a href="brands.php" class="btn btn-default">Cancel</a>
			<?php endif; ?>

			<input type="submit" name="add_submit" value="<?php echo((isset($_GET['edit']))?'Edit':'Add'); ?> Brand" class="btn btn-success">
		</div>
	</form>
</div>
<hr>


<table class="table table-bordered table-condensed table-striped table-con">
	<thead>
		<th></th> <th>Brand</th> <th></th>
	</thead>
	<tbody>
		<?php while($brand = mysqli_fetch_assoc($results)): ?>
			<tr>
				<td><a href="brands.php?edit=<?php echo $brand['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/pencil.svg"> edit</a></td>
				<td><?php echo $brand['brand']; ?></td>
				<td><a href="brands.php?delete=<?php echo $brand['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/trashcan.svg"> delete</a></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>

 <?php include 'includes/footer.php'; ?>