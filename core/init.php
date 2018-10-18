<?php

$dtbs = mysqli_connect('localhost','root','','tata_shop');

if(mysqli_connect_errno()){
  echo "Database connection failure due to these errors: ". mysqli_connect_error();
  die();
}


define('BASEURL', '/TaTaShop/');