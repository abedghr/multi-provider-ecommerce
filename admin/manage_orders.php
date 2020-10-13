<?php 
ob_start();
$page_title = "Manage Orders";

include "includes/admin_header.php";

if(isset($_POST["add_prodBtn"])){
	$name     = $_POST["prod_name"];
	$desc     = $_POST["prod_desc"];
	$oldPrice = $_POST["prod_old_price"];
	$newPrice = $_POST["prod_new_price"];
	$provider = $_POST["provider"];
	$category = $_POST["prov_cat"];
	$prod_img = $_FILES["prod_img"]["name"];
	$tmpName  = $_FILES["prod_img"]["tmp_name"];
	$path     = "images/productsImage/"; 
	$query 	  = "INSERT into products (prod_name , prod_description , prod_image , prod_old_price , prod_new_price , category_id , provider_id )
			values ('$name' , '$desc' , '$prod_img' , '$oldPrice' , '$newPrice' , '$category' ,
			 '$provider')";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($tmpName, $path . $prod_img);
	}
	header("location:manage_products.php");
}
?>

	<br>
      <div class="container-fluid mt-5">
      	<div class="row">
		      <div class="col-md-12">
		              <div class="card card-plain">
		                <div class="card-header card-header-primary">
		                  <h4 class="card-title mt-0"> Orders List</h4>
		                  <p class="card-category"> Show Orders & Modification</p>
		                </div>
		                <div class="card-body">
		                  <div class="table-responsive">
		                    <table class="table table-hover">
		                      <thead class="text-primary text-center">
		                      	<strong>
			                        
			                        <th>
			                          Full Name
			                        </th>
			                        <th>
			                          Email
			                        </th>
			                        <th>
			                          Phone
			                        </th>
			                        <th>
			                          City
			                        </th>
			                        <th>
			                          Detailed Location
			                        </th>
			                        <th>
			                          Total Price
			                        </th>
			                        <th>
			                          Provider
			                        </th>
			                        <th>
			                          Order Date
			                        </th>
			                        <th>
			                          Update
			                        </th>
			                        <th>
			                          Delete
			                        </th>
			                    </strong>
		                      </thead>
		                      <tbody>
		                    <?php 
		                    $sql = "SELECT * from orders";

		                    $res = mysqli_query($conn , $sql);
		                    $i = 1;
		                    while($row = mysqli_fetch_assoc($res)){

		                    
		                    echo '<tr class="text-center">';
		                    
		                    echo '<td>'.$row["full_name"].'</td>';
		                    echo '<td>'.$row["email"].'</td>';
		                    echo '<td>'.$row["phone"].'</td>';
		                    echo '<td>JD'.$row["city"].'</td>';
		                    echo '<td>JD'.$row["detailed_location"].'</td>';
		                    echo '<td>JD'.$row["total_price"].'</td>';
		                    echo '<td>'.$row["provider_id"].'</td>';
		                    echo '<td>'.$row["order_date"].'</td>';
		                    echo '<td>'.$row["order_state"].'</td>';

		                    echo '<td><a href="" class ="btn btn-warning">UPDATE</a></td>';
		                    echo '<td><a href="" class ="btn btn-danger">DELETE</a></td>';
		                    echo '</tr>';
		                    $i++;
		                    }

		                    ?>
		                       
		                      </tbody>
		                    </table>
		                  </div>
		                </div>
		              </div>
		            </div>
		        </div>
		    </div>




<?php include "includes/admin_footer.php"; ?>
<script type="text/javascript">
	$("#prov").change(function(){
		var providerID = $("#prov").val();
		alert(providerID);
		$.ajax({
			type : "GET",
			url  : "providersCategories.php?provider_id="+providerID ,
			success : function(data){
				
				$("#categories").html(data);
			}
		});
		
	});
</script>