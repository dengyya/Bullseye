<?php
include 'db_connect.php';
?>
<div class="container">
	<div class="row">
		<div class="col-lg-12 grid-margin stretch-card">
			<div class="">
				<div class="">
					<b>List of Canceled Complaints</b>

					<table data-bs-toggle="table" class="table-bordered table-hover" id="complaint-tbl">

						<thead>
							<tr>
								<th width="5%">#</th>
								<th width="10%" class="text-center">Date</th>
								<th width="10%" class="text-center"> Case No</th>
								<th width="20%" class="text-center">Complainant ID </th>
								<th width="20%" class="text-center">Reasons for Cancellation</th>
								<th width="10%" class="text-center">Cancellation Status</th>
								<th width="10%" class="text-center">Action</th>

							</tr>
						</thead>
						<tbody>
				</div>
				<?php

				$i = 1;
				$qry = $conn->query("SELECT * FROM cancel_reports order by unix_timestamp(date_created) desc ");
				while ($row = $qry->fetch_array()) :
				?>
					<td class="text-center"><?php echo $i++ ?></td>

					<td><?php echo date('M d, Y  h:i A', strtotime($row['date_created'])) ?></td>

					<td class="text-center">CN0<?php echo $row['complaint_id'] ?></td>

					<td class="text-center">
						<p><?php echo $row['complainant_id'] ?> </p>
					</td>

					<td>
						<p><?php echo $row['cancel_reason'] ?> </p>
					</td>

					<td class='text-center'>

						<?php if ($row['cancel_status'] == 1) : ?>
							<span class="badge badge-success mb-2">Confirmed</span>
						<?php else : ?>
							<span class="badge badge-info">Pending</span>
						<?php endif; ?>

					</td>


					<td class='text-center'>
						<?php if ($row['cancel_status'] == 0) : ?>
							<button class="btn btn-sm btn-outline-success confirm" type="button" data-id="<?php echo $row['id'] ?>">Confirmed</button>
						<?php else : ?>
							<button class="btn btn-sm btn-outline-info pending" type="button" data-id="<?php echo $row['id'] ?>">Pending</button>
						<?php endif; ?>

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
		uni_modal("View Details", "manage_cancel.php?id=" + $(this).attr('data-id'), "mid-large")
	})

	$('.confirm').click(function() {
		_conf("Are you sure to confirm this cancellation?", "confirm", [$(this).attr('data-id'), 1])
	})

	$('.pending').click(function() {
		_conf("Are you sure to pending this cancellation?", "confirm", [$(this).attr('data-id'), 0])
	})



	function confirm($id, $cancel_status) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=confirm',
			method: 'POST',
			data: {
				id: $id,
				cancel_status: $cancel_status
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Data successfully updated.", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}
</script>