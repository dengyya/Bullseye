<?php include 'db_connect.php' ?>
<?php
$qry = $conn->query("SELECT * FROM complaints where id = {$_GET['id']} ");
foreach ($qry->fetch_array() as $k => $v) {
    $$k = $v;
}


?>
<link rel="stylesheet" href="css/view.css">


<div class="container-fluid">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <div class="container">
        <div class="team-single">
            <div class="row">


                <div class="col-lg-12 col-md-7">
                    <!--Person Involved-->
                    <div class="team-single-text padding-50px-left pt-4 sm-no-padding-left">
                        <b> Person Involved Details: </b>
                        <hr style="border: 3px solid gray; border-radius: 5px;">

                        <div class="contact-info-section mb-5 margin-40px-tb">
                            <ul class="list-style9 no-margin">
                                <li>

                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class="fas fa-id-card text-dark"></i>
                                            <b class="font-size12 margin-10px-left text-dark"> Name:</b>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>
                                                <?php echo $respondent_lname ?>,
                                                <?php echo $respondent_fname ?>
                                            </p>
                                        </div>
                                    </div>

                                </li>
                                <li>

                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class="fas fa-map-marker-alt text-dark"></i>
                                            <strong class="margin-10px-left "> Address:</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>
                                                <?php echo $complaints_address ?>
                                                <?php echo $complaints_street ?>
                                                <?php echo $complaints_barangay ?>,
                                                <?php echo $complaints_municipality ?>
                                                <?php echo $complaints_province ?>
                                            </p>
                                        </div>
                                    </div>

                                </li>
                                <li>

                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class="fas fa-mobile-alt text-dark"></i>
                                            <strong class="margin-10px-left text-dark">Contact Number:</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p><?php echo $contact_num ?></p>
                                        </div>
                                    </div>

                                </li>
                            </ul>
                        </div>
                        <!--Report Details-->
                        <b class="pt-5"> Report Details: </b>
                        <hr style="border: 3px solid gray; border-radius: 5px;">
                        <div class="contact-info-section mb-5 margin-40px-tb">
                            <ul class="list-style9 no-margin">
                                <li>

                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class="fas fa-map-marked-alt text-dark"></i>
                                            <strong class="margin-10px-left "> Location:</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p><?php echo $incident_location ?>
                                                <?php echo $incident_street ?>
                                                <?php echo $incident_barangay ?>,
                                                <?php echo $incident_municipality ?>
                                                <?php echo $incident_province ?>
                                            </p>

                                        </div>
                                    </div>

                                </li>
                                <li>

                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class="fas fa-pen-square text-dark"></i>
                                            <strong class="margin-10px-left ">Person Involved/Description:</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p><?php echo $description ?></p>
                                        </div>
                                    </div>

                                </li>

                            </ul>
                        </div>


                        <div class="col-md-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>