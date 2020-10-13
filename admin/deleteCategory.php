<?php 

include "includes/config.php";

$query = "DELETE from category where cat_id = {$_GET["cat_id"]}";
$res   = mysqli_query($conn , $query);

header("location:manage_category.php");


?>