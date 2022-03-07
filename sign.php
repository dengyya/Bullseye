<?php
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
    if (!is_numeric($key))
        $_SESSION['system'][$key] = $value;
}
ob_end_flush();
include('header.php');


?>

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
            </div>
        </nav>

        <?php include('footer.php') ?>