<?php require_once "controllerUserData.php"; ?>
<?php include('admin/db_connect.php'); ?>
<?php include('sign.php'); ?>



<head>
  <link rel="stylesheet" href="css/signup.css">

</head>

<style>
  .Short {
    width: 100%;
    background-color: #dc3545;
    margin-top: 5px;
    height: 3px;
    color: #dc3545;
    font-weight: 500;
    font-size: 12px;
  }

  .Weak {
    width: 100%;
    background-color: #ffc107;
    margin-top: 5px;
    height: 3px;
    color: #ffc107;
    font-weight: 500;
    font-size: 12px;
  }

  .Good {
    width: 100%;
    background-color: #d39e00;
    margin-top: 5px;
    height: 3px;
    color: #d39e00;
    font-weight: 500;
    font-size: 12px;
  }

  .Strong {
    width: 100%;
    background-color: #28a745;
    margin-top: 5px;
    height: 3px;
    color: #28a745;
    font-weight: 500;
    font-size: 12px;
  }
</style>

<body>
  <header class="header">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
      <div class="container">

      </div>
    </nav>
  </header>
  <div class="container">
    <div class="div">

    </div>
    <div class="row align-items-center">
      <div class="col-lg-12">

        <p class="text-center mb-4">
        <h4>Registration Form</h4> To start your journey with us, Kindly create an account. <br> Please note that the CONFIDENTIALITY of your information is meticulously assured.</br></p>
      </div>

      <div class=" mt-4 col-lg-6 col-xl-5 offset-xl-1">

        <form action="register.php" method="POST">
          <div class="form-group col-lg-12 row">
            <?php
            if (count($errors) == 1) {
            ?>
              <div class="alert alert-danger text-center">
                <?php
                foreach ($errors as $showerror) {
                  echo $showerror;
                }
                ?>
              </div>
            <?php
            } elseif (count($errors) > 1) {
            ?>
              <div class="alert alert-danger">
                <?php
                foreach ($errors as $showerror) {
                ?>
                  <li><?php echo $showerror; ?></li>
                <?php
                }
                ?>
              </div>
            <?php
            }
            ?>
            <div class="form-group">
              <div class="row">
                <div class="form-group col-lg-6 mb-2">
                  <label for="fname">First name</label>
                  <input type="text" class="form-control" value="<?php echo isset($fname) ? $fname : '' ?>" name="fname" id="fname" placeholder="First name" required pattern="^\D*$" title="Number Not Allowed">
                </div>

                <div class="form-group col-lg-6 mb-2">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" name="lname" id="lname" value="<?php echo isset($lname) ? $lname : '' ?>" placeholder="Last name" required pattern="^\D*$" title="Number Not Allowed">
                </div>


                <div class=" col-lg-6 ">
                  <label for="age">Age:</label>
                  <input type="number" class="form-control" name="age" id="age" value="<?php echo isset($age) ? $age : '' ?>" required> </label>
                </div>


                <div class=" col-lg-6 ">
                  <div class="form-group  mb-2">
                    <label for=""> Gender:</label> <br>
                    <select name="gender" id="gender" value="<?php echo isset($gender) ? $gender : '' ?>" class="form-control" required>
                      <option selected></option>
                      <option value="Female" <?php echo isset($gender) && $gender == "Female" ? 'selected' : "" ?>>Female</option>
                      <option value="Male" <?php echo isset($gender) && $gender == "Male" ? 'selected' : "" ?>>Male</option>
                      <option value="Prefer not to say" <?php echo isset($gender) && $gender == "Prefer not to say" ? 'selected' : "" ?>>Prefer not to say</option>
                    </select> </br>
                  </div>
                </div>


                <div class="form-group col-lg-12 mb-2">
                  <label for="email">Email</label>
                  <input type="email" class="form-control" name="email" id="email" <?php echo isset($email) ? $email : '' ?> placeholder="Email" required>
                </div>

                <div class="form-group col-lg-12 mb-2">
                  <label for="address">Address</label>
                  <input type="text" class="form-control" name="address" id="address" <?php echo isset($address) ? $address : '' ?> placeholder="House Number" required>
                </div>


                <div class="form-group col-lg-12 mb-2">
                  <label for="street">Street</label>
                  <select class="custom-select" name="street" id="street" value="<?php echo isset($street) ? $street : '' ?>" required>
                    <option selected></option>

                    <option value="Alonzo" <?php echo isset($street) && $street == "Alonzo" ? 'selected' : "" ?>>Alonzo</option>
                    <option value="Luwasan" <?php echo isset($street) && $street == "Luwasan" ? 'selected' : "" ?>>Luwasan</option>
                    <option value="Tabing Ilog" <?php echo isset($street) && $street == "Tabing Ilog" ? 'selected' : "" ?>>Tabing Ilog</option>
                    <option value="Caybutok" <?php echo isset($street) && $street == "Caybutok" ? 'selected' : "" ?>>Caybutok</option>
                    <option value="Castillo" <?php echo isset($street) && $street == "Castillo" ? 'selected' : "" ?>>Castillo</option>
                    <option value="Baustita" <?php echo isset($street) && $street == "Baustita" ? 'selected' : "" ?>>Baustita</option>
                    <option value="Caingin" <?php echo isset($street) && $street == "Caingin" ? 'selected' : "" ?>>Caingin</option>
                    <option value="Manggahan" <?php echo isset($street) && $street == "Manggahan" ? 'selected' : "" ?>>Manggahan</option>
                    <option value="Hulo" <?php echo isset($street) && $street == "Hulo" ? 'selected' : "" ?>>Hulo</option>
                    <option value="Galas 1" <?php echo isset($street) && $street == "Galas 1" ? 'selected' : "" ?>>Galas 1</option>
                    <option value="Galas 2" <?php echo isset($street) && $street == "Galas 2" ? 'selected' : "" ?>>Galas 2</option>
                    <option value="Pari 1" <?php echo isset($street) && $street == "Pari 1" ? 'selected' : "" ?>>Pari 1</option>
                    <option value="Pari 2" <?php echo isset($street) && $street == "Pari 2" ? 'selected' : "" ?>>Pari 2</option>
                    <option value="Bagong Barrio" <?php echo isset($street) && $street == "Bagong Barrio" ? 'selected' : "" ?>>Bagong Barrio</option>
                    <option value="Nigro" <?php echo isset($street) && $street == "Nigro" ? 'selected' : "" ?>>Nigro</option>
                    <option value="Kubo" <?php echo isset($street) && $street == "Kubo" ? 'selected' : "" ?>>Kubo</option>
                    <option value="Paying" <?php echo isset($street) && $street == "Paying" ? 'selected' : "" ?>>Paying</option>
                    <option value="Ventura" <?php echo isset($street) && $street == "Ventura" ? 'selected' : "" ?>>Ventura</option>
                    <option value="Guam" <?php echo isset($street) && $street == "Guam" ? 'selected' : "" ?>>Guam</option>
                    <option value="Ewong" <?php echo isset($street) && $street == "Ewong" ? 'selected' : "" ?>>Ewong</option>
                  </select>
                </div>

                <div class="form-group col-lg-12 mb-2">
                  <label for="barangay">Barangay</label>
                  <select class="custom-select" name="barangay" id="barangay" value="<?php echo isset($street) ? $street : '' ?>">
                    <option value="Balasing">Balasing</option>
                  </select>

                </div>
                <div class="form-group col-lg-6 mb-2">
                  <label for="municipality">Municipality</label>
                  <select class="custom-select" name="municipality" id="municipality">
                    <option value="Santa Maria">Santa Maria</option>
                  </select>

                </div>
                <div class="form-group col-lg-6 mb-2">
                  <label for="province">Province</label>
                  <select class="custom-select" name="province" id="province">
                    <option value="Bulacan">Bulacan</option>
                  </select>

                </div>


                <div class="form-group col-lg-12 mb-2">
                  <label for="contact">Contact Number:</label>
                  <input type="text" class="form-control" name="contact" id="contact" minlength="11" maxlength="11" placeholder="09xxxxxxxxx" pattern="^(09|\+639)\d{9}$" title="Contact Number should be on this format: 09xxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo isset($contact) ? $contact : '' ?>" required="">
                </div>


                <div class="form-group col-lg-12 mb-4">

                  <label for="password">Password</label>
                  <div class="input-group">
                    <input type="password" name="password" id="txtPassword" data-toggle="password" class="form-control" placeholder="Enter Password" required>
                    <div id="strengthMessage"></div>
                  </div>
                  <br>
                  <div class="form-group col-lg-12">
                    <input type="checkbox" onclick="myFunction()"> Show Password
                  </div>

                </div>
              </div>


            </div>




            <div class="form-group custom-file ">


            </div>

            <div class="form-group col-lg-12 mb-2">
              <small> By clicking Sign Up, you are agree to our <i><b><a href="javascript:void(0)" id="terms_of_service">Terms of Service</b></i></a> and have read and acknowledge the<i><b>
                    <a href="javascript:void(0)" id="privacy_policy"> Privacy Policy.</a></b></i><br />
                <br /><br /></small>
              <input class="form-control button btn-success" class="btn btn-primary" type="submit" name="signup" value="Sign Up">
            </div>
          </div>
          <div class="link login-link text-center">Already a member? <a href="index.php?=home" id="login">Login here</a></div>

          <div class="form-group custom-file ">


          </div>
        </form>
      </div>
      <div class=" col-lg-5 col-xl-6 off">
        <img src="img/file.png" class="img-fluid image">
      </div>
    </div>
  </div>
  <div class="form-group custom-file ">


  </div>
  <div class="form-group custom-file ">


  </div>
  <?php include('footer.php') ?>
  <?php include('functions.php') ?>
  <?php include('fter.php') ?>


  <script>
    function myFunction() {
      var x = document.getElementById("txtPassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <script>
    $('#terms_of_service').click(function() {
      uni_modal("Terms of Service", 'terms_signup.php', "large")
    })
    $('#privacy_policy').click(function() {
      uni_modal("Privacy Policy", 'privacy_signup.php', "large")
    })


    $('#gender').click(function() {
      if ($(this).val() == "Custom") {
        $('.custom-gender').show()
      } else {
        $('.custom-gender').hide()
      }
    })

    $(document).ready(function() {
      $('#txtPassword').keyup(function() {
        $('#strengthMessage').html(checkStrength($('#txtPassword').val()))
      })

      function checkStrength(password) {
        var strength = 0
        if (password.length < 6) {
          $('#strengthMessage').removeClass()
          $('#strengthMessage').addClass('Short')
          return 'Too short'
        }
        if (password.length > 7) strength += 1
        // If password contains both lower and uppercase characters, increase strength value.  
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
        // If it has numbers and characters, increase strength value.  
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
        // If it has one special character, increase strength value.  
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // If it has two special characters, increase strength value.  
        if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
        // Calculated strength value, we can return messages  
        // If value is less than 2  
        if (strength < 2) {
          $('#strengthMessage').removeClass()
          $('#strengthMessage').addClass('Weak')
          return 'Weak'
        } else if (strength == 2) {
          $('#strengthMessage').removeClass()
          $('#strengthMessage').addClass('Good')
          return 'Good'
        } else {
          $('#strengthMessage').removeClass()
          $('#strengthMessage').addClass('Strong')
          return 'Strong'
        }
      }
    });
  </script>