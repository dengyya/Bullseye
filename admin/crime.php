<?php
include 'db_connect.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="">
				<div class="">
					<!-- List of reports in crime -->
					<b>List of Reports of Crime</b>

					<table data-bs-toggle="table" class=" table-bordered table-hover" id="complaint-tbl">
						<thead>
							<tr>
								<th width="10%">Date</th>
								<th width="10%">Date</th>
								<th width="10%">Type of Crime</th>
								<th width="20%">Location</th>
								<th width="20%">Person Involved</th>
								<th width="20%">Details</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
						</thead>
						<tbody>
				</div>
			</div>

			<?php
			$i = 1;
			$status = array("", "Pending", "Received", "Action Made");
			$qry = $conn->query("SELECT * FROM crime order by unix_timestamp(date_created) desc ");
			while ($row = $qry->fetch_array()) :
			?>
				<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
					<td class="text-center"><?php echo $i++ ?></td>
					<td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
					<td><?php echo $row['type_of_crime'] ?></td>
					<td><?php echo $row['crime_street'] ?>, <?php echo $row['crime_barangay'] ?>
						(Landmark: <?php echo $row['crime_landmark'] ?>)</td>
					<td><?php echo $row['involved_person'] ?></td>
					<td><?php echo $row['crime_details'] ?></td>
					<td class='text-center'>
						<?php if ($row['status'] == 1) : ?>
							<span class="badge badge-primary ">Pending</span>
						<?php elseif ($row['status'] == 2) : ?>
							<span class="badge badge-info">Received </span>
						<?php elseif ($row['status'] == 3) : ?>
							<span class="badge badge-success">Action Made </span>
						<?php endif; ?>
					<td class="text-center">
						<button class="btn btn-outline-info btn-sm m-0 view_btn" type="button" data-id="<?php echo $row['id'] ?>">View</button>
					</td>
				</tr>
			<?php endwhile; ?>
			</tbody>
			</table>
		</div>
	</div>
</div>
</div>
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
		uni_modal("View Details", "manage_crime.php?id=" + $(this).attr('data-id'), "mid-large")
	})
</script>