<?php 
ob_start();
$page_title = "Manage Admin";

include "includes/admin_header.php";

if(isset($_POST["add_adminBtn"])){
	$name    = $_POST["admin_name"];
	$pass    = $_POST["admin_pass"];
	$email   = $_POST["admin_email"];
	$img 	 = $_FILES["admin_image"]["name"].time();
	$tmpName = $_FILES["admin_image"]["tmp_name"];
	$path    = "images/adminImage/"; 
	$query 	 = "INSERT into admin (admin_name , admin_email , admin_password , admin_image)
			values ('$name' , '$email' , '$pass' , '$img')";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($tmpName, $path . $img);
	}
	header("location:manage_admin.php");
}

if(isset($_POST["saveUpdateBtn"])){
	$Uid    = $_POST["Uadmin_id"];
	$Uname    = $_POST["Uadmin_name"];
	$Upass    = $_POST["Uadmin_pass"];
	$Uemail   = $_POST["Uadmin_email"];
	$Uimg 	 = $_FILES["Uadmin_image"]["name"].time();
	$UtmpName = $_FILES["Uadmin_image"]["tmp_name"];
	$Upath    = "images/adminImage/";

	if($_FILES["Uadmin_image"]["error"] == 0){
	$query = "UPDATE admin SET admin_name = '$Uname' , admin_password = '$Upass' , admin_email = '$Uemail' , admin_image = '$Uimg' where admin_id = '$Uid'";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($UtmpName, $Upath . $Uimg );
	}
	}else{
		$query = "UPDATE admin SET admin_name = '$Uname' , admin_password = '$Upass' , admin_email = '$Uemail' where admin_id = '$Uid'";
		$res = mysqli_query($conn , $query);
	}
	header("location:manage_admin.php");
}
?>

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">New Admin</h4>
                  <p class="card-category">Add new admin</p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Admin Name</label>
                          <input type="text" class="form-control" name="admin_name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" class="form-control" name="admin_pass" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Admin Email</label>
                          <input type="email" class="form-control" name="admin_email" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="bmd-label-floating">Admin Image</label><br>
                       	  <input type="file" name="admin_image" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="add_adminBtn">Add</button>
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
		                  <h4 class="card-title mt-0"> Admins List</h4>
		                  <p class="card-category"> Show Admins & Modification</p>
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
			                          Admin Name
			                        </th>
			                        <th>
			                          Admin Email
			                        </th>
			                        <th>
			                          Admin Image
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
		                    $sql = "SELECT * from admin";
		                    $res = mysqli_query($conn , $sql);
		                    $i = 1;
		                    while($row = mysqli_fetch_assoc($res)){

		                    $id    = $row["admin_id"];
		                    $name  = $row["admin_name"];
		                    $pass  = $row["admin_password"];
		                    $email = $row["admin_email"];
		                    $image = $row["admin_image"];

		                    echo '<tr class="text-center">';
		                    echo '<td>'.$i.'</td>';
		                    echo '<td>'.$row["admin_name"].'</td>';
		                    echo '<td>'.$row["admin_email"].'</td>';
		                    echo '<td><img src="images/adminImage/'.$row["admin_image"].'" width="62" height="62" class="rounded"></td>';
		                    ?>
		                    <td><button onclick="getData('<?php echo $id; ?>','<?php echo $name; ?>','<?php echo $pass; ?>','<?php echo $email; ?>','<?php echo $image; ?>')" class ="btn btn-warning" data-toggle="modal" data-target="#exampleModal">UPDATE</button></td>
		                    <?php
		                    echo '<td><a href="deleteAdmin.php?admin_id='.$id.'" class ="btn btn-danger confirmDel">DELETE</a></td>';
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   <input type="hidden" name="Uadmin_id" id="Ad_id">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Admin Name</label>
                          <input type="text" class="form-control" name="Uadmin_name" id="Ad_name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Password</label>
                          <input type="password" class="form-control" name="Uadmin_pass" id="Ad_pass" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Admin Email</label>
                          <input type="email" class="form-control" name="Uadmin_email" id="Ad_email" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="">Admin Image</label><br>
                       	  <input type="file" name="Uadmin_image" id="Ad_image">
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
	function getData(id , name , pass , email , image){
		$("#Ad_id").val(id);
		$("#Ad_name").val(name);
		$("#Ad_pass").val(pass);
		$("#Ad_email").val(email);
		$("#Ad_image").val(image);
	}
	$(".confirmDel").click(function(){
		return confirm("Are You Sure ?");
	});
</script>