<?php 


$email = "";
$name = "";
$errors = array();


session_start();
include ('db_connect.php');
ob_start();
    $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
     foreach ($query as $key => $value) {
      if(!is_numeric($key))
        $_SESSION['system'][$key] = $value;
    }
ob_end_flush();
include('header.php');

if(isset($_POST['signup'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);
    $municipality = mysqli_real_escape_string($conn, $_POST['municipality']);
    $province = mysqli_real_escape_string($conn, $_POST['province']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $password =  mysqli_real_escape_string($conn, $_POST['password']);

    
    if( strlen($password ) < 6 ) {
        $errors['email'] = "Please choose a more secure password. It should be longer than 6 characters, unique to you, and difficult for others to guess.";
    
    }


    $email_check = "SELECT * FROM complainants WHERE email = '$email'";
    $res = mysqli_query($conn, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "An error occurred. Please try again.";
    }
    
   
    if(count($errors) === 0){
        $code = rand(999999, 111111);
        $municipality = "Santa Maria";
        $province= "Bulacan";
        $barangay = "Balasing";
        $password = MD5($_POST['password']);
        $status = 0;
        $insert_data = "INSERT INTO complainants (fname, lname, age, gender, address, street, barangay, municipality, province, email, contact, code, status, password )
                        values('$fname', '$lname', '$age', '$gender', '$address', '$street', '$barangay','$municipality', '$province', '$email', '$contact', '$code', '$status', '$password')";
        $data_check = mysqli_query($conn, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: barangaybalasing09@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}


    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM complainants WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 1;
            $update_otp = "UPDATE complainants SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: index.php?page=home');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    
    //if user click continue button in forgot  password form
    if(isset($_POST['check-mail'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $check_email = "SELECT * FROM complainants WHERE email='$email'";
        $run_sql = mysqli_query($conn, $check_email);
        
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE complainants SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($conn, $insert_code);
            
            if($run_query){
                $subject = "Email Verification Code";
                $message = "Your verification  code is $code";
                $sender = "From: barangaybalasing09@gmail.com";
                
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a verification code to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }
  

    
//verify
if(isset($_POST['checking'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if($_SESSION['email'] == $email){

    $check_email = "SELECT * FROM complainants WHERE email='$email'";
    $run_sql = mysqli_query($conn, $check_email);
    
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE complainants SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        
        if($run_query){
            $subject = "Email Verification Code to Reset Password";
            $message = "Your verification  code is $code";
            $sender = "From: barangaybalasing09@gmail.com";
            
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: user-otp.php');
                exit();
            
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}
else{
    $errors['email'] = "This is not your email!";
}
}



if(isset($_POST['check-email'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $check_email = "SELECT * FROM complainants WHERE email='$email' ";
    $run_sql = mysqli_query($conn, $check_email);
    
    if(mysqli_num_rows($run_sql) > 0){
        $code = rand(999999, 111111);
        $insert_code = "UPDATE complainants SET code = $code WHERE email = '$email'";
        $run_query =  mysqli_query($conn, $insert_code);
        
        if($run_query){
            $subject = "Password Reset Code";
            $message = "Your password reset code is $code";
            $sender = "From: barangaybalasing09@gmail.com";
            
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a password reset otp to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
                header('location: changed-pass.php');
                exit();
            
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        
        }else{
            $errors['db-error'] = "Something went wrong!";
        }
    
    }else{
        $errors['email'] = "This email address does not exist!";
    }
}

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM complainants WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 1;
            $update_otp = "UPDATE complainants SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($conn, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $info = "Your email is now verified! - $email";
                
                header('location: index.php?=home');

                exit();
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    if(isset($_POST['reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM complainants WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    if(isset($_POST['reset'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM complainants WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new_pass.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }
    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if($password !== $password){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = MD5($_POST['password']);
            $update_pass = "UPDATE complainants SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
        //if user click change password button
        if(isset($_POST['change-pass'])){
            $_SESSION['info'] = "";
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
            if($password !== $cpassword){
                $errors['password'] = "Confirm password not matched!";
            }else{
                $code = 0;
                $email = $_SESSION['email']; //getting this email using session
                $encpass = MD5($_POST['password']);
                $update_pass = "UPDATE complainants SET code = $code, password = '$encpass' WHERE email = '$email'";
                $run_query = mysqli_query($conn, $update_pass);
                if($run_query){
                    $info = "Your password was successfully changed.";
                    $_SESSION['info'] = $info;
                    header('Location: pass-changed.php');
                }else{
                    $errors['db-error'] = "Failed to change your password!";
                }
            }
        }
   //if login now button click
    if(isset($_POST['login-now'])){
        header('location: index.php?=home');
    }
