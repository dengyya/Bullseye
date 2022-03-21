    <!-- TOP BAR START -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="images/logos.png" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="images/bullseye_logo.png" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">



        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="icon-head  menu-icon"></i><?php echo $_SESSION['login_user_fname'] ?> <?php echo $_SESSION['login_user_lname'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">



              <a class="dropdown-item" href="ajax.php?action=logout1" data-toggle="modal" data-target="#logoutModal">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>

            </div>
          </li>

        </ul>



        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>

    <!-- TOP BAR END -->

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
            <a class="btn btn-primary" href="ajax.php?action=logout">Yes</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>

          </div>
        </div>
      </div>
    </div>

    <!-- Change Pass -->



    <script>
      $('#manage_my_account').click(function() {
        uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
      })
    </script>