<?php 

include "includes/config.php";

$query = "DELETE from products where prod_id = {$_GET["prod_id"]}";
$res   = mysqli_query($conn , $query);

header("location:manage_products.php");


?>