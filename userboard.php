<?php 
include 'admin/db_connect.php'; 
?>

<?php
    session_start();
    include('admin/db_connect.php');
    if(isset($_SESSION['login_id'])){
      $qry = $conn->query("SELECT * from complainants where id = {$_SESSION['login_id']} ");
      foreach($qry->fetch_array() as $k => $v){
        $$k = $v;
      }
    }
    include('header.php');

	
    ?>

<style>
.content{
  padding-top:150px;
  padding-bottom: 250px
}
</style>
<?php include('head.php') ?>

<body>
  <div class="container">
  <div class="row">
    <div class="col-lg-5 p-4 pt-5 alingn-items- ">
    <img src="img/Welcome.png" alt="report" width="300">
    </div>
    <div class="col-lg-7 mt-5 alingn-items-left">
    <h3 class="header-title">Hi, Welcome to Bullseye! </h3>
                <p class="text-large no-margin text-justify mb-5">We want to provide a resolution of disputes for you in order to achieve peace and 
                harmony within your community. Here are the quick and easy steps on how you can a file a report: <br> <br>
                1. Scroll up your screen and select what type of report you would like to submit. <br>
                2. Kindly fill out and provide all the needed information on your selected report. <br>
                3. Submit your report and kindly view the status bar for you to keep updated regarding with the file you have submitted. <br>
                4. Kindly follow the next procedures or action you need to comply upon the process of your report. <br>
                5. Once the process is completed, the acting officer will give you a legal advise and resolution about your concern.</p>
   
                <ul>
                  
                 

                </ul>
    </div>

<!-- File Report -->
<div class="col-lg-8 content">
    <div class="content-wrapper">
          <div class="row">
          <div class="col-lg-12 mb-4">
          <h4 class=" "><i class="fas fa-file-alt mr-2"></i>How to File a Report?</h4>
                  <p class="text-large no-margin ">Here are the details on how you file a report such as complaint, crime and for a missing person. Kindly view the instructions below so you can be guided to your concerns. </p>
          </div>
            <div class="col-lg-6 grid-margin stretch-card mb-4">
              <div class="card"style= "background-color: #f1f4f4">
                <div class="card-body ">
                <img src="img/here.png" alt="report" width="140px">
                </div> 
              </div>
            </div>

            <!--Complaint-->
            <div class="col-lg-6 grid-margin stretch-card mb-4">
              <div class="card" style= "background-color: #d1d1d1" >
                <div class="card-body">
                  <h6 class=" "><i class="fas fa-bullhorn mr-2"></i>File a Complaint</h6>
                  <p class="text-large no-margin ">Complaint is a concise statement of ultimate facts
                  constituting the plaintiff’s cause and causes of action.</p>
                  <a href="#" class="btn btn-light" id="file_complaint" style="float:right"><i class="fas fa-angle-right"></i></a>
                </div> 
              </div>
            </div>


             <!--Crime-->
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card"style= "background-color: #e1dbd6">
                <div class="card-body">
                <h6 class=" "><i class="fas fa-bell mr-2"></i>Report a Crime</h6>
                  <p class="text-large no-margin ">A document that details all of the facts, circumstances, and timeline of events surrounding an incident.</p>
                  <a href="javascript:void(0)" class="btn btn-light" id="reportcrime" style="float:right"><i class="fas fa-angle-right"></i></a>
                </div> 
              </div>
            </div>


             <!--Missing Person-->
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card"style= "background-color: #CFCFC4" >
                <div class="card-body">
                <h6 class=" "><i class="fas fa-question-circle mr-2"></i>Missing Person Report</h6>
                  <p class="text-large no-margin ">A document that officially reports that someone is missing. This case should report as soon as possible.  </p>
                  <a href="#" class="btn btn-light" id="report_missing" style="float:right"><i class="fas fa-angle-right"></i> </a>
                </div> 
              </div>
            </div>


            </div>
            <div>
            
            </div>
             
            </div>
</div>
            <div class="col-lg-4 content">
            <div class="card" style="width: 17rem;">
  <img class="card-img-top mb-2" src="img/instruction.png" alt="Card image cap">
  <div class="card-body">
  <h6 class=" "><i class="fas fa-tools mr-2"></i>Instructions</h6>
                  <p class="text-large no-margin ">Find so difficult to file an online report? We got you! Kindly click the arrow button so you can see  on how you can file a report about your concerns. Upon submitting of report you will see the status, action should be done and filing once your case is completed. </p>
    
  </div>
</div></div>
  </div>

  </div>
  
</body>

<?php include('footer.php') ?>
    <?php include('functions.php') ?>
    <?php include('fter.php')?>
</html>
<script>
   $('#file_complaint').click(function(){
    if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
          uni_modal("Login",'login.php',"large");
          return false;
        }
          uni_modal("File a Complaint",'manage_report.php',"large");
      })

      $('#reportcrime').click(function(){
        if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
          uni_modal("Login",'login.php',"large");
          return false;
        }
          uni_modal("Report a Crime",'manage_crime.php',"mid-large");
      })

      $('#report_missing').click(function(){
        if('<?php echo !isset($_SESSION['login_id']) ? 1 : 0 ?>'==1){
          uni_modal("Login",'login.php',"large");
          return false;
        }
          uni_modal("Report Missing Person",'manage_missing.php',"mid-large");
      })

</script>
