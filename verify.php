<?php require_once "controllerUserData.php"; ?>



<!--font awesome css-->
<link href="vendor/font-awesome/css/all.min.css" rel="stylesheet" type="text/css">
<!-- Bootstrap css-->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/top.css">
<!-- Style css-->

</head>

<body>

    <header class="header">
        <nav class="navbar navbar-style">
            <div class="container">

                <!--Logo Section-->
                <div class="nav navbar-header">
                    <a href="index.php" class="navbar-brand">
                        <img src="img/logos.png" alt="logo" width="150">
                    </a>
                </div>
                <!--End of Logo Section-->
                <ul class="nav navbar navbar-right" id="mainNav">
                    <!--End of Logo Section-->
                    <ul class="nav navbar navbar-right" id="mainNav">




            </div>
        </nav>


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
                                            <div class="card-header mb-2"><strong>
                                                    <center>Verify your Email
                                                </strong></center>

                                            </div>
                                            <div class="card-body">
                                                <center>
                                                    <p>It's quick and easy.</p>
                                                </center>

                                                <form action="verify.php" method="POST" autocomplete="">

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
                                                        <input class="form-control" type="email" name="email" placeholder="Email Address" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <input class="form-control button" type="submit" name="checking" value="Send">
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>

        </body>

        </html>

        <script>
        </script>