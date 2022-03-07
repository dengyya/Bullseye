<?php
session_start();
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

<html>

<head>
  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
</head>
<?php include('topbar.php') ?>

<style>
  body {
    text-align: center;


  }

  h3 {

    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-weight: 900;
    font-size: 30px;
    margin-bottom: 10px;
  }

  p {
    color: #404F5E;
    font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
    font-size: 20px;
    margin: 0;
  }

  i {
    color: #9ABC66;
    font-size: 100px;
    line-height: 200px;
    margin-left: -15px;
  }

  .card {
    background: white;
    padding: 60px;
    border-radius: 4px;
    box-shadow: 0 2px 3px #C8D0D8;
    display: inline-block;
    margin-top: 80px;
  }
</style>

<body>

  <div class="container">
    <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <img src="img/successful.png" alt="success" width="200">
      </div>
      <h3>Success!</h3>
      <p>We received your report request;<br /> we'll be in touch shortly!</p>
    </div>
</body>

</html>
<?php include('footer.php') ?>
<?php include('functions.php') ?>