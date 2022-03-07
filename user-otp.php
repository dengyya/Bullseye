<?php require_once "controllerUserData.php"; ?>
<?php

$email = $_SESSION['email'];
if ($email == false) {
    header("location:index.php?page=home");
}
?>
<?php include('head.php'); ?>

<head>
    <link rel="stylesheet" href="css/verify.css">
</head>

<body>
    <div class="container">
        <div id="content" class="flex">
            <div class="">
                <div class="page-content page-container" id="page-content ">
                    <div class="padding">
                        <div class="row ">
                            <div class="col-md-8 offset-md-2 form">
                                <div class="">
                                    <form action="user-otp.php" method="POST" autocomplete="off">
                                        <h2 class="text-center">Code Verification</h2>
                                        <?php
                                        if (isset($_SESSION['info'])) {
                                        ?>
                                            <div class="alert alert-success text-center">
                                                <?php echo $_SESSION['info']; ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (count($errors) > 0) {
                                        ?>
                                            <div class="alert alert-danger text-center">
                                                <?php
                                                foreach ($errors as $showerror) {
                                                    echo $showerror;
                                                }
                                                ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control button" type="submit" name="check" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

</body>

</html>