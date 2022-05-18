 <?php include 'db_connect.php' ?>
 <script type="text/javascript" src="vendor/jquery.min.js"></script>

 <?php
  $sql_get = mysqli_query($conn, "SELECT * FROM complainants ");
  $count2 = mysqli_num_rows($sql_get);
  ?>

 <?php
  $qry = $conn->query("SELECT * FROM complaints where status = 1");
  $reports = mysqli_num_rows($qry);
  ?>

 <!-- partial -->
 <div class="content-wrapper d-flex">
   <div class="row">
     <div class="col-md-12 grid-margin">
       <div class="row">
         <div class="col-12 col-xl-8 mb-4 mb-xl-0">
           <h3 class="font-weight-bold">Welcome <?php echo $_SESSION['login_user_fname'] ?>! </h3>
           <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary" id="reports"><?php echo $reports; ?> new reports!</span></h6>
         </div>
       </div>
     </div>


     <div class="row">
       <div class="col-md-6 grid-margin stretch-card">
         <div class="card tale-bg">
           <div class="card-people align-items-center mt-5 offset-md-2  ">
             <img src="images/Welcome.png" alt="people" style="width: 300px">

           </div>
         </div>
       </div>


       <?php
        $sql_get = mysqli_query($conn, "SELECT * FROM complainants WHERE status=1");
        $count1 = mysqli_num_rows($sql_get);
        ?>
       <div class="col-md-6 grid-margin transparent">
         <div class="row">
           <div class="col-md-6 mb-4 stretch-card transparent">
             <div class="card card-tale">
               <div class="card-body">
                 <p class="mb-4"><b>Total Users (Verified)</b></p>
                 <b>
                   <p class="fs-30 mb-" id="count1"><?php echo $count1; ?></p>
                 </b>
                 <p id="count2"> out of <?php echo $count2; ?> Users</p>
               </div>
             </div>
           </div>

           <?php
            $sql_get = mysqli_query($conn, "SELECT * FROM complainants WHERE status=0");
            $count = mysqli_num_rows($sql_get);
            ?>
           <div class="col-md-6 mb-4 stretch-card transparent">
             <div class="card card-dark-blue">
               <div class="card-body">
                 <p class="mb-4"><b>Total Users (Not Verified)</b></p>
                 <b>
                   <p class="fs-30 mb-2" id="count"><?php echo $count; ?></p>
                 </b>
                 <p id="count2"> out of <?php echo $count2; ?> Users</p>
               </div>
             </div>
           </div>
         </div>


         <!-- crime-->
         <?php
          $sql_get = mysqli_query($conn, "SELECT * FROM crime");
          $crime_count = mysqli_num_rows($sql_get);

          $sql_get1 = mysqli_query($conn, "SELECT * FROM crime WHERE status=1");
          $pending = mysqli_num_rows($sql_get1);

          $sql_get2 = mysqli_query($conn, "SELECT * FROM crime WHERE status=2");
          $received = mysqli_num_rows($sql_get2);

          $sql_get = mysqli_query($conn, "SELECT * FROM crime WHERE status=3");
          $action = mysqli_num_rows($sql_get);

          ?>

         <div class="row">
           <div class="col-md-12 mb-4  stretch-card transparent">
             <div class="card card-light-blue">
               <div class="card-body">
                 <p class="mb-4"><b>Total Crime Reports</b></p>
                 <b>
                   <p class="fs-30 mb-2" id="crime_count"><?php echo $crime_count; ?></p>
                 </b>
                 <p id="pending"> Total pending reports: <?php echo $pending; ?></p>
                 <p id="received"> Total received reports: <?php echo $received; ?></p>
                 <p id="action" class="mb-5"> Total action made reports: <?php echo $action; ?></p>
               </div>
             </div>

           </div>

         </div>

       </div>
       <div class="col-lg-12 grid-margin transparent">
         <div class="row">

           <!-- complaints-->
           <?php
            $sql_get = mysqli_query($conn, "SELECT * FROM complaints");
            $c_count = mysqli_num_rows($sql_get);

            $sql_get1 = mysqli_query($conn, "SELECT * FROM complaints WHERE status=1");
            $pending = mysqli_num_rows($sql_get1);

            $sql_get2 = mysqli_query($conn, "SELECT * FROM complaints WHERE status=2");
            $received = mysqli_num_rows($sql_get2);

            $sql_get = mysqli_query($conn, "SELECT * FROM complaints WHERE status=3");
            $action = mysqli_num_rows($sql_get);

            ?>

           <div class="col-md-6 mb-4   stretch-card transparent">
             <div class="card card-light-danger">
               <div class="card-body">
                 <p class="mb-4"><b>Total Complaints Report</b></p>
                 <b>
                   <p class="fs-30 mb-2" id="c_count"><?php echo $c_count; ?></p>
                 </b>
                 <p id="pending"> Total pending reports: <?php echo $pending; ?></p>
                 <p id="received"> Total received reports: <?php echo $received; ?></p>
                 <p id="action"> Total action made reports: <?php echo $action; ?></p>
               </div>
             </div>
           </div>



           <!-- missing-->
           <?php
            $sql_get = mysqli_query($conn, "SELECT * FROM missing");
            $c_count = mysqli_num_rows($sql_get);

            $sql_get1 = mysqli_query($conn, "SELECT * FROM missing WHERE status=1");
            $pending = mysqli_num_rows($sql_get1);

            $sql_get2 = mysqli_query($conn, "SELECT * FROM missing WHERE status=2");
            $received = mysqli_num_rows($sql_get2);

            $sql_get = mysqli_query($conn, "SELECT * FROM missing WHERE status=3");
            $action = mysqli_num_rows($sql_get);

            ?>
           <div class="col-6 mb-4  stretch-card transparent">
             <div class="card card-tale">
               <div class="card-body">
                 <p class="mb-4"><b>Total Missing Report</b></p>
                 <b>
                   <p class="fs-30 mb-2" id="c_count"><?php echo $c_count; ?></p><b>
                     <p id="pending"> Total pending reports: <?php echo $pending; ?></p>
                     <p id="received"> Total received reports: <?php echo $received; ?></p>
                     <p id="action"> Total action made reports: <?php echo $action; ?></p>
               </div>
             </div>
           </div>

         </div>
       </div>

     </div>



   </div>
 </div>

 </div>

 </div>
 </div>



 <script>
   $('#manage-records').submit(function(e) {
     e.preventDefault()
     start_load()
     $.ajax({
       url: 'ajax.php?action=save_track',
       data: new FormData($(this)[0]),
       cache: false,
       contentType: false,
       processData: false,
       method: 'POST',
       type: 'POST',
       success: function(resp) {
         resp = JSON.parse(resp)
         if (resp.status == 1) {
           alert_toast("Data successfully saved", 'success')
           setTimeout(function() {
             location.reload()
           }, 800)

         }

       }
     })
   })
   $('#tracking_id').on('keypress', function(e) {
     if (e.which == 13) {
       get_person()
     }
   })
   $('#check').on('click', function(e) {
     get_person()
   })

   function get_person() {
     start_load()
     $.ajax({
       url: 'ajax.php?action=get_pdetails',
       method: "POST",
       data: {
         tracking_id: $('#tracking_id').val()
       },
       success: function(resp) {
         if (resp) {
           resp = JSON.parse(resp)
           if (resp.status == 1) {
             $('#name').html(resp.name)
             $('#address').html(resp.address)
             $('[name="person_id"]').val(resp.id)
             $('#details').show()
             end_load()

           } else if (resp.status == 2) {
             alert_toast("Unknow tracking id.", 'danger');
             end_load();
           }
         }
       }
     })
   }
 </script>