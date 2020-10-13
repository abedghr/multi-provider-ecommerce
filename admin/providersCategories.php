<?php  

include "includes/config.php";

$query = "SELECT * from category where provider_id = {$_GET['provider_id']}";
$res   = mysqli_query($conn , $query);
while($row = mysqli_fetch_assoc($res)){
	echo '<option value="'.$row["cat_id"].'">'.$row["cat_name"].'</option>';
}

?>