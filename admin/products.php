<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/TaTaShop/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';
//to display table
$sql = "SELECT * FROM products WHERE deleted = 0";
$presults = $dtbs->query($sql);

?>
<h2 class="text-center">Products</h2><hr>

<table class="table table-bordered table-condensed table-striped">
	<thead>
		<th></th> <th>Product</th> <th>Price</th> <th>Category</th> <th>Featured</th> <th>Sold</th>
	</thead>
	<tbody>
		<?php while($product = mysqli_fetch_assoc($presults)): ?>
			<tr>
				<td>
					<a href="products.php?edit=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/pencil.svg"> edit</a>
					<a href="products.php?delete=<?php echo $product['id']; ?>" class="btn btn-xs btn-default"><img src="../assets/trashcan.svg"> del</a>
				</td>
				<td><?php echo $product['title']; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php endwhile; ?>
	</tbody>
</table>

 <?php include 'includes/footer.php'; ?>