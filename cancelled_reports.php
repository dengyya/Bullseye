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
          <h4 id="heading">Cancelled Reports</h4>
          <p>Hi there! here's the status of the report you submit.</p>
        </div>






        <div class="accordion mb-2" id="accordionExample">
          <div class="card">
            <div class="card-header" style="background-color: #6E7F80" id="heading1">
              <h2 class="mb-0">
                <button class="btn btn-block btns text-white collapsed" type="button" data-toggle="collapse" data-target="#complaint" aria-expanded="false" aria-controls="complaint">
                  Complaint Reports
                </button>
              </h2>
            </div>
            <div id="complaint" class="collapse" aria-labelledby="heading1" data-parent="#accordionExample">
              <div class="container mt-4">
                <table class="table  table-hover">
                  <thead>
                    <tr>

                      <th class="text-center bg-dark text-white">No</th>
                      <th class="text-center bg-dark text-white">Complaint No</th>
                      <th class="" style="background: #878788;">Complaint Reports</th>


                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    $i = 1;

                    $qry = $conn->query("SELECT c.*,ca.cancel_status, ca.cancel_reason FROM complaints c 
                      inner join cancel_reports ca on ca.complaint_id = c.id where ca.complainant_id = {$_SESSION['login_id']} order by unix_timestamp(c.date_created) desc ");
                    if ($qry->num_rows > 0) :
                      while ($row = $qry->fetch_array()) :
                    ?>
                        <tr>
                          <td class="text-center"><?php echo $i++ ?></td>

                          <td class="text-center">CN-<?php echo $row['id'] ?></td>
                          <td class="text-justify">

                            <?php if ($row['cancel_status'] == 0) : ?>
                              <span class="badge badge-info ">Pending</span>
                            <?php elseif ($row['cancel_status'] == 1) : ?>
                              <span class="badge badge-success ">Confirmed</span>
                            <?php endif; ?>

                            <p></b><small><b><?php echo date('M d, Y ', strtotime($row['date_happened'])) ?></small></p></b>
                            <p>Location: <b><?php echo $row['complaints_address'] ?></b>,
                              <b><?php echo $row['complaints_street'] ?></b>,
                              <b><?php echo $row['complaints_barangay'] ?></b>, <br>
                              <b><?php echo $row['complaints_municipality'] ?></b>
                              <b><?php echo $row['complaints_province'] ?></b>
                            </p>

                            <p>Description: <b><?php echo $row['description'] ?></b></p>

                            <p></b><small>Type of Incident: <b><?php echo $row['type'] ?></small></p></b>
                            <p> Reason: <b> <?php echo $row['cancel_reason'] ?></p></b>
                          </td>


                        </tr>
                      <?php endwhile;
                    else :
                      ?>


                      <th class="text-center" colspan="6">No cancelled reports.</th>
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
  </div>

  </div>
  </div>

  <?php include('footer.php') ?>
  <?php include('functions.php') ?>

  </div>


</body>

</html>