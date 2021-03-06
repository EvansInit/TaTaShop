<?php 

require_once $_SERVER['DOCUMENT_ROOT'].'/TaTaShop/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';

$sql = "SELECT * FROM categories WHERE parent = 0";
$result = $dtbs->query($sql);
$errors = array();
$category = '';
$post_parent = '';

//edit category
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
	$edit_id = (int)$_GET['edit'];
	$edit_id = sanitize($_GET['edit']);
	$edit_sql = "SELECT * FROM categories WHERE id = '$edit_id'";
	$edit_result = $dtbs->query($edit_sql);
	$edit_category = mysqli_fetch_assoc($edit_result);
}

//delete category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
	$delete_id = (int)$_GET['delete'];
	$delete_id = sanitize($_GET['delete']);
	$dsql = "SELECT * FROM categories WHERE id = '$delete_id'";
	$dresult = $dtbs->query($dsql);
	$category = mysqli_fetch_assoc($dresult);
	//to delete a parent, child cats go too
	if($category['parent'] == 0){
		$ddsql = "DELETE FROM categories WHERE parent = '$delete_id'";
		$dtbs->query($ddsql);
	}
	$deletesql = "DELETE FROM categories WHERE id = '$delete_id' ";
	$dtbs->query($deletesql);
	header('Location: categories.php');
}

//Process form
if (isset($_POST) && !empty($_POST)) {
	$post_parent = sanitize($_POST['parent']);
	$category = sanitize($_POST['category']);
	$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
	if (isset($_GET['edit'])) {
		$id = $edit_category['id'];
		$sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id != '$id'";
	}
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
		$updatesql = "INSERT INTO categories (category, parent) VALUES ('$category','$post_parent')";
		if (isset($_GET['edit'])) {
			$updatesql = "UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
		}
		$dtbs->query($updatesql);
		header('Location: categories.php');
	}
}
$category_value = '';
$parent_value = 0;
if (isset($_GET['edit'])) {
	$category_value = $edit_category['category'];
	$parent_value = $edit_category['parent'];
}else{
	if(isset($_POST)){
		$category_value = $category;
		$parent_value = $post_parent;
	}
}

?>

<h2 class="text-center">Categories</h2><hr>

<div class="row">
	<!-- form -->
	<div class="col-md-6">
		<form class="form" action="categories.php<?php echo ((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post">
			<legend><?php echo((isset($_GET['edit']))?'Edit':'Add a'); ?> Category</legend>
			<!-- to show errors on top of form -->
			<div id="errorsonform"></div>
			<div class="form-group">
				<label for="parent">Parent</label>
				<select class="form-control" name="parent" id="parent">
					<option value="0"<?php echo (($parent_value == 0)?' selected="selected"':'');?>>Parent Categories</option>
					<?php while($parent = mysqli_fetch_assoc($result)): ?>
						<option value="<?php echo $parent['id']; ?>"<?php echo (($parent_value == $parent['id'])?' selected="selected"':'');?>><?php echo $parent['category']; ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="category">Category</label>
				<input type="text" class="form-control" id="category" name="category" value="<?php echo $category_value; ?>">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="<?php echo((isset($_GET['edit']))?'Edit':'Add a'); ?> Category">
			</div>
		</form>
	</div>
	<!-- Category table -->
	<div class="col-md-6">
		<table class="table table-bordered table-condensed">
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