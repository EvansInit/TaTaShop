<!--footer -->
     <!--<footer class="fixed-bottom bg-dark  text-center" id="footer">&copy; Copyright 2018 TaTa Shop</footer> -->

     <script>

     	function detailsmodal(id){
     		//alert(id);
     		var data = {"id" : id};
     		jQuery.ajax({
     			url : <?php echo BASEURL; ?>+'includes/detailsmodal.php',
                    //url : 'http://127.0.0.1/new/TaTaShop/includes/detailsmodal.php',
     			method : "post",
     			data : data,
     			success : function(data){
     				jQuery('body').append(data);
     				jQuery('#details-modal').modal('toggle');
     			},
     			error : function(){
     				alert("Something is wrong!");
     			}
     		});
     	}

     </script>


 </body>
</html>