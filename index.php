<!DOCTYPE html>
<?php require_once "controllerUserData.php"; ?>

<?php include('topbar.php') ?>


<?php

if (isset($_SESSION['login_id'])) {
  $qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
  foreach ($qry->fetch_array() as $k => $v) {
    $$k = $v;
  }
}

?>

<div class="header-home">

  <div class="container">
    <div class="row align-items-center justify-content-center justify-content-lg-between">
      <div class="col-lg-6 col-md-10">
        <div class="header-home-content">
          <h2 class="header-title"><span>Is it an Emergency?</span> Does it need an immediate action? </h2>
          <p class="text">If so, don't hesitate to take a response. Report it now!</p>
          <ul>

            <li> <button class="btn btn-first report-btn" type="button" id="report_crime">Get Started</button> </li>




          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="header-image" id="image">
          <img src="img/experimental-40.png" class="image-1">
        </div>
      </div>
    </div>
  </div>

</div>
</div>

<div class="container subcontent pt-5" style="margin: 130px;">
  <div class="card-deck mb-5">
    <div class="card mb-5 ">
      <img class="card-img-top" src="img/barangay.jpg" alt="Card image cap">
      <div class="card-body">

        <p class="card-text ">Balasing is a barangay in the municipality of Santa Maria, in the province of Bulacan. The barangay has power and authority over its domain. The improvement of the barangay rests on the barangay officials. The barangay chairman, the barangay council and the local business forge prosperity of the barangay.
        </p>
      </div>
    </div>
    <div class="card mb-5">
      <img class="card-img-top" src="img/justice.jpg" alt="Card image cap">
      <div class="card-body">
        <p class="card-text">Katarungang Pambarangay, or the Barangay Justice System is a local justice system in the Philippines. It is operated by the smallest of the local government units, the barangay, and is overseen by the barangay captain, the highest elected official of the barangay and its executive.</p>

      </div>
    </div>
    <div class="card mb-5">
      <img class="card-img-top" src="img/b3.jpg" alt="Card image cap">
      <div class="card-body">

        <p class="card-text">Barangay Conciliation - The barangay makes settlements between the complainant and respondent through barangay conciliation. The offended party files his complaint orally or in written form to the Lupon Chairman (or Barangay Chairman) then he will summon the respondent. If the respondent fails to appear, he is barred from filing ac ounterclain and if the complainant who fails to appear, he is barred from seeking recourse in the court. Both parties will be summoned and settlement takes place. On the other hand, serious complaints or cases will be take over to the police station.</p>

      </div>
    </div>
  </div>
</div>
<!-- Remove the container if you want to extend the Footer to full width. -->
<div class="pt-5 my-5">


</div>
<!-- End of .container -->

<main id="main-field" class="bg-light">
  <?php
  $page = isset($_GET['page']) ? $_GET['page'] : 'home';
  include $page . '.php';

  ?>





  <?php include('footer.php') ?>
  <?php include('functions.php') ?>
  <?php include('fter.php') ?>


  </body>


  </html>