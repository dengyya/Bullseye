<?php include 'db_connect.php' ?>
<?php
$qry = $conn->query("SELECT * FROM complaints where id = {$_GET['id']} ");
foreach ($qry->fetch_array() as $k => $v) {
	$$k = $v;
}

?>

<div class="container-fluid">
	<form action="" id="manage-cancel">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

		<div class="form-group col-lg-12 mb-2">
			<div class="form-group">
				<b>
					<h6> Cancellation Request </h6>
				</b>
				<label for="" class="control-label">Detailed explantion of cancellation:</label>
				<textarea name="cancel_reason" id="cancel_reason" cols="30" rows="2" class="form-control mb-2" required><?php echo isset($cancel_reason) ? $cancel_reason : '' ?></textarea>
				<p><b>Please be advised that once you cancel your report you are oblige to attend the scheduled settlement to formally close your case. Rest assured that we will inform the offender that you want to cancel your complaint. Thank you! </p>

			</div>
		</div>


		<button class="button btn btn-primary btn-sm">Create</button>
		<button class="button btn btn-secondary btn-sm" type="button" data-dismiss="modal">Cancel</button>

	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}

	img#image {
		max-height: 50vh;
		max-width: 30vw;
	}
</style>
<script>
	$('#manage-cancel').submit(function(e) {
		e.preventDefault()
		start_load()
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=cancel_complaint',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#manage-cancel button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success: function(resp) {
				if (resp == 1) {
					$('.cancel_complaint').attr('disabled', true);

					$('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
					setTimeout(function() {
						location.href = "cancelled_reports.php";
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})
</script>