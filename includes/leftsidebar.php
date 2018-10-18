<?php
      $sql = "SELECT * FROM categories WHERE parent = 0 ";
      $pquery = $dtbs->query($sql);

 ?>

<div class="wrapper">
<!-- Sidebar -->
<div id="sidebar">
  <div class="sidebar-header">
      <h2>Categories</h2>
  </div>

  <ul class="list-unstyled components" style="font-size: 25px;">
    <?php    while ($parent = mysqli_fetch_assoc($pquery)):    ?>
          <?php
           $parent_id = $parent['id'];
           $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
           $cquery =  $dtbs->query($sql2);

          ?>
              <li class="active">
                  <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><?php echo $parent['category']; ?></a>

                        <ul class="collapse list-unstyled" id="homeSubmenu">
                          <?php  while ($child = mysqli_fetch_assoc($cquery)): ?>
                            <li><a href="../categories/ClothesMen.php"><?php echo $child['category']; ?></a></li>
                          <?php endwhile; ?>
                        </ul>
              </li>
            <?php   endwhile;  ?>
          </ul>


</div>

</div>
