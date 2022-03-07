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
<?php include('topbar.php'); ?>

<div class="container-fluid p-5">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">List of Missing Person</h6>
        <p class="card-description">
          These are the following missing person in barangay Balasing, Santa Maria, Bulacan.
        </p>
        <div class="card-body">
          <table id="complaint-tbl" class="display" style="width:100%">
            <thead>
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Missing Case No</th>
                <th width="20%">Image</th>
                <th width="20%">Missing Person</th>
                <th width="10%">Informer Information</th>
                <th width="20%">Details</th>
              </tr>
            </thead>
            <tbody>
        </div>
      </div>
      <?php
      $i = 1;
      $status = array("", "Pending", "Received", "Action Made");
      $qry = $conn->query("SELECT * FROM missing where status = 3 order by unix_timestamp(date_created) desc ");
      while ($row = $qry->fetch_array()) :
      ?>
        <tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
          <td class="text-center"><?php echo $i++ ?></td>

          <td class="text-center">MN-<?php echo $row['id'] ?></td>

          <td>
            <?php echo '<img src="admin/assets/uploads/' . $row['missing_image'] . '" width="250px;" height="250px;" alt="Image">' ?>
          </td>

          <td>
            <?php echo date('M d, Y', strtotime($row['date_happened'])) ?><br>
            Name: <?php echo $row['missing_fname'] ?> <?php echo $row['missing_lname'] ?> <br>
            <?php echo $row['missing_age'] ?> <br>
            <?php echo $row['missing_gender'] ?>
          </td>

          <td>
            <?php echo $row['informer_fname'] ?> <?php echo $row['informer_lname'] ?><br>
            <?php echo $row['contact_number'] ?>
          </td>

          <td>
            Last seen: <?php echo $row['missing_address'] ?><br>
            <?php echo $row['physical_description'] ?>,<br>
            <?php echo $row['missing_cloth'] ?>
          </td>



        </tr>

      <?php endwhile; ?>
      </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</body>
<?php include('functions.php') ?>
<?php include('fter.php') ?>
<?php include('footer.php') ?>

</html>

<style>
  .border-gradien-alert {
    border-image: linear-gradient(to right, red, yellow) !important;
  }

  .border-alert th,
  .border-alert td {
    animation: blink 200ms infinite alternate;
  }

  @keyframes blink {
    from {
      border-color: white;
    }

    to {
      border-color: red;
      background: #ff00002b;
    }
  }
</style>
<script>
  $('#complaint-tbl').dataTable();
</script>