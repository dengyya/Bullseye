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
          <div class="container">
            <li class="nav-item"><i class="fa fa-home mr-2"></i><a href="index.php?page=home"> Home</a></li>
            <?php if (isset($_SESSION['login_id'])) : ?>
              <li class="nav-item"><i class="fa fa-clipboard-check mr-2"></i><a href="userboard.php"> Dashboard</a> </li>
              <li class="nav-item"><i class="fa fa-clipboard-list mr-2"></i><a href="status.php"> Status of Report</a></li>
              <li class="nav-item"><i class="fa fa-clipboard-list mr-2"></i><a href="missing_receivedList.php"> Missing Persons</a></li>


              <div class=" dropdown mr-4"><i class="fa fa-user mr-2"></i>
                <a href="#" class="text-black dropdown-toggle" id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_fname'] ?> <?php echo $_SESSION['login_lname'] ?></a>
                <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                  <a class="dropdown-item" href="profile.php" id=""><i class="fa fa-users"></i> My Account</a>
                  <a class="dropdown-item" href="change-password.php"><i class="fa fa-cog"></i> Settings</a>
                  <a class="dropdown-item" href="reportList.php"><i class="fa fa-list"></i> Report List</a>
                  <a class="dropdown-item" href="cancelled_reports.php"><i class="fa fa-ban"></i> Cancelled Reports</a>
                  <a class="dropdown-item" href="admin/ajax.php?action=logout2" data-toggle="modal" data-target="#logoutModal"><i class="fa fa-power-off"></i> Logout</a>
                </div>
              </div>


            <?php else : ?>
              <li class="nav-item"><i class="fa fa-user"></i><a href="javascript:void(0)" id="login_now"> Login</a></li>
            <?php endif; ?>





        </ul>
      </div>
      </div>
    </nav>