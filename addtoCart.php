<?php 
session_start();
include "includes/config.php";
	
	$cartPr = array();
	$cartPr["prod_id"] = $_GET["prod_id"];
	$cartPr["quantity"]= $_GET["quantity"];
	$cartPr["prov_name"] = $_GET["prov_name"];
	$_SESSION["cart"][]=$cartPr;
	

	
	
	

?>
