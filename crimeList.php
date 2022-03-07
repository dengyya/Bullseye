<?php include('top.php') ?>
<?php include('admin/db_connect.php') ?>

<?php

if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
  foreach ($qry->fetch_array() as $k => $v) {
    $$k = $v;
  }
}


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

      <button class="btn btn-primary float-right btn-sm" id="new_crime"><i class="fa fa-plus"></i> New </button><br><br>
      <table class="table table-bordered table-hover" id="complaint-tbl">
        <div id="msg"></div>
        <thead>
          <tr>
            <th width="10%" class="text-center">#</th>
            <th width="10%" class="text-center">Case No</th>
            <th width="10%" class="text-center">Date</th>
            <th width="10%">Type of Crime</th>
            <th width="20%">Location</th>
            <th width="10%">Person Involved</th>
            <th width="10%"> Details</th>
            <th width="10%">Status</th>
            <th width="10%">Action</th>

          </tr>
        </thead>
    </div>
    <tbody>
  </div>


  <?php

  $i = 1;
  $status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
  $qry = $conn->query("SELECT * FROM crime where complainant_id = {$_SESSION['login_id']} order by unix_timestamp(date_created) desc ");
  while ($row = $qry->fetch_array()) :
  ?>
    <tr>
      <td class="text-center"><?php echo $i++ ?></td>
      <td class="text-center">CR<?php echo $row['id'] ?></td>
      <td>
        <?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
      <td><?php echo $row['type_of_crime'] ?></td>
      <td><?php echo $row['crime_street'] ?>, <?php echo $row['crime_barangay'] ?> (Landmark: <?php echo $row['crime_landmark'] ?>)</td>
      <td><?php echo $row['involved_person'] ?></td>
      <td><?php echo $row['crime_details'] ?></td>

      <td class='text-center'>
        <?php if ($row['status'] == 1) : ?>
          <span class="badge badge-primary ">Pending</span>
        <?php elseif ($row['status'] == 2) : ?>
          <span class="badge badge-info">Received </span>
        <?php elseif ($row['status'] == 3) : ?>
          <span class="badge badge-success">Action Made </span>
        <?php endif; ?>
      </td>
      <td class="text-center">
        <button class="btn btn-sm btn-outline-danger delete_crime" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
        <button class="btn btn-sm btn-outline-success view_btn" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></button>
      </td>
      </td>
    </tr>
  <?php endwhile; ?>
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

  $('#new_crime').click(function() {
    uni_modal('Add Crime Person', 'manage_crime.php')
  })

  $('.edit_crime').click(function() {
    uni_modal("Edit Crime Report", "manage_crime.php?id=" + $(this).attr('data-id'))
  })

  $('.delete_crime').click(function() {
    _conf("Are you sure to delete this crime report?", "delete_crime", [$(this).attr('data-id')])
  })

  function delete_crime($id) {
    start_load()
    $.ajax({
      url: 'admin/ajax.php?action=delete_crime',
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
    uni_modal("View Details", "crime_view.php?id=" + $(this).attr('data-id'), "mid-large")
  })
</script>