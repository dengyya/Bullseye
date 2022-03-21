<?php include('db_connect.php'); ?>
<style>
	input[type=checkbox] {
		/* Double-sized Checkboxes */
		-ms-transform: scale(1.3);
		/* IE */
		-moz-transform: scale(1.3);
		/* FF */
		-webkit-transform: scale(1.3);
		/* Safari and Chrome */
		-o-transform: scale(1.3);
		/* Opera */
		transform: scale(1.3);
		padding: 10px;
		cursor: pointer;
	}
</style>
<div class="container-fluid">


</div>
<div class="row">
	<!-- FORM Panel -->

	<div class="content-wrapper">
		<div class="row">
			<div class="col-lg-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<b>List of Complainant</b>
					</div>

					<div class="card-body">
						<table class="table table-condensed table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="">Name</th>
									<th class="">Information</th>
									<th class="">User Reliabilty</th>
									<th class="">User Status</th>
									<th class="">Blocked User</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								$complainant = $conn->query("SELECT * FROM complainants  order by fname asc ");
								while ($row = $complainant->fetch_assoc()) :
								?>
									<tr>
										<td class="text-center"><?php echo $i++ ?></td>
										<td>
											<p> <b><?php echo ucwords($row['fname']) ?> <?php echo ucwords($row['lname']) ?></b></p>
										</td>
										<td class="">
											<p>Email: <b><?php echo $row['email'] ?></b></p>
											<p>Contact #: <b><?php echo $row['contact'] ?></b></p>
											<p>Gender: <b><?php echo $row['gender'] ?></b></p>
											<p>Age: <b><?php echo $row['age'] ?></b></p>
											<p>Address: </b>
												<small><i><b><?php echo $row['street'] ?>, <?php echo $row['barangay'] ?>, <?php echo $row['municipality'] ?>, <?php echo $row['province'] ?>
										</td>
										</i></small></p>
										</td>
										<td class='text-center'>

											<?php if ($row['status'] == 1) : ?>
												<span class="badge badge-primary">Verified</span>
											<?php else : ?>
												<span class="badge badge-secondary">Unverified</span>
											<?php endif; ?>

										</td>
										</td>
										<td class='text-center'>

											<?php if ($row['complainant_status'] == 1) : ?>
												<span class="badge badge-success">Active</span>
											<?php else : ?>
												<span class="badge badge-danger">Blocked</span>
											<?php endif; ?>

										</td>
										<td class="text-center">
											<?php if ($row['complainant_status'] == 1) : ?>
												<button class="btn btn-sm btn-outline-dark blocked_user" type="button" data-id="<?php echo $row['id'] ?>">Blocked</button>
											<?php else : ?>
												<button class="btn btn-sm btn-outline-dark unblocked_user" type="button" data-id="<?php echo $row['id'] ?>">Unblocked</button>
											<?php endif; ?>
										</td>
										<td class="text-center">

											<button class="btn btn-sm btn-outline-primary view_complaints" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>">View Complaints</button><br><br>
											<button class="btn btn-sm btn-outline-primary view_crime" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>">View Crime </button> <br><br>
											<button class="btn btn-sm btn-outline-primary view_missing" type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['fname'] ?> <?php echo $row['lname'] ?>">View Missing </button> <br><br>

										</td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>

</div>
<style>
	td {
		vertical-align: middle !important;
	}

	td p {
		margin: unset
	}

	img {
		max-width: 100px;
		max-height: 150px;
	}
</style>
<script>
	$(document).ready(function() {
		$('table').dataTable()
	})
	$('.edit_complainant').click(function() {
		uni_modal("Manage complainant Details", "manage_complainant.php?id=" + $(this).attr('data-id'), "mid-large")

	})
	$('.view_complaints').click(function() {
		uni_modal("<i class='fa fa-user-secret'></i> " + $(this).attr('data-name') + " Complaints", "view_complainant_complaints.php?id=" + $(this).attr('data-id'), "large")

	})
	$('.view_crime').click(function() {
		uni_modal("<i class='fa fa-user-secret'></i> " + $(this).attr('data-name') + " Crime Reports", "view_complainant_crime.php?id=" + $(this).attr('data-id'), "large")

	})
	$('.view_missing').click(function() {
		uni_modal("<i class='fa fa-user-secret'></i> " + $(this).attr('data-name') + " Crime Reports", "view_complainant_missing.php?id=" + $(this).attr('data-id'), "large")

	})

	$('.blocked_user').click(function() {
		_conf("Are you sure to blocked this complainant?", "blocked", [$(this).attr('data-id'), 2])
	})

	$('.unblocked_user').click(function() {
		_conf("Are you sure to unblocked this complainant", "blocked", [$(this).attr('data-id'), 1])
	})


	function blocked($id, $complainant_status) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=blocked',
			method: 'POST',
			data: {
				id: $id,
				complainant_status: $complainant_status
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