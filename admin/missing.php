<?php
include 'db_connect.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="">
				<div class="">
					<b>List of Reports of Missing</b>

					<div class="card-body">
						<table data-bs-toggle="table" class=" table-bordered table-hover" id="complaint-tbl">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Missing Case No</th>
									<th width="20%">Image</th>
									<th width="20%">Missing Person</th>
									<th width="10%">Informer Information</th>
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
				$qry = $conn->query("SELECT * FROM missing order by unix_timestamp(date_created) desc ");
				while ($row = $qry->fetch_array()) :
				?>
					<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
						<td class="text-center"><?php echo $i++ ?></td>

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
							<?php echo $row['informer_fname'] ?> <?php echo $row['informer_lname'] ?>
							<?php echo $row['contact_number'] ?>
						</td>

						<td>
							Last seen: <?php echo $row['missing_address'] ?><br>
							<?php echo $row['physical_description'] ?>,<br>
							<?php echo $row['missing_cloth'] ?>
						</td>

						<td class='text-center'>
							<?php if ($row['status'] == 1) : ?>
								<span class="badge badge-primary ">Pending</span>
							<?php elseif ($row['status'] == 2) : ?>
								<span class="badge badge-info">Received </span>
							<?php elseif ($row['status'] == 3) : ?>
								<span class="badge badge-success">Action Made </span>
							<?php endif; ?>

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
		uni_modal("View Details", "manage_missing.php?id=" + $(this).attr('data-id'), "mid-large")
	})
</script>