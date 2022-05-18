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

  <!--font awesome css-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Bootstrap css-->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/profile.css">

  <!-- Style css-->
</head>
<?php include('top1.php'); ?>

<body>

  <div class="container  pt-5 light-style flex-grow-1 container-p-y">




    <div class="card overflow-hidden">
      <div class="card-header mb-2"><strong>Account Settings</strong>

      </div>
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active " href="">General</a>
            <a class="list-group-item list-group-item-action" href="index.php?home"> Home </a>
            <a class="list-group-item list-group-item-action" href="reportList.php">My Reports</a>
            <a class="list-group-item list-group-item-action" href="status.php">Status of Reports</a>
            <a class="list-group-item list-group-item-action" href="cancelled_reports.php">Cancellations</a>
            <a class="list-group-item list-group-item-action" href="change-password.php">Changed Password</a>
            <a class="list-group-item list-group-item-action" href="admin/ajax.php?action=logout2" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">

              <div class="card-body media align-items-right">
                <i class="fa fa-user"></i>


              </div>
            </div>
            <hr class="border-light m-0">

            <div class="card-body">

              <div class="form-group">
                <label class="form-label">Name: <?php echo ucwords($fname) ? $fname : '' ?> <?php echo ucwords($lname) ? $lname : '' ?></label>
              </div>
              <div class="form-group">
                <label class="form-label">E-mail: <?php echo isset($email) ? $email : '' ?></label>

                <?php if ($status == 0) : ?>
                  <div class="alert alert-warning  mt-3 mr-4">
                    Your email is not confirmed. Please check your inbox.<br>
                    <a href="verify.php">Resend confirmation</a>
                  </div>

                <?php else : ?>
                  <div class="alert alert-success mt-3">
                    Your email is verified.<br>
                  </div>
                <?php endif; ?>

              </div>
              <div class="form-group mb -4">
                <label class="form-label">Gender: <?php echo isset($gender) ? $gender : '' ?></label>
              </div>
              <div class="form-group">
                <label class="form-label">Age: <?php echo isset($age) ? $age : '' ?></label>
              </div>
              <div class="form-group">
                <label class="form-label">Address: <?php echo isset($address) ? $address : '' ?> , <?php echo isset($street) ? $street : '' ?>
                  , <?php echo isset($barangay) ? $barangay : '' ?> , <?php echo isset($municipality) ? $municipality : '' ?>, <?php echo isset($province) ? $province : '' ?></label>
              </div>
              <div class="form-group">
                <label class="form-label">Contact Number: <?php echo isset($contact) ? $contact : '' ?></label>
              </div>


              <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="logoutModal">Logout</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">Do you want to log out?</div>
                    <div class="modal-footer">
                      <a class="btn btn-primary" href="admin/ajax.php?action=logout2">Yes</a>
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>

                    </div>
                  </div>
                </div>
              </div>


            </div>
            <div class="modal fade" id="confirm_modal" role='dialog'>
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Confirmation</h5>
                  </div>
                  <div class="modal-body">
                    <div id="delete_content"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="uni_modal" role='dialog'>
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"></h5>
                  </div>
                  <div class="modal-body">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="uni_modal_right" role='dialog'>
              <div class="modal-dialog modal-full-height  modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="fa fa-arrow-right"></span>
                    </button>
                  </div>
                  <div class="modal-body">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="viewer_modal" role='dialog'>
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
                  <img src="" alt="">
                </div>
              </div>
            </div>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">Do you want to log out?</div>
                  <div class="modal-footer">
                    <a class="btn btn-primary" href="admin/ajax.php?action=logout2">Yes</a>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>

                  </div>
                </div>
              </div>
            </div>
</body>

</html>
<script>
  $('#manage_my_account').click(function() {
    uni_modal("Manage Account", 'manage_account.php', "mid-large");
  })
</script>