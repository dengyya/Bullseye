<?php
include 'db_connect.php';
?>
<div class="container-fluid py-1">
	<table class="table table-bordered table-hover" id="complaint-tbl">
		<thead>
			<tr>
				<th width="10%" class="text-center">No</th>
				<th width="20%" class="text-center">Case No</th>
				<th width="20%" class="text-center">Date </th>
				<th width="20%" class="text-center">Report Information</th>
				<th width="20%" class="text-center">Status of Report</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			$status = array("", "Pending", "Received", "Action Made");
			$qry = $conn->query("SELECT * FROM crime where complainant_id = {$_GET['id']} order by unix_timestamp(date_created) desc ");
			while ($row = $qry->fetch_array()) :
			?>
				<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
					<td class="text-center"> <?php echo $i++ ?> </td>
					<td class="text-center">CR<?php echo $row['id'] ?></td>
					<td class="text-center">
						<?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?>
					</td>
					<td class="text-center">
						<p><?php echo $row['type_of_crime'] ?></p>
						<p>Incident Location: <?php echo $row['crime_street'] ?>, <?php echo $row['crime_barangay'] ?>
							(Landmark: <?php echo $row['crime_landmark'] ?>)</p>
						<p>Person Involved: <?php echo $row['involved_person'] ?></p>
						<p>Details:<?php echo $row['crime_details'] ?></p>
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