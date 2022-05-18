<?php session_start() ?>
<?php include('admin/db_connect.php'); ?>
<?php 
if(isset($_SESSION['login_id'])){
	$qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
	foreach($qry->fetch_array() as $k => $v){
		$$k = $v;
	}
} 
?>

<?php 
if(isset($_SESSION['email']))
header("location:index.php?page=home");

?>
<style>
@import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600&family=Poppins:wght@100;200;300;400;500&display=swap');
body{
font-family: 'Poppins', sans-serif;
font-style: normal;
}
.image{
  margin-left:80px;
  align-items:center;
height:400px;
-webkit-animation: mover 2s infinite  alternate;
    animation: mover 1s infinite  alternate;
}
@-webkit-keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}
@keyframes mover {
    0% { transform: translateY(0); }
    100% { transform: translateY(-20px); }
}


</style>


<body>
    
          <div class="container">
            <!-- Navbar Brand -->
            <a href="index.php" class="navbar-brand">
              <img src="img/logos.png" alt="logo" width="150">
            </a>
          </div>
        </nav>
      </header>
      <div class="container">
    <div class="row">
    
      <div class="col-md-8 col-lg-5 col-xl-5 offset-xl-1">
        
      <form action="" id="signup-frm" autocomplete="">
      <div class="form-group row">

      <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

        <div class="form-group col-md-12 mb-2">
            <label for="input">Name</label>
            <input type="text" class="form-control"  name="name" id="name" value="<?php echo isset($name) ? $name : '' ?>" required> 
        </div>

        <div class="form-group">
       	<div class="row">
        <div class=" col-lg-6 ">
        <label for="age">Age:</label>
        <input type="number" class="form-control" name="age" id="age"  value="<?php echo isset($age) ? $age :'' ?>" required = ""> </label>
        </div>
        
        
        <div class=" col-lg-6 ">
        <div class="form-group  mb-2">
        <label for="">Gender:</label> <br>
        <select name="gender" id="gender" value="<?php echo isset($gender) ? $gender :'' ?>" class="form-control">
        <option selected ></option>
        <option value="Female" <?php echo isset($gender) && $gender == "Female" ? 'selected' : "" ?> >Female</option>
        <option value="Male" <?php echo isset($gender) && $gender == "Male" ? 'selected' : "" ?> >Male</option>
        <option value="Others"<?php echo isset($gender) && $gender == "Others" ? 'selected' : ""?> >Others</option>
        </select> </br>
        </div>
        </div>
        </div>

        <div class="form-group  mb-2">
          <label for="inputAddress">Address</label>
          <textarea cols="30" rows="3" name="address"  required="" class="form-control"value="<?php echo isset($address) ? $address : '' ?>" id="address"></textarea>
        </div>
        
      <div class="form-group mb-2">
        <label for="inputEmail">Email</label>
        <input type="email" class="form-control"value="<?php echo isset($email) ? $email : '' ?>" name="email" id="email"  required>
      </div>
      <div class="form-group mb-2">
        <label for="inputContact">Contact Number</label>
        <input type="text" class="form-control" name="contact" id="contact"  value="<?php echo isset($contact) ? $contact : '' ?>"  required>
      </div>
      <div class="form-group">
			<label for="" class="control-label">Password</label>
			<input type="password" name="password" class="form-control" <?php echo isset($email) ?>
			<?php if(isset($id)): ?>
				<small><i>Leave this field blank if you dont want to change your password.</i></small>
			<?php endif; ?>
		</div>
   
    </div>
        <div class="form-group custom-file  mb-4">
          <input class="checks" type="checkbox"/>
          I agree with the <i><b><a href="javascript:void(0)" id="terms_of_service">Terms of Service</b></i></a> and have read and acknowledge the<i><b>
        <a href="javascript:void(0)" id="privacy_policy"> Privacy Policy</a></b></i><br/>
       <br/><br/>
    </div>
  
    <div class="form-group custom-file  mb-4">
 
  <button class="button btn btn-primary btn col-md- 6mb-2">Create</button>
		<button class="button btn btn-secondary btn col-md- 6mb-2 " type="button" data-dismiss="modal">Cancel</button>
</div>


  
</form>
      </div>
      <div class="col-md-6 col-lg-7 col-xl-6 ">
        <p class="text-center">To start your journey with us, Kindly create an account. Please note that the CONFIDENTIALITY of your information is meticulously assured.</p>
        <img src="img/file.png" class="img-fluid image">
      </div>
    </div>
  </div>

     
  



<style>
	#uni_modal .modal-footer{
		display:none;
	}
</style>
<script>

$('#terms_of_service').click(function(){
		uni_modal("Terms of Service",'terms_signup.php',"large")
	})
	$('#privacy_policy').click(function(){
		uni_modal("Privacy Policy",'privacy_signup.php',"large")
	})
  
	$('#signup-frm').submit(function(e){
		e.preventDefault()
		start_load()
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'admin/ajax.php?action=signup',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#signup-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success:function(resp){
				if(resp == 1){
					location.reload();
				}else{
					$('#signup-frm').prepend('<div class="alert alert-danger">Email already exist.</div>')
					end_load()
				}
			}
		})
	})
</script>