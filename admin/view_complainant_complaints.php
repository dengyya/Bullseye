<?php
include 'db_connect.php';
?>
<div class="container-fluid">
	<table class="table table-bordered table-hover" id="complaint-tbl">
		<thead>
			<tr>

				<th width="10%" class="text-center">No</th>
				<th width="20%" class="text-center">Case No</th>
				<th width="20%" class="text-center">Complainant </th>
				<th width="20%" class="text-center">Respondent Information</th>
				<th width="20%" class="text-center">Report Information</th>
				<th width="20%" class="text-center">Status of Report</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			$status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
			$qry = $conn->query("SELECT * FROM complaints where complainant_id = {$_GET['id']} order by unix_timestamp(date_created) desc ");
			while ($row = $qry->fetch_array()) :
			?>
				<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
					<td class="text-center"> <?php echo $i++ ?> </td>
					<td class="text-center">CN<?php echo $row['id'] ?></td>
					<td class="text-center">
						<?php echo $row['complainant_fname'] ?> <?php echo $row['complainant_lname'] ?>
					</td>
					<td>
						<p>Name: <?php echo $row['respondent_fname'] ?> <?php echo $row['respondent_lname'] ?></p>
						<p>Contact Number: <?php echo $row['contact_num'] ?></p>
						<p>Address: <?php echo $row['complaints_address'] ?>,
							<?php echo $row['complaints_street'] ?>,
							<?php echo $row['complaints_barangay'] ?>,<br>
							<?php echo $row['complaints_municipality'] ?>,
							<?php echo $row['complaints_province'] ?></p>
					</td>
					<td>
						<p>Date Happened: <?php echo date('M d, Y', strtotime($row['date_happened'])) ?></p>
						<p>Incident Location: <?php echo $row['incident_location'] ?>,
							<?php echo $row['incident_street'] ?>,<br>
							<?php echo $row['incident_barangay'] ?>,
							<?php echo $row['incident_municipality'] ?>,
							<?php echo $row['incident_province'] ?></p>
						<p>Type of complaint: <?php echo $row['type'] ?></p>
						<p>Details: <?php echo $row['description'] ?></p>
					</td>

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