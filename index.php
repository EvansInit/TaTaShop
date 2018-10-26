<?php
  include 'includes/head.php';
  include 'includes/navigation.php';
  require_once 'core/init.php';
  //$ipaddress = $_SERVER['REMOTE_ADDR'], "I'm Watching You!";
  $sql = "SELECT * FROM products WHERE featured = 1";
  $featured = $dtbs->query($sql);

 ?>

     <!--Jumbotron -->
     <div class="jumbotron" style="padding: 10px; margin-bottom: 0px;">
        <h1 style="text-align:center;">TATA SHOP</h1>
        <p style="text-align:center;">A local trading site where anyone can be an entrepreneur. Buying and Selling and Advertising made easy.</p>
      </div> 
      <!-- end of jumbotron-->

    <div class="container-fluid">
          <div class="row">

            <div class="col-md-2" style="background-color:LightGray;">
              <!--start of sidebar -->
              <?php  include 'includes/leftsidebar.php';   ?>
              <!--end of sidebar -->

            </div>

    <div class="col-md-8 ">
      <div class="row">
        <div class="col-sm-8">
          <!--Image slide -->
       <?php  //include 'includes/carousel.php';   ?>
       </div>
      </div>

       <div class="row">
           <div class="container">
           <h2 class="text-center" style="text-decoration:underline;">FEATURED ITEMS FROM VARIOUS CATEGORIES</h2>
           </div>

            <!--card -->
          <?php while($product = mysqli_fetch_assoc($featured)) : ?>
            <?php //var_dump($product); ?>

             <div class="col-sm-3">
               <h4><?php echo $product['title']; ?></h4>
               <img src="<?php echo $product['image_one']; ?>" alt="<?php echo $product['title']; ?>" class="imgForCards">
               <!--<p class="list price text-danger">List Price: <s>Ksh.<?php // echo $product['list_price']; ?></s></p>-->
               <p class="price">Our price: Ksh.<?php echo $product['price']; ?></p>
               <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?php echo $product['id']; ?>)">Details</button>
             </div>

           <?php endwhile; ?>
           <!--end of card -->
         </div>

    </div>

    <div class="col-md-2">
         <?php
          //include 'includes/rightsidebar.php';
         ?>
         <!-- <a href="https://stude.co/429317" target="_blank"><img style="border: 0px" src="https://cdn.rawgit.com/bitdegree/banners/5fc6ebbc/referral-banners/300x600.jpg" width="200" height="600" alt=""></a> -->
    </div>
      </div>

      <!--details modal -->
     <?php
     include 'includes/footer.php';
      ?>
  

     
