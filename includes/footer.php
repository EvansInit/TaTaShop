</div>
<br><br>

<!--footer -->
     <div class="bg-light text-center" id="footer" style="padding: 10px;">&copy; Copyright 2018 TaTa Shop</div>

     <script>

     	function detailsmodal(id){
     		//alert(id);
     		var data = {"id" : id};
     		jQuery.ajax({
     			url : '/TaTaShop/includes/detailsmodal.php',
     			method : "post",
     			data : data,
     			success : function(data){
     				jQuery('body').prepend(data);
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