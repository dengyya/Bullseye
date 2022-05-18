<?php
include 'db_connect.php';
if (isset($_GET['id'])) {
  $qry = $conn->query("SELECT * FROM complaints where id= " . $_GET['id']);
  foreach ($qry->fetch_array() as $k => $val) {
    $$k = $val;
  }
}
?>


<div class="container-fluid">
  <div id="msg"></div>

  <form action="" id="manage-complaint">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">

            <div class="card-header text-center">
              <h5>INFORMATION ABOUT THE COMPLAINANT</h5>
            </div>
            <div class="card-body justify-content-center">

              <center>
                <p class="card-text">Kindly fill in the form in order to assist you regarding with your report.</p>
              </center>

              <div class="card-body justify-content-center text-dark">
                <div class="form-group row">
                  <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                  <div class="form mb-2 justify-content-center">

                    <div class="row">
                      <div class="col-lg-4 mb-2">
                        <label for="complainant_fname">First name:</label>
                        <input type="text" class="form-control" value="<?php echo isset($complainant_fname) ? $complainant_fname : '' ?>" name="complainant_fname" id="complainant_fname" placeholder="Complainant First name" required pattern="^\D*$" title="Number Not Allowed" required>
                      </div>

                      <div class="col-lg-4 mb-2">
                        <label for="complainant_lname">Last name:</label>
                        <input type="text" class="form-control" name="complainant_lname" id="complainant_lname" value="<?php echo isset($complainant_lname) ? $complainant_lname : '' ?>" placeholder=" Complainant Last name" required pattern="^\D*$" title="Number Not Allowed" required>
                      </div>



                      <div class="col-lg-4 mb-2">
                        <label for="complainant_contact">Contact Number:</label>
                        <input type="text" class="form-control" name="complainant_contact" id="complainant_contact" minlength="11" maxlength="11" placeholder="09xxxxxxxxx" pattern="^(09|\+639)\d{9}$" title="Contact Number should be on this format: 09xxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo isset($complainant_contact) ? $complainant_contact : '' ?>" required="">
                      </div>
                    </div>
                  </div>


                  <div class="card-header text-center">
                    <h5>INFORMATION ABOUT RESPONDENT</h5>
                  </div>
                  <div class="card-body justify-content-center">

                    <p class="card-text">Kindly fill in the form in order to assist you regarding with your report.
                      Please rest assured that any personal information you send via this website will remain strictly private. We will not disclose any such information to third parties without obtaining your permission in advance.
                      If for some reason we have to alter this confidentiality policy in any way, we will notify you here, on this page. </p>


                    <div class="form mb-2 justify-content-center">

                      <div class="row">
                        <div class="col-lg-6 mb-2">
                          <label for="respondent_fname">First name:</label>
                          <input type="text" class="form-control" value="<?php echo isset($respondent_fname) ? $respondent_fname : '' ?>" name="respondent_fname" id="respondent_fname" placeholder="First name" title="Number Not Allowed">
                        </div>

                        <div class="col-lg-6 mb-2">
                          <label for="respondent_lname">Last name:</label>
                          <input type="text" class="form-control" name="respondent_lname" id="respondent_lname" value="<?php echo isset($respondent_lname) ? $respondent_lname : '' ?>" placeholder="Last name" title="Number Not Allowed">
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <div class="row">
                        <div class="form-group col-lg-6 mb-2">
                          <label for="complaints_address">Address</label>
                          <input type="text" class="form-control" name="complaints_address" id="complaints_address" value="<?php echo isset($complaints_address) ? $complaints_address : '' ?>" placeholder="House Number">
                        </div>


                        <div class="form-group col-lg-6 mb-2">
                          <label for="complaints_street">Street</label>
                          <select class="custom-select" name="complaints_street" id="complaints_street" value="<?php echo isset($complaints_street) ? $complaints_street : '' ?>">
                            <option selected></option>

                            <option value="Alonzo" <?php echo isset($complaints_street) && $complaints_street == "Alonzo" ? 'selected' : "" ?>>Alonzo</option>
                            <option value="Bagong Barrio" <?php echo isset($complaints_street) && $complaints_street == "Bagong Barrio" ? 'selected' : "" ?>>Bagong Barrio</option>
                            <option value="Baustita" <?php echo isset($complaints_street) && $complaints_street == "Baustita" ? 'selected' : "" ?>>Baustita</option>
                            <option value="Caingin" <?php echo isset($complaints_street) && $complaints_street == "Caingin" ? 'selected' : "" ?>>Caingin</option>
                            <option value="Castillo" <?php echo isset($complaints_street) && $complaints_street == "Castillo" ? 'selected' : "" ?>>Castillo</option>
                            <option value="Caybutok" <?php echo isset($complaints_street) && $complaints_street == "Caybutok" ? 'selected' : "" ?>>Caybutok</option>
                            <option value="Ewong" <?php echo isset($complaints_street) && $complaints_street == "Ewong" ? 'selected' : "" ?>>Ewong</option>
                            <option value="Galas 1" <?php echo isset($complaints_street) && $complaints_street == "Galas 1" ? 'selected' : "" ?>>Galas 1</option>
                            <option value="Galas 2" <?php echo isset($complaints_street) && $complaints_street == "Galas 2" ? 'selected' : "" ?>>Galas 2</option>
                            <option value="Guam" <?php echo isset($complaints_street) && $complaints_street == "Guam" ? 'selected' : "" ?>>Guam
                            <option value="Hulo" <?php echo isset($complaints_street) && $complaints_street == "Hulo" ? 'selected' : "" ?>>Hulo</option>
                            <option value="Kubo" <?php echo isset($complaints_street) && $complaints_street == "Kubo" ? 'selected' : "" ?>>Kubo</option>
                            <option value="Luwasan" <?php echo isset($complaints_street) && $complaints_street == "Luwasan" ? 'selected' : "" ?>>Luwasan</option>
                            <option value="Manggahan" <?php echo isset($complaints_street) && $complaints_street == "Manggahan" ? 'selected' : "" ?>>Manggahan</option>
                            <option value="Nigro" <?php echo isset($complaints_street) && $complaints_street == "Nigro" ? 'selected' : "" ?>>Nigro</option>
                            <option value="Pari 1" <?php echo isset($complaints_street) && $complaints_street == "Pari 1" ? 'selected' : "" ?>>Pari 1</option>
                            <option value="Pari 2" <?php echo isset($complaints_street) && $complaints_street == "Pari 2" ? 'selected' : "" ?>>Pari 2</option>
                            <option value="Paying" <?php echo isset($complaints_street) && $complaints_street == "Paying" ? 'selected' : "" ?>>Paying</option>
                            <option value="Tabing Ilog" <?php echo isset($complaints_street) && $complaints_street == "Tabing Ilog" ? 'selected' : "" ?>>Tabing Ilog</option>
                            <option value="Ventura" <?php echo isset($complaints_street) && $complaints_street == "Ventura" ? 'selected' : "" ?>>Ventura</option>
                          </select>
                        </div>


                        <div class="form-group col-lg-4 mb-2">
                          <label for="barangay">Barangay</label>
                          <select class="custom-select" name="complaints_barangay" id="barangay" value="<?php echo isset($complaints_barangay) ? $complaints_barangay : '' ?>">
                            <option value="Balasing">Balasing</option>
                          </select>

                        </div>
                        <div class="form-group col-lg-4 mb-2">
                          <label for="municipality">Municipality</label>
                          <select class="custom-select" name="complaints_municipality" id="municipality" value="<?php echo isset($complaints_municipality) ? $complaints_municipality : '' ?>">
                            <option value="Santa Maria">Santa Maria</option>
                          </select>

                        </div>
                        <div class="form-group col-lg-4 mb-2">
                          <label for="province">Province</label>
                          <select class="custom-select" name="complaints_province" id="province" value="<?php echo isset($complaints_province) ? $complaints_province : '' ?>">
                            <option value="Bulacan">Bulacan</option>
                          </select>

                        </div>


                        <div class="form-group col-lg-6  mb-2">
                          <label for="contact_num">Contact Number:</label>
                          <input type="number" class="form-control" name="contact_num" id="contact_num" minlength="11" maxlength="11" placeholder="09xxxxxxxxx" pattern="^(09|\+639)\d{9}$" title="Contact Number should be on this format: 09xxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo isset($contact_num) ? $contact_num : '' ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="card-header text-center">
                  <h5>INFORMATION ABOUT THE REPORT</h5>
                </div>

                <div class="card-body justify-content-center">

                  <p class="card-text">I hereby complain against above named respondent/s for violating my/our
                    rights and interests in the following manner: </p>


                  <div class="card-body justify-content-center text-dark">
                    <div class="form-group row">
                      <div class="form-group col-md-3">
                        <label for="date_happened">Date Happened:</label>
                        <input type="date" name="date_happened" class="form-control" id="date_happened" value="<?php echo isset($date_happened) ? $date_happened : '' ?>" required>
                      </div>

                      <div class="form-group col-md-3 ">
                        <label for="time_of_incident">Time of Incident:</label>
                        <input type="time" onchange="onTimeChange()" id="timeInput" name="time_of_incident" value="<?php echo isset($time_of_incident) ? $time_of_incident : '' ?>" class="form-control" required="">
                      </div>



                      <div class="form-group col-md-6">
                        <label for="type">Type of Complaint</label>
                        <div class="form-group col-lg-6 mb-2">
                          <input type="text" name="type" list="type" placeholder="Please specify">
                          <datalist id="type">
                            <option value="Lending (Pagpapautang)" <?php echo isset($type) && $type == "Lending (Pagpapautang)" ? 'selected' : "" ?>>Lending (Pagpapautang)</option>
                            <option value="Improper Parking (Hindi tamang pagpaparada ng sasakyan)" <?php echo isset($type) && $type == "Improper Parking (Hindi tamang pagpaparada ng sasakyan)" ? 'selected' : "" ?>>Improper Parking (Hindi tamang pagpaparada ng sasakyan)</option>
                            <option value="Waste Management (Pamamahala ng basura)" <?php echo isset($type) && $type == "Waste Management (Pamamahala ng basura)" ? 'selected' : "" ?>>Waste Management (Pamamahala ng basura)</option>
                            <option value="Fraud (Panloloko)" <?php echo isset($type) && $type == "Fraud (Panloloko)" ? 'selected' : "" ?>>Fraud (Panloloko)</option>
                            <option value="Brawl (Pagaaway/Kaguluhan)" <?php echo isset($type) && $type == "Brawl (Pagaaway/Kaguluhan)" ? 'selected' : "" ?>>Brawl (Pagaaway/Kaguluhan)</option>
                            <option value="Fight over Land (Pagaaway dahil sa lupa)" <?php echo isset($type) && $type == "Fight over Land (Pagaaway dahil sa lupa)" ? 'selected' : "" ?>>Fight over Land (Pagaaway dahil sa lupa)</option>
                            <option value="Slight Physical Injuries and Maltreatment (Pananakit)" <?php echo isset($type) && $type == "Slight Physical Injuries and Maltreatment (Pananakit)" ? 'selected' : "" ?>>Slight Physical Injuries and Maltreatment (Pananakit)</option>

                          </datalist>

                        </div>
                      </div>




                      <div class="form-group">
                        <div class="row">
                          <div class="form-group col-lg-6 mb-2">
                            <label for="incident_location">Location of the said Incident (Landmark)</label>
                            <input type="text" class="form-control" name="incident_location" id="incident_location" value="<?php echo isset($incident_location) ? $incident_location : '' ?>" required>
                          </div>


                          <div class="form-group col-lg-6 mb-2">
                            <label for="incident_street">Street</label>
                            <select class="custom-select" name="incident_street" id="incident_street" value="<?php echo isset($incident_street) ? $incident_street : '' ?>" required>
                              <option selected></option>

                              <option value="Alonzo" <?php echo isset($incident_street) && $incident_street == "Alonzo" ? 'selected' : "" ?>>Alonzo</option>
                              <option value="Bagong Barrio" <?php echo isset($incident_street) && $incident_street == "Bagong Barrio" ? 'selected' : "" ?>>Bagong Barrio</option>
                              <option value="Baustita" <?php echo isset($incident_street) && $incident_street == "Baustita" ? 'selected' : "" ?>>Baustita</option>
                              <option value="Caingin" <?php echo isset($incident_street) && $incident_street == "Caingin" ? 'selected' : "" ?>>Caingin</option>
                              <option value="Castillo" <?php echo isset($incident_street) && $incident_street == "Castillo" ? 'selected' : "" ?>>Castillo</option>
                              <option value="Caybutok" <?php echo isset($incident_street) && $incident_street == "Caybutok" ? 'selected' : "" ?>>Caybutok</option>
                              <option value="Ewong" <?php echo isset($incident_street) && $incident_street == "Ewong" ? 'selected' : "" ?>>Ewong</option>
                              <option value="Galas 1" <?php echo isset($incident_street) && $incident_street == "Galas 1" ? 'selected' : "" ?>>Galas 1</option>
                              <option value="Galas 2" <?php echo isset($incident_street) && $incident_street == "Galas 2" ? 'selected' : "" ?>>Galas 2</option>
                              <option value="Guam" <?php echo isset($incident_street) && $incident_street == "Guam" ? 'selected' : "" ?>>Guam
                              <option value="Hulo" <?php echo isset($incident_street) && $incident_street == "Hulo" ? 'selected' : "" ?>>Hulo</option>
                              <option value="Kubo" <?php echo isset($incident_street) && $incident_street == "Kubo" ? 'selected' : "" ?>>Kubo</option>
                              <option value="Luwasan" <?php echo isset($incident_street) && $incident_street == "Luwasan" ? 'selected' : "" ?>>Luwasan</option>
                              <option value="Manggahan" <?php echo isset($incident_street) && $incident_street == "Manggahan" ? 'selected' : "" ?>>Manggahan</option>
                              <option value="Nigro" <?php echo isset($incident_street) && $incident_street == "Nigro" ? 'selected' : "" ?>>Nigro</option>
                              <option value="Pari 1" <?php echo isset($incident_street) && $incident_street == "Pari 1" ? 'selected' : "" ?>>Pari 1</option>
                              <option value="Pari 2" <?php echo isset($incident_street) && $incident_street == "Pari 2" ? 'selected' : "" ?>>Pari 2</option>
                              <option value="Paying" <?php echo isset($incident_street) && $incident_street == "Paying" ? 'selected' : "" ?>>Paying</option>
                              <option value="Tabing Ilog" <?php echo isset($incident_street) && $incident_street == "Tabing Ilog" ? 'selected' : "" ?>>Tabing Ilog</option>
                              <option value="Ventura" <?php echo isset($incident_street) && $incident_street == "Ventura" ? 'selected' : "" ?>>Ventura</option>
                            </select>
                          </div>


                          <div class="form-group col-lg-4 mb-2">
                            <label for="incident_barangay">Barangay</label>
                            <select class="custom-select" name="incident_barangay" id="incident_barangay" value="<?php echo isset($incident_barangay) ? $incident_barangay : '' ?>" required>
                              <option value="Balasing">Balasing</option>
                            </select>

                          </div>
                          <div class="form-group col-lg-4 mb-2">
                            <label for="incident_municipality">Municipality</label>
                            <select class="custom-select" name="incident_municipality" id="incident_municipality" value="<?php echo isset($incident_municipality) ? $incident_municipality : '' ?>" required>
                              <option value="Santa Maria">Santa Maria</option>
                            </select>

                          </div>
                          <div class="form-group col-lg-4 mb-2">
                            <label for="incident_province">Province</label>
                            <select class="custom-select" name="incident_province" id="incident_province" value="<?php echo isset($incident_province) ? $incident_province : '' ?>" required>
                              <option value="Bulacan">Bulacan</option>
                            </select>

                          </div>

                          <div class="form-group">
                            <label for="description">Description of the Report (What happened, how it happened, factors leading to the event). Be specific as possible</label>
                            <textarea name="description" id="" cols="30" rows="4" class="form-control" required=""><?php echo isset($description) ? $description : '' ?></textarea>
                          </div>


                        </div>
                      </div>
                    </div>
                  </div>

                  <center>
                    <button class="button btn btn-primary btn-sm">Submit</button>
                    <button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>
                  </center>

  </form>


  <style>
    #uni_modal .modal-footer {
      display: none;
    }
  </style>


  <script>
    var inputEle = document.getElementById('time');


    function onTimeChange() {
      var timeSplit = inputEle.value.split(':'),
        hours,
        minutes,
        meridian;
      hours = timeSplit[0];
      minutes = timeSplit[1];
      if (hours > 12) {
        meridian = 'PM';
        hours -= 12;
      } else if (hours < 12) {
        meridian = 'AM';
        if (hours == 0) {
          hours = 12;
        }
      } else {
        meridian = 'PM';
      }
      alert(hours + ':' + minutes + ' ' + meridian);
    }


    $('#manage-complaint').submit(function(e) {
      e.preventDefault()
      start_load()
      if ($(this).find('.alert-danger').length > 0)
        $(this).find('.alert-danger').remove();
      $.ajax({
        url: 'admin/ajax.php?action=complaint',
        method: 'POST',
        data: $(this).serialize(),
        error: err => {
          console.log(err)
          $('#manage-complaint button[type="submit"]').removeAttr('disabled').html('Create');

        },
        success: function(resp) {
          if (resp == 1) {
            $('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
            setTimeout(function() {
              location.href = "success.php";
            }, 1500)
          } else {
            end_load()
          }
        }
      })
    })
  </script>