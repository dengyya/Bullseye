<!-- START NAV -->
<!---->
<nav class="sidebar sidebar-offcanvas" id="sidebar">

  <ul class="nav ">
    <li class="nav-item">
      <a class="nav-link bg-dark text-light" href="index.php?page=home">
        <i class="icon-grid menu-icon text-light"></i>
        <span class="menu-title ">Admin</span>
      </a>
    </li>

    <!--Report Files   -->
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Report Files</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=complaints">Complaints</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=crime">Crime Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=missing">Missing Person</a></li>
        </ul>
      </div>
    </li>

    <!--Received Reports   -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-report" aria-expanded="false" aria-controls="ui-report">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Received Reports </span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="ui-report">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=received_complaints">Complaints</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=received_crime">Crime Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=received_missing">Missing Person</a></li>
        </ul>
      </div>
    </li>

    <!--Cancelled Reports   -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-cancel" aria-expanded="false" aria-controls="ui-cancel">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Cancelled Reports </span>
        <i class="menu-arrow"></i>
      </a>

      <div class="collapse" id="ui-cancel">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=cancel_complaints">Complaints</a></li>

        </ul>
      </div>
    </li>

    <!--Master List  -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <i class="icon-paper menu-icon"></i>
        <span class="menu-title">Master List</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=complainants">Complainants</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=responders">Responders</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=stations">Stations</a></li>
        </ul>
      </div>
    </li>


    <!--Records  -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <i class="icon-clipboard menu-icon"></i>
        <span class="menu-title">Complaints Records</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=complaints_report_action">Action Made </a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=complaints_report_closed">Cased Closed</a></li>
          <li class="nav-item"> <a class="nav-link" href="index.php?page=complaints_report_cancel">Cancelled Reports</a></li>

        </ul>
      </div>
    </li>

    <!--Crime Records  -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tables1" aria-expanded="false" aria-controls="tables1">
        <i class="icon-clipboard menu-icon"></i>
        <span class="menu-title">Crime Records </span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables1">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="index.php?page=crime_report">Action Made Crime </a></li>
        </ul>
      </div>
    </li>

    <!--Missing Records  -->

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#tables2" aria-expanded="false" aria-controls="tables2">
        <i class="icon-clipboard menu-icon"></i>
        <span class="menu-title">Missing Records </span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables2">
        <ul class="nav flex-column sub-menu">

          <li class="nav-item"> <a class="nav-link" href="index.php?page=missing_report">Missing Record</a></li>
        </ul>
      </div>
    </li>

    <?php if ($_SESSION['login_type'] == 1) : ?>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=users">
          <i class="icon-head menu-icon"></i>
          <span class="menu-title">User Settings</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=site_settings">
          <i class="icon-cog menu-icon"></i>
          <span class="menu-title">System Settings</span>
        <?php endif; ?>
        </a>
      </li>




      <!-- Logout -->


      <li class="nav-item">
        <a class="nav-link" href="ajax.php?action=logout1" data-toggle="modal" data-target="#logoutModal">
          <i class="ti-power-off menu-icon"></i>
          <span class="menu-title">Log out</span>
        </a>
      </li>
  </ul>
</nav>
</ul>

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
<!--END OF NAV-->
<script>
  $('.nav').click(function() {
    console.log($(this).attr('href'))
    $($(this).attr('href')).collapse()
  })
  $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>