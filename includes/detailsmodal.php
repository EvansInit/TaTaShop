<!--modal for details when clicked -->
<?php ob_start(); ?> <!-- starts a buffer then read the content and send it to the ajax as the data object-->
<div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title text-center">Samsung S8</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
               <!-- start of modal body -->
               <div class="modal-body">
                 <div class="container-fluid">
                     <div class="row">
                        <div class="col-sm-6">
                              <div class="center-block">
                                <img src="images/samsung s8.jpg" style="width:300px; height: 300px;"alt="samsung s8" class="details img-responsive">
                              </div>
                        </div>
                        <div class="col-sm-6">
                          <h4>Details</h4>
                          <p>the latest samsung phone in the market.</p>
                          <hr>
                          <p>Price: Ksh.10,000</p>
                          <p>Brand: Samsung</p>
                          <p>Quantity: 10</p>
                        </div>
                     </div>
                 </div>
               </div>
               <!--end of modal body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning"><span></span> Fetch Seller</button>
              </div>
        </div>
   </div>
</div>
<?php echo ob_get_clean(); ?><!-- clears the memory of our buffer -->