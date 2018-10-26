<?php
      $sql = "SELECT * FROM categories WHERE parent = 0 ";
      $pquery = $dtbs->query($sql);

 ?>

<div class="wrapper">
<!-- Sidebar -->
<div id="sidebar">
  <div class="sidebar-header">
      <h2>Categories</h2>    

      <!-- <button class="navbar-toggler bg-success" type="button" data-toggle="collapse" data-target="#sidebarSupportedContent" aria-controls="sidebarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
       </button> -->
    </div>
  
<?php   while ($parent = mysqli_fetch_assoc($pquery)):    ?>
  <ul class="list-unstyled components " style="font-size: 25px;">
    
          <?php
           $parent_id = $parent['id'];
           $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
           $cquery =  $dtbs->query($sql2);

          ?>
              <li class="active">
                  <a href="#" data-toggle="collapse" data-target="#childCatz" style="color: #000000" aria-expanded="false" class="dropdown-toggle" aria-controls="#homeSubmenu"><?php echo $parent['category']; ?></a>
                      
                        <ul id="childCatz" class="collapse">
                          <?php  while ($child = mysqli_fetch_assoc($cquery)): ?>
                            <li>
                              <a href="" ><?php echo $child['category']; ?></a>
                            </li>
                          <?php endwhile; ?>
                        </ul>
                      
              </li>
            
          </ul>
<?php   endwhile;  ?>

</div>

</div>
