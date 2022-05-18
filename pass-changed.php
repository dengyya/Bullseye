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
                            <div class="col-md-4 offset-md-4 form login-form">
                                <?php
                                if (isset($_SESSION['info'])) {
                                ?>
                                    <div class="alert alert-success text-center">
                                        <?php echo $_SESSION['info']; ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <form action="index.php?=home" method="POST">
                                    <div class="form-group">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

</body>

</html>