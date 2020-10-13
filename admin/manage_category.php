<?php 
ob_start();
$page_title = "Manage Category";

include "includes/admin_header.php";

if(isset($_POST["add_catBtn"])){
	$name     = $_POST["cat_name"];
	$cat_img  = $_FILES["cat_img"]["name"];
	$tmpName  = $_FILES["cat_img"]["tmp_name"];
	$path     = "images/categoryImage/"; 
	$query 	  = "INSERT into category (cat_name , cat_image)
			   values ('$name' , '$cat_img')";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($tmpName, $path . $cat_img);
	}
	header("location:manage_category.php");
}

if(isset($_POST["saveUpdateBtn"])){
	$Uid     = $_POST["Ucat_id"];
	$Uname   = $_POST["Ucat_name"];
	$Uimg 	 = $_FILES["Ucat_image"]["name"].time();
	$UtmpName= $_FILES["Ucat_image"]["tmp_name"];
	$Upath   = "images/categoryImage/";

	if($_FILES["Ucat_image"]["error"] == 0){
	$query = "UPDATE category SET cat_name = '$Uname' , cat_image = '$Uimg' where cat_id = '$Uid'";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($UtmpName, $Upath . $Uimg );
	}
	}else{
		$query = "UPDATE category SET cat_name = '$Uname' where cat_id = '$Uid'";
		$res = mysqli_query($conn , $query);
	}
	header("location:manage_category.php");
}
?>

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">New Category</h4>
                  <p class="card-category">Add new Category</p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Category Name</label>
                          <input type="text" class="form-control" name="cat_name" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="bmd-label-floating">Category Image</label><br>
                       	  <input type="file" name="cat_img" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="add_catBtn">Add</button>
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
		                  <h4 class="card-title mt-0"> Categories List</h4>
		                  <p class="card-category"> Show Categories & Modification</p>
		                </div>
		                <div class="card-body">
		                  <div class="table-responsive">
		                    <table class="table table-hover">
		                      <thead class="text-primary text-center">
		                      	<strong>
			                        <th>
			                          #
			                        </th>
			                        <th>
			                          Category Name
			                        </th>
			                        <th>
			                          Category Image
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
		                    $sql = "SELECT category.* from category";
		                    $res = mysqli_query($conn , $sql);
		                    $i = 1;
		                    while($row = mysqli_fetch_assoc($res)){

		                    $id    = $row["cat_id"];
		                    $name  = $row["cat_name"];
		                    $image = $row["cat_image"];
		                    
		                    
		                    echo '<tr class="text-center">';
		                    echo '<td>'.$i.'</td>';
		                    echo '<td>'.$row["cat_name"].'</td>';
		                    echo '<td><img src="images/categoryImage/'.$row["cat_image"].'" width="62" height="62" class="rounded"></td>';
		                    ?>
		                    <td><button onclick="getData('<?php echo $id; ?>','<?php echo $name; ?>')" class ="btn btn-warning" data-toggle="modal" data-target="#exampleModal">UPDATE</button></td>
		                    <?php
		                    echo '<td><a href="deleteCategory.php?cat_id='.$id.'" class ="btn btn-danger confirmDel">DELETE</a></td>';
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   <input type="hidden" name="Ucat_id" id="cat_id">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Category Name</label>
                          <input type="text" class="form-control" name="Ucat_name" id="Uc_name" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="">Category Image</label><br>
                       	  <input type="file" name="Ucat_image" id="Uc_image">
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
	function getData(id , name ){
		$("#cat_id").val(id);
		$("#Uc_name").val(name);
		
		
		
	}
	$(".confirmDel").click(function(){
		return confirm("Are You Sure ?");
	});
</script>