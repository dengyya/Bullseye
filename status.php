<!DOCTYPE html>
<html lang="en">


<?php
session_start();
include('admin/db_connect.php');
if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
  foreach ($qry->fetch_array() as $k => $v) {
    $$k = $v;
  }
}
include('header.php');


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap css-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/status.css">
  <!-- Style css-->


</head>
<?php include('topbar.php') ?>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">

      <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-4 mt-3 mb-2 ">
        <div class="status  pt pb-0 mt-3 mb-5">
          <h4 id="heading">Status of Report</h4>
          <p>Hi there! here's the status of the report you submit.</p>
        </div>
        <div class="card pt-5 card-timeline px-2 border-none mb-4">

          <ul class="bs4-order-tracking">
            <li class="step active">
              <div><i class="fas fa-spinner"></i></div> Pending
            </li>
            <li class="step ">
              <div><a href="receive.php"><i class="fas fa-bell"></a></i></div> Received
            </li>
            <li class="step ">
              <div><a href="action.php"><i class="fas fa-check"></a></i></div> Action Made
            </li>
          </ul>
          <div class="card-deck">
            <div class="  col-lg-6 offset-md-3 mb-4 ">
              <img class="card-img-top" src="img/loading.png" style="width:100px" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">1. PENDING - Your report is on progress.</p>
              </div>
            </div>
          </div>
        </div>



        <?php

        $sql_get = mysqli_query($conn, "SELECT * FROM complaints where complainant_id = {$_SESSION['login_id']} and status = 1");
        $count1 = mysqli_num_rows($sql_get);

        ?>

        <div class="accordion mb-2" id="accordionExample">
          <div class="card">
            <div class="card-header" style="background-color: #6E7F80" id="heading1">
              <h2 class="mb-0">
                <button class="btn btn-block btns text-white collapsed" type="button" data-toggle="collapse" data-target="#complaint" aria-expanded="false" aria-controls="complaint">
                  <span class="badge badge-danger badge-counter" id="count1"><?php echo $count1; ?></span> Complaint Reports

                </button>
              </h2>
            </div>
            <div id="complaint" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
              <div class="container mt-4">
                <table class="table  table-hover">

                  <thead>
                    <tr>

                      <th class="text-center bg-dark text-white">No</th>
                      <th class="" style="background: #878788;">Complaint Reports </th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    $i = 1;
                    $qry = $conn->query("SELECT * FROM complaints where complainant_id = {$_SESSION['login_id']} and status = 1 order by unix_timestamp(date_created) desc ");
                    if ($qry->num_rows > 0) :
                      while ($row = $qry->fetch_array()) :
                    ?>
                        <tr>
                          <td class="text-center"><?php echo $i++ ?></td>

                          <td class="text-justify">
                            <p></b><small><b><?php echo date('M d, Y ', strtotime($row['date_happened'])) ?></small></p></b>
                            <p>Location: <b><?php echo $row['complaints_address'] ?></b>
                              <b><?php echo $row['complaints_street'] ?></b>
                              <b><?php echo $row['complaints_barangay'] ?></b> ,
                              <b><?php echo $row['complaints_municipality'] ?></b>
                              <b><?php echo $row['complaints_province'] ?></b>
                            </p>

                            <p>Description: <b><?php echo $row['description'] ?></b></p>

                            <p></b><small>Type of Incident: <b><?php echo $row['type'] ?></small></p></b>
                          </td>

                        </tr>
                      <?php endwhile;
                    else :
                      ?>
                      <tr>
                        <th class="text-center" colspan="6">No complaint report/s.</th>
                      </tr>
                    <?php
                    endif;
                    ?>
                </table>
              </div>
            </div>
          </div>
        </div>


        <?php

        $sql_get = mysqli_query($conn, "SELECT * FROM crime where complainant_id = {$_SESSION['login_id']} and status = 1");
        $count2 = mysqli_num_rows($sql_get);

        ?>

        <div class="accordion mb-2" id="accordionExample">
          <div class="card">
            <div class="card-header text-justify" style="background-color: #708090" id="heading2">
              <h2 class="mb-0">
                <button class="btn btn-block collapsed text-white" type="button" data-toggle="collapse" data-target="#crime" aria-expanded="false" aria-controls="crime">
                  <span class="badge badge-danger badge-counter" id="count2"><?php echo $count2; ?></span> Crime Reports
                </button>
              </h2>
            </div>
            <div id="crime" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
              <div class="card-body">
                <div class="container">
                  <table class="table   table-hover">
                    <thead>
                      <tr>
                        <th class="text-center bg-dark text-white">No</th>
                        <th class="" style="background: #878788;">Crime Reports</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $qry = $conn->query("SELECT * FROM crime where complainant_id = {$_SESSION['login_id']} and status = 1 order by unix_timestamp(date_created) desc ");
                      if ($qry->num_rows > 0) :
                        while ($row = $qry->fetch_array()) :
                      ?>
                          <tr>
                            <td class="text-center"><?php echo $i++ ?></td>

                            <td class="text-justify">
                              <p></b><small><b><?php echo date('M d, Y ', strtotime($row['date_created'])) ?></small></p></b>
                              <p></b><small>Type of crime: <b><?php echo $row['type_of_crime'] ?></small></p></b>

                              <p>Location: <b><?php echo $row['crime_street'] ?> ,<?php echo $row['crime_barangay'] ?></b>

                              <p>Landmark: <b><?php echo $row['crime_landmark'] ?></b>

                              <p>Person Involved: <b><?php echo $row['involved_person'] ?></b></p>

                            </td>

                          </tr>
                        <?php endwhile;
                      else :
                        ?>
                        <tr>
                          <th class="text-center" colspan="6">No crime report/s.</th>
                        </tr>
                      <?php
                      endif;
                      ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php

        $sql_get = mysqli_query($conn, "SELECT * FROM missing where complainant_id = {$_SESSION['login_id']} and status = 1");
        $count3 = mysqli_num_rows($sql_get);

        ?>

        <div class="accordion mb-2" id="accordionExample">
          <div class="card">
            <div class="card-header  text-justify" style="background-color: #536872" id="heading3">
              <h2 class="mb-0">
                <button class="btn  btn-block collapsed text-white " type="button" data-toggle="collapse" data-target="#missing" aria-expanded="false" aria-controls="missing">
                  <span class="badge badge-danger badge-counter" id="count3"><?php echo $count3; ?></span> Missing Report
                </button>
              </h2>
            </div>
            <div id="missing" class="collapse" aria-labelledby="heading3" data-paren="#accordionExample">
              <div class="card-body">
                <div class="container">
                  <table class="table   table-hover">
                    <thead>
                      <tr>
                        <th class="text-center bg-dark text-white">No</th>
                        <th class="" style="background: #878788;">Missing Reports</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $qry = $conn->query("SELECT * FROM missing where complainant_id = {$_SESSION['login_id']} and status = 1 order by unix_timestamp(date_created) desc ");
                      if ($qry->num_rows > 0) :
                        while ($row = $qry->fetch_array()) :
                      ?>
                          <tr>
                            <td class="text-center"><?php echo $i++ ?></td>

                            <td class="text-justify">
                              <p></b><small><b><?php echo date('M d, Y ', strtotime($row['date_created'])) ?></small></p></b>

                              <p>Name: <b><?php echo $row['missing_fname'] ?> <?php echo $row['missing_lname'] ?></b>

                              <p>Age: <b><?php echo $row['missing_age'] ?></b></p>

                              <p>Gender: <b><?php echo $row['missing_gender'] ?></b></p>

                              <p>Last seen: <b><?php echo $row['missing_address'] ?></b></p>

                              <p>Missing person description: <b><?php echo $row['physical_description'] ?><br> </b>
                              <p>Last cloth wore: <b><?php echo $row['missing_cloth'] ?></b>
                              </p>

                              <p>Contact Information of the informer person <br>
                                Name: <b><?php echo $row['informer_fname'] ?></b> <b><?php echo $row['informer_lname'] ?></b><br>
                                Contact Number: <b><b><?php echo $row['contact_number'] ?></b></b>

                              </p>

                              <p class="text-center"><?php echo '<img src="admin/assets/uploads/' . $row['missing_image'] . '" width="250px;" height="250px;" alt="Image">' ?>
                            </td>

                          </tr>
                        <?php endwhile;
                      else :
                        ?>
                        <tr>
                          <th class="text-center" colspan="6">No missing report/s.</th>
                        </tr>
                      <?php
                      endif;
                      ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <?php include('footer.php') ?>
  <?php include('functions.php') ?>

  </div>


</body>

</html>