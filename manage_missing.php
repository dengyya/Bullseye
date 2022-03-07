<?php include 'admin/assets/script.php'; ?>
<?php
include('db_connect.php');
if (isset($_GET['id'])) {
	$crm = $conn->query("SELECT * FROM missing where id =" . $_GET['id']);
	foreach ($crm->fetch_array() as $k => $val) {
		$$k = $val;
	}
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-missing">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">


		<div class="card-header text-center">
			<h5>INFORMATION ABOUT THE MISSING PERSON</h5>
		</div>

		<div class="row">
			<div class="form-group col-lg-6 mb-2">
				<label for="missing_fname">First name:</label>
				<input type="text" class="form-control" name="missing_fname" id="missing_fname" placeholder="First name" required pattern="^\D*$" title="Number Not Allowed" value="<?php echo isset($missing_fname) ? $missing_fname : '' ?>" required>
			</div>

			<div class="form-group col-lg-6 ">
				<label for="missing_lname">Last name:</label>
				<input type="text" class="form-control" name="missing_lname" id="missing_lname" value="<?php echo isset($missing_lname) ? $missing_lname : '' ?>" placeholder="Last name" required pattern="^\D*$" title="Number Not Allowed" required>
			</div>



			<div class="form-group col-lg-6 ">
				<label for="missing_age">Age:</label>
				<input type="number" class="form-control" name="missing_age" id="missing_age" value="<?php echo isset($missing_age) ? $missing_age : '' ?>" required>
			</div>



			<div class=" col-lg-6 ">
				<div class="form-group  mb-2">
					<label for="">Gender:</label> <br>
					<select name="missing_gender" id="missing_gender" value="<?php echo isset($missing_gender) ? $missing_gender : '' ?>" class="form-control" required>
						<option selected></option>
						<option value="Female" <?php echo isset($missing_gender) && $missing_gender == "Female" ? 'selected' : "" ?>>Female</option>
						<option value="Male" <?php echo isset($missing_gender) && $missing_gender == "Male" ? 'selected' : "" ?>>Male</option>
						<option value="Prefer not to say" <?php echo isset($missing_gender) && $missing_gender == "Prefer not to say" ? 'selected' : "" ?>>Prefer not to say</option>
					</select> </br>
				</div>
			</div>



			<div class="row">
				<div class="form-group col-lg-6 ">
					<label for="date_happened">When the missing person last seen:</label>
					<input type="date" name="date_happened" class="form-control" id="date_happened" value="<?php echo isset($date_happened) ? $date_happened : '' ?>" required>
				</div>

				<div class="form-group col-lg-6 ">
					<label for="missing_address">Where the missing person last seen:</label>
					<input type="text" class="form-control" name="missing_address" id="missing_address" placeholder="Location" value="<?php echo isset($missing_address) ? $missing_address : '' ?>" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-lg-6 ">
				<label for="physical_description" class="control-label">Physical Description</label>
				<textarea name="physical_description" id="physical_description" cols="30" rows="2" class="form-control" required><?php echo isset($physical_description) ? $physical_description : '' ?></textarea>
			</div>

			<div class="form-group col-lg-6 ">
				<label for="missing_cloth" class="control-label">Last cloth worn:</label>
				<textarea name="missing_cloth" id="missing_cloth" cols="30" rows="2" class="form-control" required><?php echo isset($missing_cloth) ? $missing_cloth : '' ?></textarea>
			</div>
		</div>


		<div class="form mb-2 justify-content-center">
			<center>
				<h4><b><label for="">Contact Information of the Informer</label></b> </h4>
			</center>
		</div>

		<div class="row">
			<div class="form-group col-lg-6 ">
				<label for="informer_fname">Informer First name:</label>
				<input type="text" class="form-control" name="informer_fname" id="informer_fname" placeholder="First name" required pattern="^\D*$" title="Number Not Allowed" value="<?php echo isset($informer_fname) ? $informer_fname : '' ?>">
			</div>

			<div class="form-group col-lg-6 ">
				<label for="informer_lname">Informer Last name:</label>
				<input type="text" class="form-control" name="informer_lname" id="informer_lname" placeholder="Last name" required pattern="^\D*$" title="Number Not Allowed" value="<?php echo isset($informer_lname) ? $informer_lname : '' ?>">
			</div>

			<div class="form-group col-lg-6 ">
				<label for="">Informer Contact Number:</label>
				<input type="text" class="form-control" name="contact_number" id="contact_number" minlength="11" maxlength="11" placeholder="09xxxxxxxxx" pattern="^(09|\+639)\d{9}$" title="Contact Number should be on this format: 09xxxxxxxxx" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" value="<?php echo isset($contact_number) ? $contact_number : '' ?>" required>
			</div>
		</div>

		<div class="form-group">
			<label for="" class="control-label">Image</label>
			<input type="file" class="form-control" name="missing_image" id="img" onchange="displayImg(this,$(this))">
		</div>
		<div class="form-group">
			<img src="<?php echo isset($missing_image) ? 'admin/assets/uploads/' . $missing_image : '' ?>" alt="" id="img">
		</div>

		<div class="form-group">

		</div>
		<center>
			<button class="btn btn-info btn-primary btn-block col-md-2">Save</button>
			<button class="button btn btn-secondary btn col-md-2" data-dismiss="modal">Cancel</button>
		</center>
	</form>
</div>

<style>
	#uni_modal .modal-footer {
		display: none;
	}

	img#img {
		max-height: 50vh;
		max-width: 40vw;
	}
</style>
<script>
	var inputEle = document.getElementById('time');


	function onTimeChange() {
		var timeSplit = inputEle.value.split(':'),
			hours,
			minutes,
			meridian;
		hours = timeSplit[0];
		minutes = timeSplit[1];
		if (hours > 12) {
			meridian = 'PM';
			hours -= 12;
		} else if (hours < 12) {
			meridian = 'AM';
			if (hours == 0) {
				hours = 12;
			}
		} else {
			meridian = 'PM';
		}
		alert(hours + ':' + minutes + ' ' + meridian);
	}
</script>
<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#img').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$('#manage-missing').on('reset', function() {
		$('#msg').html('')
		$('input:hidden').val('')
	})
	$('#manage-missing').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'admin/ajax1.php?action=missing',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',

			error: err => {
				console.log(err)
			},

			success: function(resp) {
				if (resp == 1) {
					$('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
					setTimeout(function() {
						location.href = "success.php";
					}, 1500)
				} else {
					$('#msg').html('<div class="alert alert-danger">Username already exist</div>')
					end_load()
				}
			}
		})
	})
</script>