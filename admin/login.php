<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){
$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($system as $k => $v) {
	$_SESSION['system'][$k] = $v;
}
// }
ob_end_flush();
?>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title><?php echo $_SESSION['system']['name'] ?></title>


	<?php include('./header.php'); ?>
	<?php
	if (isset($_SESSION['login_id']))
		header("location:index.php?page=home");

	?>

</head>
<style>
	body {
		width: 100%;
		height: calc(100%);
		position: fixed;
		top: 0;
		left: 0;

		/*background: #007bff;*/
	}

	main#main {
		width: 100%;
		height: calc(100%);
		display: flex;
	}

	.admn {
		width: 400px;
		padding-top: 80px;
		-webkit-animation: mover 2s infinite alternate;
		animation: mover 1s infinite alternate;
	}

	@-webkit-keyframes mover {
		0% {
			transform: translateY(0);
		}

		100% {
			transform: translateY(-20px);
		}
	}

	@keyframes mover {
		0% {
			transform: translateY(0);
		}

		100% {
			transform: translateY(-20px);
		}
	}
</style>

<body class="">

	<div class="container">
		<div class=" row align-items-center justify-content-center">
			<div class="col-lg-7   ">
				<div class="col"><img src="images/admn.png" class="admn img-fluid image"></div>
			</div>

			<div class="col-lg-5  pt-4 p-3">

				<div class=""><img src="images/logos.png" class="img-fluid image mb-3 offset-md-3" width="150px"></div>
				<h4 class="text-white text-center"><b><?php echo $_SESSION['system']['name'] ?></b></h4>
				<form action="" id="login-form">
					<div class="form-group">
						<label for="username" class="control-label">Username</label>
						<input type="text" id="username" name="username" class="form-control">
					</div>
					<div class="form-group">
						<label for="password" class="control-label">Password</label>
						<input type="password" id="myInput" name="password" class="form-control">
						<input class="mt-3" type="checkbox" onclick="myFunction()"> Show Password
					</div>


					<button class="btn btn-block mt-4 btn-dark text-white">Login</button>
				</form>

			</div>
		</div>
	</div>




</body>
<script>
	function myFunction() {
		var x = document.getElementById("myInput");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}


	$('#login-form').submit(function(e) {
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=login1',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success: function(resp) {
				if (resp == 1) {
					location.href = 'index.php?page=home';

				} else if (resp == 3) {
					$('#login-form').prepend('<div class="alert alert-danger">Your account has been disabled.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

				} else if (resp == 2) {
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>