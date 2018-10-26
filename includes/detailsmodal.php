<?php 
require_once '../core/init.php';
//$id = $_POST['id'];
if(isset($_POST["id"])){
  $id = $_POST["id"];
}else{
  $id = NULL;
}
$id = (int)$id;
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = $dtbs->query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
$brand_query = $dtbs->query($sql);
$brand = mysqli_fetch_assoc($brand_query);


 ?>

<!--modal for details when clicked -->
<?php echo ob_start();
//session_start(); ?> <!-- starts a buffer then read the content and send it to the ajax as the data object-->

<div class="modal fade details-modal" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-modal" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title text-center"><?php echo $product['title']; ?></h4>
                        <button type="button" class="close" onclick="closeModal()" aria-label="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
               <!-- start of modal body -->
               <div class="modal-body">
                 <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-6">
                              <div class="center-block">
                                <img src="<?php echo $product['image_one']; ?>" style="width:300px; height: 300px;"alt="<?php echo $product['title']; ?>" class="details img-responsive">
                              </div>
                        </div>
                        <div class="col-sm-6">
                          <h4>Details</h4>
                          <p><?php echo $product['description']; ?></p>
                          <hr>
                          <p>Price: Ksh.<?php echo $product['price'] ?></p>
                          <p>Brand: <?php echo $brand['brand']; ?></p>
                          <p>Quantity: 10</p>
                        </div>
                     </div>
                 </div>
               </div>
               <!--end of modal body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-warning"><span></span> Fetch Seller</button>
              </div>
        </div>
   </div>
</div>

<script type="text/javascript">
  //closing modal and deleting parsed data
  function closeModal(){
    jQuery('#details-modal').modal('hide');
    setTimeout(function(){
      jQuery('#details-modal').remove();
      jQuery('.modal-backdrop').remove();
    },20);
  }
  
</script>


<?php echo ob_get_clean(); 
  //session_destroy(); ?><!-- clears the memory of our buffer --> 