<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap css-->

<!--font awesome css-->
<?php

session_start();

include("admin/db_connect.php");

?>

<div class="container">
  <div class="row align-items-center justify-content-center">
    <div class="col-md-6 col-lg-7 col-xl-6">
      <img src="img/login.png" class="img-fluid image">
    </div>
    <div class="col-md-6 col-lg-5 col-xl-5 offset-xl-1">



      <form action="" id="login-frm">
        <!--inputs-->
        <div class=form-messages>
          <ul id="register_output"> </ul>
        </div>

        <div class="form-group">
          <label for="floatingInput">Username</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="myInput" name="password" placeholder="Password" required>
          <div class="row">
            <div class="col-lg-6">
              <input type="checkbox" onclick="myFunction()"> Show Password
            </div>
            <div class="col-lg-6">
              <div class="link forget-pass text-center"><a href="forgot-password.php">Forgot password?</a></div>
            </div>
          </div>

        </div>




        <p>By continuing, you agree to Bullseye's <i><a href="javascript:void(0)" id="terms_of_service">Terms of Service</a></i> and <i><a href="javascript:void(0)" id="privacy_policy">Privacy Policy</i></p>


        <!--Sign in-->
        <div class="d-grid col-lg-12">
          <input type="submit" class="btn btn-primary btn-login text-uppercase fw mb-2 col-md-12" name="register" value="Sign in">
          <div class="text-center">
            <a class="small" href="register.php">Create New Account</a>
          </div>
          <!-- Divider Text -->
          <div class="form-group col-lg-12 mx-auto d-flex align-items-center my-2">
            <div class="border-bottom w-100 ml-5"></div>
            <!-- <span class="px-2 small text-muted font-weight-bold text-muted">OR</span>-->
            <div class="border-bottom w-100 mr-5"></div>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<style>
  #uni_modal .modal-footer {
    display: none;
  }

  .btn-facebook {
    border: none;
  }

  .btn-gmail {
    background-color: #f64508;
    border: none;
  }

  .btn-gmail:hover {
    background-color: #b93102;
  }

  .btn-login {
    font-size: 0.9rem;
    letter-spacing: 0.05rem;
    padding: 0.75rem 1rem;
    background-color: #3f4b58;
    border: none;
  }
</style>
<script>
  function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }

  $('#new_account').click(function() {
    uni_modal("Create an Account", 'signup.php?redirect=index.php?page=checkout', "large")
  })
  $('#terms_of_service').click(function() {
    uni_modal("Terms of Service", 'terms.php', "large")
  })
  $('#privacy_policy').click(function() {
    uni_modal("Privacy Policy", 'privacy_policy.php', "large")
  })
  $('#login-frm').submit(function(e) {
    e.preventDefault()
    start_load()
    if ($(this).find('.alert-danger').length > 0)
      $(this).find('.alert-danger').remove();
    $.ajax({
      url: 'admin/ajax.php?action=login2',
      method: 'POST',
      data: $(this).serialize(),
      error: err => {
        console.log(err)
        end_load()

      },
      success: function(resp) {
        if (resp == 1) {
          location.href = '<?php echo isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php?page=home' ?>';
        } else if (resp == 3) {
          $('#login-frm').prepend('<div class="alert alert-danger">Your account has been disabled for violating our terms of service.</div>')
          end_load()
        } else if (resp == 2) {
          $('#login-frm').prepend('<div class="alert alert-danger">Email or password is incorrect.</div>')
          end_load()
        }
      }
    })
  })
</script>