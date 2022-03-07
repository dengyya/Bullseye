<?php session_start() ?>
<?php include('admin/db_connect.php'); ?>
<?php
if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
  foreach ($qry->fetch_array() as $k => $v) {
    $$k = $v;
  }
}
?>
<style>
  .button_cat {
    border-radius: none;
    background: none;
  }
</style>
<div class="container-fluid">
  <form action="" id="complaint-frm">
    <div class=" dropdown mr-4">
      <button class=" button_cat btn-lg btn-block dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Categories
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_crime"> Report a Crime</a>
        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_complaint"> File a Complaint</a>
        <a class="dropdown-item" href="javascript:void(0)" id="manage_my_missing"> Report Missing Person</a>
      </div>
    </div>

  </form>
</div>



<style>
  #uni_modal .modal-footer {
    display: none;
  }
</style>
<script>
  $('#manage_my_crime').click(function() {
    uni_modal("Report Crime", 'manage_crime.php', "mid-large");
  })

  $('#manage_my_complaint').click(function() {
    uni_modal("Complaint", 'manage_report.php', "large");
  })

  $('#manage_my_missing').click(function() {
    uni_modal("Report Missing Person", 'manage_missing.php');
  })
</script>