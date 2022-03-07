<?php require_once "controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: index.php?=home');
}
?>
<?php include('head.php'); ?>

<head>

    <link rel="stylesheet" href="css/verify.css">

</head>

<style>
    form i {
        margin-left: -30px;
        cursor: pointer;
    }
</style>

<body>
    <div class="container">
        <div id="content" class="flex">
            <div class="">
                <div class="page-content page-container" id="page-content ">
                    <div class="padding">
                        <div class="row ">
                            <div class="col-md-8 offset-md-2 form">
                                <div class="">
                                    <form action="new-password.php" method="POST" autocomplete="off">
                                        <div class="card-header mb-2"><strong>New Password</strong>
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
                                                <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                                            </div>
                                            <div class="form-group">
                                                <input class="form-control button" type="submit" name="change-password" value="Change">
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <link rel="stylesheet" href="css/verify.css">
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
                        <script>


                        </script>
</body>

</html>