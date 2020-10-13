<?php 

include "includes/config.php";

$query = "DELETE FROM `provider` WHERE prov_id = {$_GET['prov_id']}";

$res   = mysqli_query($conn , $query);

header("location:manage_provider.php");

?>