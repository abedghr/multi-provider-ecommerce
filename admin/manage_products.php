<?php 
ob_start();
$page_title = "Manage Products";

include "includes/admin_header.php";

if(isset($_POST["add_prodBtn"])){
	$name     = $_POST["prod_name"];
	$desc     = $_POST["prod_desc"];
	$oldPrice = $_POST["prod_old_price"];
	$newPrice = $_POST["prod_new_price"];
	$provider = $_POST["provider"];
	$category = $_POST["prov_cat"];
	$prod_img = $_FILES["prod_img"]["name"].time();
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

if(isset($_POST["saveUpdateBtn"])){
	$Uid       = $_POST["Uprod_id"];
	$Uname     = $_POST["Upro_name"];
	$Udesc     = $_POST["Uprod_desc"];
	$UoldPrice = $_POST["Uprod_old_price"];
	$UnewPrice = $_POST["Uprod_new_price"];
	$Uprovi    = $_POST["Uprovider"];
	$Ucateg    = $_POST["Uprov_cat"];
	$Uimg 	   = $_FILES["Uprod_img"]["name"].time();
	$UtmpName  = $_FILES["Uprod_img"]["tmp_name"];
	$Upath     = "images/productsImage/";

	if($_FILES["Uprod_img"]["error"] == 0){
	$query = "UPDATE products SET prod_name = '$Uname' , prod_description = '$Udesc' , prod_image = '$Uimg' , prod_old_price = '$UoldPrice' , prod_new_price = '$UnewPrice' , category_id = '$Ucateg' , provider_id = '$Uprovi' where prod_id = '$Uid'";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($UtmpName, $Upath . $Uimg );
	}
	}else{
		$query = "UPDATE products SET prod_name = '$Uname' , prod_description = '$Udesc' , prod_old_price = '$UoldPrice' , prod_new_price = '$UnewPrice' , category_id = '$Ucateg' , provider_id = '$Uprovi' where prod_id = '$Uid'";
		$res = mysqli_query($conn , $query);
	}
	header("location:manage_products.php");
}
?>

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">New Product</h4>
                  <p class="card-category">Add new Product</p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Product Name</label>
                          <input type="text" class="form-control" name="prod_name" required>
                        </div>
                      </div>
                  	</div>
                    <div class="row">  
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Product Description</label>
                          <input type="text" class="form-control" name="prod_desc" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Old Price</label>
                          <input type="text" class="form-control" name="prod_old_price" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">New Price</label>
                          <input type="text" class="form-control" name="prod_new_price" required>
                        </div>
                      </div>
                    </div>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Provider</label>
                          <select name="provider" id="prov" class="form-control">
                          <?php 
                          $sql2 = "SELECT * from provider";
                          $res2 = mysqli_query($conn , $sql2);
                          while($row2 = mysqli_fetch_assoc($res2)){
                          	print_r($row2);
                          	echo '<option value="'.$row2["prov_id"].'">'.$row2["prov_name"].'</option>';
                          }

                          ?>
                      	  </select>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category</label>
                          <select name="prov_cat" class="form-control" id="categories">
                          	<?php 
                          	$que = "SELECT * from category";
                          	$re  = mysqli_query($conn , $que);
                          	while($ro = mysqli_fetch_assoc($re)){
                          		echo '<option value="'.$ro["cat_id"].'">'.$ro["cat_name"].'</option>';
                          	}

                          	?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="bmd-label-floating">Product Image</label><br>
                       	  <input type="file" name="prod_img" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="add_prodBtn">Add</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
      	<div class="row">
		      <div class="col-md-12">
		              <div class="card card-plain">
		                <div class="card-header card-header-primary">
		                  <h4 class="card-title mt-0"> Products List</h4>
		                  <p class="card-category"> Show Products & Modification</p>
		                </div>
		                <div class="card-body">
		                  <div class="table-responsive">
		                    <table class="table table-hover">
		                      <thead class="text-primary text-center">
		                      	<strong>
			                        
			                        <th>
			                          Product Image
			                        </th>
			                        <th>
			                          Product Name
			                        </th>
			                        <th>
			                          Product Description
			                        </th>
			                        <th>
			                          Old Price
			                        </th>
			                        <th>
			                          New Price
			                        </th>
			                        <th>
			                          Provider
			                        </th>
			                        <th>
			                          Category
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
		                    $sql = "SELECT products.* , provider.prov_name , category.cat_name from products INNER JOIN provider ON provider.prov_id = products.provider_id INNER JOIN category ON category.cat_id = products.category_id";

		                    $res = mysqli_query($conn , $sql);
		                    $i = 1;
		                    while($row = mysqli_fetch_assoc($res)){

		                    $id    = $row["prod_id"];
		                    $name  = $row["prod_name"];
		                    $desc  = $row["prod_description"];
		                    $image = $row["prod_image"];
		                    $oldPr = $row["prod_old_price"];
		                    $newPr = $row["prod_new_price"];
		                    $categ = $row["category_id"];
		                    $provi = $row["provider_id"];
		                    
		                    echo '<tr class="text-center">';
		                    echo '<td><img src="images/productsImage/'.$row["prod_image"].'" width="62" height="62" class="rounded"></td>';
		                    echo '<td>'.$row["prod_name"].'</td>';
		                    echo '<td>'.$row["prod_description"].'</td>';
		                    echo '<td>JD'.$row["prod_old_price"].'</td>';
		                    echo '<td>JD'.$row["prod_new_price"].'</td>';
		                    echo '<td>'.$row["prov_name"].'</td>';
		                    echo '<td>'.$row["cat_name"].'</td>';
		                    ?>
		                    <td><button id="bt" onclick="getData('<?php echo $id; ?>','<?php echo $name; ?>','<?php echo $desc; ?>','<?php echo $oldPr; ?>','<?php echo $newPr; ?>','<?php echo $provi; ?>','<?php echo $categ; ?>')" class ="btn btn-warning" data-toggle="modal" data-target="#exampleModal">UPDATE</button></td>
		                    <?php
		                    echo '<td><a href="deleteProduct.php?prod_id='.$row["prod_id"].'" class ="btn btn-danger confirmDel">DELETE</a></td>';
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

<!-- Start Modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   <input type="hidden" name="Uprod_id" id="pro_id">
                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Product Name</label>
                          <input type="text" class="form-control" name="Upro_name" id="pro_name" required>
                        </div>
                      </div>
                  	</div>
                    <div class="row">  
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Product Description</label>
                          <input type="text" class="form-control" name="Uprod_desc" id="pro_desc" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Old Price</label>
                          <input type="text" class="form-control" name="Uprod_old_price" id="pro_old_price" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">New Price</label>
                          <input type="text" class="form-control" name="Uprod_new_price" id="pro_new_price" required>
                        </div>
                      </div>
                    </div>

                   <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Provider</label>
                          <select name="Uprovider" id="pr_id" class="form-control">
                          <?php 
                          $sql2 = "SELECT * from provider";
                          $res2 = mysqli_query($conn , $sql2);
                          while($row2 = mysqli_fetch_assoc($res2)){
                          	$q = "SELECT * from products where prod_id = ".$_POST['Uprod_id'];
                       	  	$r = mysqli_query($conn , $q);
                       	  	$ro= mysqli_fetch_assoc($r);
                       	  	
                          	if($row2["prov_id"] == $ro['provider_id']){
                          		echo '<option value="'.$row2["prov_id"].'" selected>'.$row2["prov_name"].'</option>';

                          	}else{
                          		echo '<option value="'.$row2["prov_id"].'">'.$row2["prov_name"].'</option>';
                          	}
                          }

                          ?>
                      	  </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category</label>
                          <select name="Uprov_cat" class="form-control" id="ca_id">
                          	<?php 
                          	$que = "SELECT * from category";
                          	$re  = mysqli_query($conn , $que);
                          	while($ro = mysqli_fetch_assoc($re)){
                          		echo '<option value="'.$ro["cat_id"].'">'.$ro["cat_name"].'</option>';
                          	}

                          	?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="bmd-label-floating">Product Image</label><br>
                       	  <input type="file" name="Uprod_img" id="pro_image">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="modal-footer mt-5">
        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        				<button type="submit" name="saveUpdateBtn" class="btn btn-primary">Update changes</button>
      				</div>
                  </form>
                </div>
      		</div>
	    </div>
	  </div>
	</div>

<!-- End Modal -->



<?php include "includes/admin_footer.php"; ?>
<script type="text/javascript">
	
	function getData(id , name , desc , oldPrice , newPrice , provID , catID){
		$("#pro_id").val(id);
		$("#pro_name").val(name);
		$("#pro_desc").val(desc);
		$("#pro_old_price").val(oldPrice);
		$("#pro_new_price").val(newPrice);
		$("#pr_id").val(provID);
		$("#ca_id").val(catID);
		
		
	}
	
	
	$(".confirmDel").click(function(){
		return confirm("Are You Sure ?");
	});
</script>