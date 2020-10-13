<?php 
ob_start();
$page_title = "Manage Provider";

include "includes/admin_header.php";

if(isset($_POST["add_provBtn"])){
	$name    = $_POST["prov_name"];
	$pass    = $_POST["prov_pass"];
	$email   = $_POST["prov_email"];
	$phone   = $_POST["prov_phone"];
	$logo 	 = $_FILES["prov_logo"]["name"].time();
	$tmpName = $_FILES["prov_logo"]["tmp_name"];
	$path    = "images/providerImage/"; 
	$query 	 = "INSERT into provider (prov_name , prov_email , prov_password , prov_phone , prov_logo)
			values ('$name' , '$email' , '$pass' , '$phone' , '$logo')";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($tmpName, $path . $logo);
	}
	header("location:manage_provider.php");
}

if(isset($_POST["saveUpdateBtn"])){
	$Uid      = $_POST["Uprov_id"];
	$Uname    = $_POST["Uprov_name"];
	$Upass    = $_POST["Uprov_pass"];
	$Uemail   = $_POST["Uprov_email"];
	$Uphone   = $_POST["Upr_phone"];
	$Ulogo 	  = $_FILES["Uprov_logo"]["name"].time();
	$UtmpName = $_FILES["Uprov_logo"]["tmp_name"];
	$Upath    = "images/providerImage/";

	if($_FILES["Uprov_logo"]["error"] == 0){
	$query = "UPDATE provider SET prov_name = '$Uname' , prov_email = '$Uemail' ,  prov_password = '$Upass' , prov_phone = '$Uphone' , prov_logo = '$Ulogo' where prov_id = '$Uid'";
	if(mysqli_query($conn , $query)){
		move_uploaded_file($UtmpName, $Upath . $Ulogo );
	}else{
		die;
	}
	}else{
		$query = "UPDATE provider SET prov_name = '$Uname' , prov_password = '$Upass' , prov_email = '$Uemail' , prov_phone = '$Uphone' where prov_id = '$Uid'";
		$res = mysqli_query($conn , $query);
	}
	header("location:manage_provider.php");
}
?>

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">New Provider</h4>
                  <p class="card-category">Add new Provider</p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Provider Name</label>
                          <input type="text" class="form-control" name="prov_name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Provider Password</label>
                          <input type="password" class="form-control" name="prov_pass" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Provider Email</label>
                          <input type="email" class="form-control" name="prov_email" required>
                        </div>
                      </div>
                    </div>
                    <br>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Provider Phone</label>
                          <input type="tel" class="form-control" name="prov_phone" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="bmd-label-floating">Provider Logo</label><br>
                       	  <input type="file" name="prov_logo" required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="add_provBtn">Add</button>
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
		                  <h4 class="card-title mt-0"> Providers List</h4>
		                  <p class="card-category"> Show Providers & Modification</p>
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
			                          Provider Name
			                        </th>
			                        <th>
			                          Provider Email
			                        </th>
			                        <th>
			                          Provider phone
			                        </th>
			                        <th>
			                          Provider Logo
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
		                    $sql = "SELECT * from provider";
		                    $res = mysqli_query($conn , $sql);
		                    $i = 1;
		                    while($row = mysqli_fetch_assoc($res)){
		                    $id    = $row["prov_id"];
		                    $name  = $row["prov_name"];
		                    $pass  = $row["prov_password"];
		                    $email = $row["prov_email"];
		                    $phone = $row["prov_phone"];
		                    $logo  = $row["prov_logo"];
		                    

		                    echo '<tr class="text-center">';
		                    echo '<td>'.$i.'</td>';
		                    echo '<td>'.$row["prov_name"].'</td>';
		                    echo '<td>'.$row["prov_email"].'</td>';
		                    echo '<td>'.$row["prov_phone"].'</td>';
		                    echo '<td><img src="images/providerImage/'.$row["prov_logo"].'" width="62" height="62" class="rounded"></td>';
		                    ?>
		                    <td><button onclick="getData('<?php echo $id; ?>','<?php echo $name; ?>','<?php echo $pass; ?>','<?php echo $email; ?>','<?php echo $phone; ?>','<?php echo $logo; ?>')" class ="btn btn-warning"  data-toggle="modal" data-target="#exampleModal">UPDATE</button></td>
		                    <?php 
		                    echo '<td><a href="deleteProvider.php?prov_id='.$row["prov_id"].'" class ="btn btn-danger confirmDel">DELETE</a></td>';
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Provider</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card-body">
                  <form method="post" enctype="multipart/form-data">
                   <input type="hidden" name="Uprov_id" id="Pr_id">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Provider Name</label>
                          <input type="text" class="form-control" name="Uprov_name" id="Pr_name" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="">Provider Password</label>
                          <input type="password" class="form-control" name="Uprov_pass" id="Pr_pass" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Provider Email</label>
                          <input type="email" class="form-control" name="Uprov_email" id="Pr_email" required>
                        </div>
                      </div>
                    </div>
                    <br>
                   <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Provider Phone</label>
                          <input type="tel" class="form-control" name="Upr_phone" id="Pr_phone" required>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="row">
                      <div class="col-md-12">
                       	  <label class="">Provider Logo</label><br>
                       	  <input type="file" name="Uprov_logo" id="Pr_logo">
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
	function getData(id , name , pass , email , phone , logo){
		$("#Pr_id").val(id);
		$("#Pr_name").val(name);
		$("#Pr_pass").val(pass);
		$("#Pr_email").val(email);
		$("#Pr_phone").val(phone);
		$("#Pr_logo").val(logo);
	}
	$(".confirmDel").click(function(){
		return confirm("Are You Sure ?");
	});
</script>