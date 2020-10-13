<?php 

include "includes/config.php";

$query = "DELETE from admin where admin_id = {$_GET["admin_id"]}";
$res   = mysqli_query($conn , $query);

header("location:manage_admin.php");


?>