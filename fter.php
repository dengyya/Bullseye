<footer class="text-dark text-center text-lg-start bg-gray">
  <!-- Grid container -->
  <div class="container p-4">
    <!--Grid row-->
    <div class="row ">
      <!--Grid column-->
      <div class="col-lg-4 col-md-12  mb-4 mb-md-0">
        <h6 class="text-uppercase mb-4"> About BULLSEYE</a></h6>

        <p>
          Bullseye is a web-based online reporting system that gives services in Barangay Balasing, Santa Maria, Bulacan.
          <br> <br>Our goal is to Reporting of complaints in barangay is essential to provide action for certain problems on ground and to make a settlement for every chaos
        </p>



      </div>
      <!--Grid column-->

      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4  mb-md-0">

        <h6 class="text-uppercase mb-4">CONTACT US</h6>
        <ul class="fa-ul" style="margin-left: 1.65em;">

          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-envelope"></i></span><a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a></span>
          </li>
          <li class="mb-3">
            <span class="fa-li"><i class="fas fa-phone"></i></span><span class="ms-2"><?php echo $_SESSION['system']['contact'] ?></span>
          </li>

        </ul>
      </div>
      <!--Grid column-->
      <div class="col-lg-4 col-md-12 mb-4 pl-5 mb-md-0">

        <h6 class="text-uppercase mb-4">policies</h6>
        <ul class="fa-ul" style="margin-left: 1.65em;">


          <li class="mb-3"> <span class="fa-li"><i class="fas fa-book-open"><a href="terms_services.php"></i></span><span class="ms-2">Terms of Service</a></span></li>
          <li class="mb-3"> <span class="fa-li"><i class="fas fa-user-secret "><a href="privacy.php"></i></span><span class="ms-2">Privacy Policy</span></a></li>


        </ul>
      </div>



      <!-- Grid container -->

      <!-- Copyright -->
      <div class="container">
        <div class="small text-center text-muted">Copyright © 2022 - <?php echo $_SESSION['system']['name'] ?> | <a href="index.php?=home/" target="_blank">BullSeye</a></div>
      </div>

</footer>