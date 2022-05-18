<?php require_once "controllerUserData.php"; ?>
<?php include('head.php'); ?>

<head>
    <link rel="stylesheet" href="css/forgot.css">
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
                                    <div class="card-header mb-2"><strong>Do you want to change your password?</strong>

                                    </div>
                                    <div class="card-body">
                                        <p>Kindly change your password. This will help you to secure your account.</p>

                                        <form action="forgot-password.php" method="POST" autocomplete="">
                                            <?php
                                            if (count($errors) > 0) {
                                            ?>
                                                <div class="alert alert-danger text-center">
                                                    <?php
                                                    foreach ($errors as $error) {
                                                        echo $error;
                                                    }
                                                    ?>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="form-group">
                                                <input class="form-control text-muted" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                                                <p> We don't share email with anyone.</p>

                                            </div>

                                            <div class="form-group ">
                                                <input class="form-control button bg-dark text-white" type="submit" name="check-mail" value="Continue">
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>