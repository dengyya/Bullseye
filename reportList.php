<?php include('top.php') ?>


<?php
include('admin/db_connect.php');
ob_start();
$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
foreach ($query as $key => $value) {
  if (!is_numeric($key))
    $_SESSION['system'][$key] = $value;
}
ob_end_flush();


?>

<!-- Begin Page Content -->
<div class="container-fluid pl-5 pr-5">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Report List</h1>
  <p class="mb-5">This section includes all of the report you've submitted</p>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">

      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="reportList.php">Complaint</a></li>
        <li class="page-item"><a class="page-link" href="crimeList.php">Crime</a></li>
        <li class="page-item"><a class="page-link" href="missingList.php">Missing Person</a></li>
      </ul>
      </nav>

      <br>
      <table class="table table-bordered table-hover table-responsive">
        <thead>
          <tr>
            <th width="10%" class="text-center">#</th>
            <th width="10%" class="text-center">Case No</th>
            <th width="10%" class="text-center">Complainant</th>
            <th width="20%" class="text-center">Respondent Information</th>
            <th width="20%" class="text-center">Report Information</th>
            <th width="10%" class="text-center">Status of Report</th>
            <th width="10%" class="text-center">Action</th>


          </tr>
        </thead>
    </div>
    <tbody>
  </div>

  <?php
  $i = 1;
  $status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
  $qry = $conn->query("SELECT * FROM complaints where complainant_id = {$_SESSION['login_id']} order by unix_timestamp(date_created) desc ");
  while ($row = $qry->fetch_array()) :
  ?>
    <tr>

      <td class="text-center"><?php echo $i++ ?></td>
      <td class="text-center">CN-<?php echo $row['id'] ?></td>
      <td class="text-center">
        <p><?php echo $row['complainant_fname'] ?> <?php echo $row['complainant_lname'] ?>
          <?php echo $row['complainant_contact'] ?> </p>

      </td>
      <td>
        <p>Name: <?php echo $row['respondent_fname'] ?> <?php echo $row['respondent_lname'] ?></p>
        <p>Contact Number: <?php echo $row['contact_num'] ?></p>
        <p>Address: <?php echo $row['complaints_address'] ?>, <?php echo $row['complaints_street'] ?>, <?php echo $row['complaints_barangay'] ?>, <?php echo $row['complaints_municipality'] ?>, <?php echo $row['complaints_province'] ?></p>
      </td>
      <td>
        <p>Date Happened: <?php echo date('M d, Y', strtotime($row['date_happened'])) ?></p>
        <p>Incident Location: <?php echo $row['incident_location'] ?>, <?php echo $row['incident_street'] ?>, <?php echo $row['incident_barangay'] ?>, <?php echo $row['incident_municipality'] ?>, <?php echo $row['incident_province'] ?></p>
        <p>Type of complaint: <?php echo $row['type'] ?></p>
        <p>Details: <?php echo $row['description'] ?></p>


      </td>

      <td class='text-center'>
        <?php if ($row['status'] == 1) : ?>
          <span class="badge badge-primary ">Pending</span>
        <?php elseif ($row['status'] == 2) : ?>
          <span class="badge badge-info">Received </span>
        <?php elseif ($row['status'] == 3) : ?>
          <span class="badge badge-success">Action Made </span>
        <?php elseif ($row['status'] == 4) : ?>
          <span class="badge badge-dark"> Cased Closed</span>
        <?php elseif ($row['status'] == 5) : ?>
          <span class="badge badge-danger">Cancelled </span>
        <?php endif; ?>

      </td>

      <td class="text-center">
        <div id="status">

          <?php if ($row['status'] == 3) : ?>
            <button class="btn btn-sm btn-outline-danger cancel_complaint" disabled href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-ban"></i></button>
          <?php elseif ($row['status'] == 4) : ?>
            <button class="btn btn-sm btn-outline-danger cancel_complaint" disabled href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-ban"></i></button>
          <?php elseif ($row['status'] == 5) : ?>
            <button class="btn btn-sm btn-outline-danger cancel_complaint" disabled href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-ban"></i></button>
          <?php else : ?>
            <button class="btn btn-sm btn-outline-danger cancel_complaint" href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-ban"></i></button>

          <?php endif; ?>
          <button class="btn btn-sm btn-outline-danger delete_complaint" href="javascript:void(0)" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
          <button class="btn btn-sm btn-outline-success view_btn" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></button>
        </div>
      </td>
      </td>
    </tr>
  <?php endwhile; ?>
  <tbody>
    </table>
</div>
</div>
</div>
<div class="pt-5 my-5">


</div>


<?php include('footer.php') ?>
<?php include('functions.php') ?>
<?php include('fter.php') ?>



</body>

</html>
<script>
  $(document).ready(function() {

    $('table').dataTable()
  })

  $('#new_complaint').click(function() {
    uni_modal('Add Complaint Report', 'manage_report.php', "large")
  })

  $('.cancel_complaint').click(function() {
    uni_modal("Cancellation", "cancel_report.php?id=" + $(this).attr('data-id'), "mid-large")

  })

  $('.active_user').click(function() {
    _conf("Are you sure to active this user?", "active_user", [$(this).attr('data-id')])
  })

  $('.delete_complaint').click(function() {
    _conf("Are you sure to delete this complaint?", "delete_complaint", [$(this).attr('data-id')])
  })


  function delete_complaint($id) {
    start_load()

    $.ajax({
      url: 'admin/ajax.php?action=delete_complaint',
      method: 'POST',
      data: {
        id: $id
      },
      success: function(resp) {

        if (resp == 1) {
          location.reload();
          alert_toast("Data successfully saved.", 'success')
          setTimeout(function() {
            location.reload()
          }, 1000)

        } else {
          end_load()


        }
      }
    })
  }

  $('.view_btn').click(function() {
    uni_modal("View Details", "complaint_view.php?id=" + $(this).attr('data-id'), "mid-large")
  })

  document.getElementById("cancel_complaint").disabled = true;
</script>