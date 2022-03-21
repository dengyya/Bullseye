<?php include 'db_connect.php' ?>
<?php
$qry = $conn->query("SELECT * FROM complaints where id = {$_GET['id']} ");
foreach ($qry->fetch_array() as $k => $v) {
	$$k = $v;
}
if ($status > 1) {
	$aqry =  $conn->query("SELECT * FROM complaints_action where complaint_id = {$_GET['id']} ");
	foreach ($aqry->fetch_array() as $k => $v) {
		$ca[$k] = $v;
	}
}
?>
<div class="container-fluid">
	<div class="col-lg-12">
		<large><b>Type of Complaint:</b></large>
		<p><?php echo $type ?></p>
		<hr>
		<large><b>Complaint Description:</b></large>
		<p><?php echo $description ?></p>
		<hr>
		<large><b>Incident Address:</b></large>
		<p><?php echo $incident_location ?>,
			<?php echo $incident_street ?>,
			<?php echo $incident_barangay ?>,
			<?php echo $incident_municipality ?>,
			<?php echo $incident_province ?></p>
		<hr>
		<form id="manage-complaints">
			<div id="msg"></div>
			<input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
			<div class="form-group">
				<label for="" class="control-label">Status</label>
				<select name="status" id="status" class="custom-select input-sm">
					<option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Pending</option>
					<option value="2" <?php echo isset($status) && $status == 2 ? 'selected' : '' ?>>Received</option>
					<option value="3" <?php echo isset($status) && $status == 3 ? 'selected' : '' ?>>Action Made</option>
					<option value="4" <?php echo isset($status) && $status == 4 ? 'selected' : '' ?>>Cased Closed</option>
					<option value="5" <?php echo isset($status) && $status == 5 ? 'selected' : '' ?>>Cancelled</option>


				</select>
			</div>
			<div class="assign-responder" style="display:none">
				<div class="form-group">
					<label for="" class="control-label">Dispathced Responder</label>
					<select name="responder_id" id="" class="custom-select input-sm select2">
						<option value=""></option>
						<?php
						$complaints = $conn->query("SELECT rt.*,s.name as sname,s.address FROM responders_team rt 
							inner join stations s on s.id = rt.station_id where rt.availability = 1 " . (isset($ca['responder_id']) ? " 
							or rt.id = {$ca['responder_id']}" : '') . " order by rt.name asc ");
						while ($row = $complaints->fetch_assoc()) :
						?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($ca['responder_id']) && $ca['responder_id'] == 1 ?
															'selected' : '' ?>><?php echo $row['sname'] . ' - ' . $row['name'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<div class="action_made" style="display:none">
				<div class="form-group">
					<label for="" class="control-label">Remarks</label>
					<textarea name="remarks" id="remarks" cols="30" rows="4" class="form-control">
						<?php echo isset($ca['remarks']) ? $ca['remarks'] : '' ?></textarea>
				</div>
			</div>

			<div class="closed" style="display:none">
				<div class="form-group">
					<label for="" class="control-label">Reason Cased Closed</label>
					<textarea name="case_closed" id="case_closed" cols="30" rows="4" class="form-control">
						<?php echo isset($ca['case_closed']) ? $ca['case_closed'] : '' ?></textarea>
				</div>
			</div>

			<div class="cancel" style="display:none">
				<div class="form-group">
					<label for="" class="control-label">Reasons for Cancellation of Report</label>
					<textarea name="cancellation_reason" id="cancellation_reason" cols="30" rows="4" class="form-control">
						<?php echo isset($ca['cancellation_reason']) ? $ca['cancellation_reason'] : '' ?></textarea>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$('#manage-complaint').on('reset', function() {
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('.select2').select2({
		placeholder: 'Please select here',
		width: '100%'
	})
	$('#status').change(function() {
		if ($(this).val() == 2) {
			$('.assign-responder').show()
			$('.action_made').hide()
			$('.closed').hide()
			$('.cancel').hide()

		} else if ($(this).val() == 3) {
			$('.assign-responder').hide()
			$('.action_made').show()
			$('.closed').hide()
			$('.cancel').hide()

		} else if ($(this).val() == 4) {
			$('.assign-responder').hide()
			$('.action_made').show()
			$('.closed').show()
			$('.cancel').hide()

		} else if ($(this).val() == 5) {
			$('.assign-responder').hide()
			$('.action_made').show()
			$('.closed').hide()
			$('.cancel').show()

		} else {
			$('.assign-responder').hide()
			$('.action_made').hide()
			$('.closed').hide()
			$('.cancel').hide()
		}
	})
	$(document).ready(function() {
		if ('<?php echo $status ?>' > 1) {
			$('#status').trigger('change')
		}
	})
	$('#manage-complaints').submit(function(e) {
		e.preventDefault()
		start_load()
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'ajax.php?action=manage_complaint',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#complaint-frm button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success: function(resp) {
				if (resp == 1) {
					location.reload();
					$('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
					setTimeout(function() {
						location.reload()
					}, 1000)
				} else if (resp == 2) {
					$('#msg').html('<div class="alert alert-danger">Complaint is not received yet.</div>')
					end_load()
				}
			}
		})
	})
</script>