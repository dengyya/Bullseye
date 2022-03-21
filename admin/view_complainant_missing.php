<?php
include 'db_connect.php';
?>
<div class="container-fluid">
      <table class="table table-bordered table-hover" id="complaint-tbl">
            <thead>
                  <tr>

                        <th class="text-center">No</th>
                        <th width="5%" class="text-center">Date</th>
                        <th class="text-center" class="text-center">Missing Case No</th>
                        <th width="30%" class="text-center">Image</th>
                        <th width="20%" class="text-center">Missing Person</th>
                        <th width="10%" class="text-center">Informer Information</th>
                        <th width="20%" class="text-center">Details</th>
                  </tr>
            </thead>
            <tbody>
                  <?php
                  $i = 1;
                  $status = array("", "Pending", "Received", "Action Made");
                  $qry = $conn->query("SELECT * FROM missing where complainant_id = {$_GET['id']} order by unix_timestamp(date_created) desc ");
                  while ($row = $qry->fetch_array()) :
                  ?>
                        <tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
                              <td class="text-center"><?php echo $i++ ?></td>
                              <td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>

                              <td class="text-center">MN-<?php echo $row['id'] ?></td>

                              <td>
                                    <?php echo '<img src="assets/uploads/' . $row['missing_image'] . '" width="250px;" height="250px;" alt="Image">' ?>
                              </td>

                              <td>
                                    <?php echo date('M d, Y', strtotime($row['date_happened'])) ?><br>
                                    Name: <?php echo $row['missing_fname'] ?> <?php echo $row['missing_lname'] ?> <br>
                                    <?php echo $row['missing_age'] ?> <br>
                                    <?php echo $row['missing_gender'] ?>
                              </td>

                              <td>
                                    <?php echo $row['informer_fname'] ?> <?php echo $row['informer_lname'] ?><br>
                                    <?php echo $row['contact_number'] ?>
                              </td>

                              <td>
                                    Last seen: <?php echo $row['missing_address'] ?><br>
                                    <?php echo $row['physical_description'] ?>,<br>
                                    <?php echo $row['missing_cloth'] ?>
                              </td>




                        </tr>
                  <?php endwhile; ?>
            </tbody>
      </table>
</div>
<div class="modal-footer row display py-1">
      <div class="col-lg-12">
            <button class="btn float-right btn-secondary" type="button" data-dismiss="modal">Close</button>
      </div>
</div>
<style>
      #uni_modal .modal-footer {
            display: none
      }

      #uni_modal .modal-footer.display {
            display: block
      }

      .border-gradien-alert {
            border-image: linear-gradient(to right, red, yellow) !important;
      }

      .border-alert th,
      .border-alert td {
            animation: blink 200ms infinite alternate;
      }

      @keyframes blink {
            from {
                  border-color: white;
            }

            to {
                  border-color: red;
                  background: #ff00002b;
            }
      }
</style>
<script>
      $('#complaint-tbl').dataTable();
</script>