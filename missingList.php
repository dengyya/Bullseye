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

      <ul class="pagination text-dark">
        <li class="page-item "><a class="page-link" href="reportList.php">Complaint</a></li>
        <li class="page-item"><a class="page-link" href="crimeList.php">Crime</a></li>
        <li class="page-item"><a class="page-link" href="missingList.php">Missing Person</a></li>
      </ul>
      </nav>

      <button class="btn btn-primary float-right btn-sm" id="new_missing"><i class="fa fa-plus"></i> New </button><br><br>
      <table class="table table-bordered table-hover" id="complaint-tbl">
        <div id="msg"></div>
        <thead>
          <tr>
            <th width="10%" class="text-center">#</th>
            <th class="text-center">Missing Case No</th>
            <th width="30%" class="text-center">Image</th>
            <th width="30%" class="text-center"> Details</th>
            <th width="10%" class="text-center">Status</th>
            <th width="20%" class="text-center">Action</th>

          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          $status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
          $qry = $conn->query("SELECT * FROM missing where complainant_id = {$_SESSION['login_id']} order by unix_timestamp(date_created) desc ");
          while ($row = $qry->fetch_array()) :
          ?>
            <tr>
              <td class="text-center"><?php echo $i++ ?></td>
              <td class="text-center">MN-<?php echo $row['id'] ?></td>
              <td><?php echo '<img src="admin/assets/uploads/' . $row['missing_image'] . '" width="250px;" height="250px;" alt="Image">' ?></td>
              <td>
                <b>Date Happen:</b> <?php echo date('M d, Y ', strtotime($row['date_happened'])) ?> <br>
                <b>Missing Person:</b> <?php echo $row['missing_fname'] ?> <?php echo $row['missing_lname'] ?><br>
                <b>Age:</b> <?php echo $row['missing_age'] ?><br>
                <b>Gender:</b> <?php echo $row['missing_gender'] ?><br>
                <b>Contact Number:</b> <?php echo $row['contact_number'] ?><br>
                <b>Last seen to the person:</b> <?php echo $row['missing_address'] ?><br>
                <b>Physical Description:</b> <?php echo $row['physical_description'] ?></br>
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

              <td class="text-center">
                <button class="btn btn-sm btn-outline-primary edit_missing" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
                <button class="btn btn-sm btn-outline-danger delete_missing" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
                <button class="btn btn-sm btn-outline-success view_btn" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></button>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
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

  $('#new_missing').click(function() {
    uni_modal('Add Missing Person', 'manage_missing.php', "mid-large")
  })

  $('.edit_missing').click(function() {
    uni_modal("Edit Missing Report", "manage_missing.php?id=" + $(this).attr('data-id'), "mid-large")
  })

  $('.delete_missing').click(function() {
    _conf("Are you sure to delete this missing report?", "delete_missing", [$(this).attr('data-id')])
  })

  function delete_missing($id) {
    start_load()
    $.ajax({
      url: 'admin/ajax1.php?action=delete_missing',
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
    uni_modal("View Details", "missing_view.php?id=" + $(this).attr('data-id'), "mid-large")
  })
</script>