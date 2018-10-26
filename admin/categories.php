<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/TaTaShop/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$result = $dtbs->query($sql);
$$errors = array();

//Process form
if (isset($_POST) && !empty($_POST)) {
	$parent = sanitize($_POST['parent']);
	$category = sanitize($_POST['category']);
	$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$parent'";
	$fresult = $dtbs->query($sqlform);
	$count = mysqli_num_rows($fresult);
	//if category is blank
	if ($category == '') {
		$errors[] .= 'The category cannot be left blank.';
	}

	//if category exists in DB
	if ($count > 0) {
		$errors[] .= $category.' already exists. Please choose a new category.';
	}

	//display errors or update DB
	if(!empty($errors)){
		//display errors
		$display = display_errors($errors); ?>
		<script>
			jQuery('document').ready(function(){
				jQuery('#errorsonform').html('<?php echo $display; ?>');
			});
		</script>
	<?php }else{
		//update DB
		$updatesql = "INSERT INTO categories (category, parent) VALUES ('$category','$parent')";
		$dtbs->query($updatesql);
		header('Location: categories.php');
	}
}

?>

<h2 class="text-center">Categories</h2><hr>

<div class="row">
	<!-- form -->
	<div class="col-md-6">
		<form class="form" action="categories.php" method="post">
			<legend>Add A Category</legend>
			<!-- to show errors on top of form -->
			<div id="errorsonform"></div>
			<div class="form-group">
				<label for="parent">Parent</label>
				<select class="form-control" name="parent" id="parent">
					<option value="0">Parent Categories</option>
					<?php while($parent = mysqli_fetch_assoc($result)): ?>
						<option value="<?php echo $parent['id']; ?>"><?php echo $parent['category']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<input type="text" class="form-control" id="category" name="category">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Add Category">
			</div>
		</form>
	</div>
	<!-- Category table -->
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<th>Category</th> <th>Parent</th> <th>Action</th>
			</thead>
			<tbody>
			<?php 

			$sql = "SELECT * FROM categories WHERE parent = 0";
			$result = $dtbs->query($sql);

			while($parent = mysqli_fetch_assoc($result)):
			$parent_id = (int)$parent['id'];
			$sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
			$cresult = $dtbs->query($sql2);
			 ?>
				<tr style="background-color: #06ff00; font-weight: bold;">
					<td><?php echo $parent['category']; ?></td>
					<td><?php echo "parent with id = ".$parent['id']; ?></td>
					<td>
						<a href="categories.php?edit=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/pencil.svg"> edit</a>
						<a href="categories.php?delete=<?php echo $parent['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/trashcan.svg"> delete</a>
					</td>
				</tr>
				<?php while($child = mysqli_fetch_assoc($cresult)): ?>
					<tr style="background-color: #F0FFFF;">
					<td><?php echo $child['category']; ?></td>
					<td><?php echo "child of ".$parent['category']; ?></td>
					<td>
						<a href="categories.php?edit=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/pencil.svg"> edit</a>
						<a href="categories.php?delete=<?php echo $child['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/trashcan.svg"> delete</a>
					</td>
				</tr>
				<?php endwhile; ?>
			<?php endwhile; ?>	
			</tbody>
		</table>
	</div>
</div>

<?php include 'includes/footer.php'; ?>