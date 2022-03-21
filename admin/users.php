<?php
include('db_connect.php')
?>

<div class="container-fluid">

	<div class="row">
		<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
		</div>
	</div>
	<br>
	<div class="col-lg-12">
		<div class=" ">
			<div class="mb-4"><b>User List</b></div>
			<div class="">
				<table class="table-striped table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Username</th>
							<th class="text-center">Type</th>
							<th class="text-center">User Status</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$type = array("", "Admin", "Staff");
						$users = $conn->query("SELECT * FROM users order by user_fname asc");
						$i = 1;
						while ($row = $users->fetch_assoc()) :
						?>
							<tr>
								<td class="text-center">
									<?php echo $i++ ?>
								</td>
								<td>
									<?php echo ucwords($row['user_fname']) ?>
									<?php echo  ucwords($row['user_lname']) ?>
								</td>

								<td>
									<?php echo  ucwords($row['username']) ?>

								</td>
								<td>
									<?php echo $type[$row['type']] ?>
								</td>
								<td class='text-center'>

									<?php if ($row['user_status'] == 1) : ?>
										<span class="badge badge-success mb-2">Active</span>
									<?php else : ?>
										<span class="badge badge-danger">Deactivate</span>
									<?php endif; ?>

								</td>

								<td class="text-center">
									<?php if ($row['user_status'] == 1) : ?>
										<button class="btn btn-sm btn-outline-danger deactive_user" type="button" data-id="<?php echo $row['id'] ?>">Deactivate</button>
									<?php else : ?>
										<button class="btn btn-sm btn-outline-success active_user" type="button" data-id="<?php echo $row['id'] ?>">Active</button>
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
<script>
	$(document).ready(function() {

		$('table').dataTable()
	})

	$('#manage-user').on('reset', function() {
		$('#msg').html('')
		$('input:hidden').val('')
	})

	$('#new_user').click(function() {
		uni_modal('New User', 'manage_user.php', "mid-large")
	})

	$('.deactive_user').click(function() {
		_conf("Are you sure to deactive this user?", "deactive_user", [$(this).attr('data-id'), 2])
	})

	function deactive_user($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=deactive_user',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					$('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
					setTimeout(function() {
						location.reload()
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Cannot Disable this user.</div>')
					end_load()
				}

			}
		})
	}

	$('.active_user').click(function() {
		_conf("Are you sure to active this user?", "active_user", [$(this).attr('data-id'), 1])
	})

	function active_user($id, $user_status) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=active_user',
			method: 'POST',
			data: {
				id: $id,
				user_status: $user_status
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

	function deactive_user($id, $user_status) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=deactive_user',
			method: 'POST',
			data: {
				id: $id,
				user_status: $user_status
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