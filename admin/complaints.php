<?php
include 'db_connect.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="">
				<div class="">
					<b>List of Report of Complaints</b>

					<table data-bs-toggle="table" class="table-bordered table-hover" id="complaint-tbl">

						<thead>
							<tr>
								<th width="10%">Date</th>
								<th width="10%" class="text-center">Case No</th>
								<th width="10%">Complainant Information </th>
								<th width="20%">Respondent Information </th>
								<th width="20%">Complaint Information</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>

							</tr>
						</thead>
						<tbody>
				</div>
				<?php
				$status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
				$qry = $conn->query("SELECT * FROM complaints order by date_created ASC ");
				while ($row = $qry->fetch_array()) :
				?>
					<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
						<td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>

						<td class="text-center">CN0<?php echo $row['id'] ?></td>
						<td>
							<p> <b>Name: </b> <?php echo $row['complainant_fname'] ?> <?php echo $row['complainant_lname'] ?> <br>
								<b>Contact Number:</b> <?php echo $row['complainant_contact'] ?>
							</p>
						</td>

						<td>
							<p> <b>Name: </b> <?php echo $row['respondent_fname'] ?> <?php echo $row['respondent_lname'] ?> <br>
								<b>Address:</b> <?php echo $row['complaints_address'] ?>, <?php echo $row['complaints_street'] ?>,
								<?php echo $row['complaints_barangay'] ?>, <?php echo $row['complaints_municipality'] ?>,
								<?php echo $row['complaints_province'] ?><br>
								<b>Contact Number:</b> <?php echo $row['contact_num'] ?>
							</p>
						</td>

						<td>
							<p><b>Type of Complaint: </b><?php echo $row['type'] ?> <br>
								<b>Incident Address:</b> <?php echo $row['incident_location'] ?>,
								<?php echo $row['incident_street'] ?>,
								<?php echo $row['incident_barangay'] ?>, <?php echo $row['incident_municipality'] ?>,
								<?php echo $row['incident_province'] ?><br>
								<b> Description: </b><?php echo $row['description'] ?>
						</td>
						</p>

						<td class='text-center'>
							<?php if ($row['status'] == 1) : ?>
								<span class="badge badge-primary ">Pending</span>
							<?php elseif ($row['status'] == 2) : ?>
								<span class="badge badge-info">Received </span>
							<?php elseif ($row['status'] == 3) : ?>
								<span class="badge badge-success">Action Made </span>
							<?php elseif ($row['status'] == 4) : ?>
								<span class="badge badge-dark"> Cased Closed</span>
							<?php elseif ($row['status'] == 5) : ?>
								<span class="badge badge-danger">Cancelled </span>
							<?php endif; ?>

						</td>
						<td class="text-center">
							<button class="btn btn-primary btn-sm m-0 view_btn" type="button" data-id="<?php echo $row['id'] ?>">View</button>
						</td>
					</tr>
				<?php endwhile; ?>
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.css">
<script src="https://unpkg.com/bootstrap-table@1.19.1/dist/bootstrap-table.min.js"></script>
<style>
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
	$('.view_btn').click(function() {
		uni_modal("View Details", "manage_complaint.php?id=" + $(this).attr('data-id'), "mid-large")
	})
</script>