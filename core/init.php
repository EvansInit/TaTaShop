<?php

$dtbs = mysqli_connect('localhost','root','','tata_shop');

if(mysqli_connect_errno()){
  echo "Database connection failure due to these errors: ". mysqli_connect_error();
  die();
}

//define('BASEURL', '/TaTaShop/');

//the config func for client side
//require_once 'config.php';
//the ../config functions for the admin side
require_once $_SERVER['DOCUMENT_ROOT'].'/TaTaShop/config.php';
require_once BASEURL.'helpers/helpers.php';