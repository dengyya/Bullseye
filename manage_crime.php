<?php
include('db_connect.php');
if (isset($_GET['id'])) {
	$crm = $conn->query("SELECT * FROM crime where id =" . $_GET['id']);
	foreach ($crm->fetch_array() as $k => $val) {
		$$k = $val;
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-crime">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

		<div class="form-group col-lg-12 mb-2">
			<label for="type_of_crime">Type of Crime</label>
			<input type="text" name="type_of_crime" list="type_of_crime" placeholder="Please specify">
			<datalist id="type_of_crime">
				<option value="Theft" <?php echo isset($type_of_crime) && $type_of_crime == "Theft" ? 'selected' : "" ?>>Larceny Theft (Pagnanakaw without using force)</option>
				<option value="Robbery " <?php echo isset($type_of_crime) && $type_of_crime == "Robbery" ? 'selected' : "" ?>>Robbery (Pagnanakaw with use of force)</option>
				<option value="Physical Injury" <?php echo isset($type_of_crime) && $type_of_crime == "Physical Injury" ? 'selected' : "" ?>>Physical Injury</option>
				<option value="Motorcycle Theft" <?php echo isset($type_of_crime) && $type_of_crime == "Motorcycle Theft" ? 'selected' : "" ?>>Motorcycle Theft</option>
				<option value="Carnapping " <?php echo isset($type_of_crime) && $type_of_crime == "Carnapping" ? 'selected' : "" ?>>Carnapping</option>
				<option value="Rape" <?php echo isset($type_of_crime) && $type_of_crime == "Rape" ? 'selected' : "" ?>>Rape</option>
				<option value="Homicide " <?php echo isset($type_of_crime) && $type_of_crime == "Homicide" ? 'selected' : "" ?>>Homicide</option>


			</datalist>

		</div>
		<div class="form-group col-lg-12 mb-2">
			<label for="crime_street">Street</label>
			<select class="custom-select" name="crime_street" id="crime_street" value="<?php echo isset($crime_street) ? $crime_street : '' ?>" required>
				<option selected></option>

				<option value="Alonzo" <?php echo isset($crime_street) && $crime_street == "Alonzo" ? 'selected' : "" ?>>Alonzo</option>
				<option value="Luwasan" <?php echo isset($crime_street) && $crime_street == "Luwasan" ? 'selected' : "" ?>>Luwasan</option>
				<option value="Tabing Ilog" <?php echo isset($crime_street) && $crime_street == "Tabing Ilog" ? 'selected' : "" ?>>Tabing Ilog</option>
				<option value="Caybutok" <?php echo isset($crime_street) && $crime_street == "Caybutok" ? 'selected' : "" ?>>Caybutok</option>
				<option value="Castillo" <?php echo isset($crime_street) && $crime_street == "Castillo" ? 'selected' : "" ?>>Castillo</option>
				<option value="Baustita" <?php echo isset($crime_street) && $crime_street == "Baustita" ? 'selected' : "" ?>>Baustita</option>
				<option value="Caingin" <?php echo isset($crime_street) && $crime_street == "Caingin" ? 'selected' : "" ?>>Caingin</option>
				<option value="Manggahan" <?php echo isset($crime_street) && $crime_street == "Manggahan" ? 'selected' : "" ?>>Manggahan</option>
				<option value="Hulo" <?php echo isset($crime_street) && $crime_street == "Hulo" ? 'selected' : "" ?>>Hulo</option>
				<option value="Galas 1" <?php echo isset($crime_street) && $crime_street == "Galas 1" ? 'selected' : "" ?>>Galas 1</option>
				<option value="Galas 2" <?php echo isset($crime_street) && $crime_street == "Galas 2" ? 'selected' : "" ?>>Galas 2</option>
				<option value="Pari 1" <?php echo isset($crime_street) && $crime_street == "Pari 1" ? 'selected' : "" ?>>Pari 1</option>
				<option value="Pari 2" <?php echo isset($crime_street) && $crime_street == "Pari 2" ? 'selected' : "" ?>>Pari 2</option>
				<option value="Bagong Barrio" <?php echo isset($crime_street) && $crime_street == "Bagong Barrio" ? 'selected' : "" ?>>Bagong Barrio</option>
				<option value="Nigro" <?php echo isset($crime_street) && $crime_street == "Nigro" ? 'selected' : "" ?>>Nigro</option>
				<option value="Kubo" <?php echo isset($crime_street) && $crime_street == "Kubo" ? 'selected' : "" ?>>Kubo</option>
				<option value="Paying" <?php echo isset($crime_street) && $crime_street == "Paying" ? 'selected' : "" ?>>Paying</option>
				<option value="Ventura" <?php echo isset($crime_street) && $crime_street == "Ventura" ? 'selected' : "" ?>>Ventura</option>
				<option value="Guam" <?php echo isset($crime_street) && $crime_street == "Guam" ? 'selected' : "" ?>>Guam</option>
				<option value="Ewong" <?php echo isset($crime_street) && $crime_street == "Ewong" ? 'selected' : "" ?>>Ewong</option>
			</select>
		</div>

		<div class="form-group col-lg-12 mb-2">
			<label for="barangay">Barangay</label>
			<select class="custom-select" name="crime_barangay" id="barangay">
				<option value="Balasing">Balasing</option>
			</select>

			<div class="form-group">
				<label for="landmark" class="control-label">Landmark</label>
				<textarea name="crime_landmark" id="" cols="20" rows="4" class="form-control" required><?php echo isset($crime_landmark) ? $crime_landmark : '' ?></textarea>
			</div>

			<div class="form-group">
				<label for="involved_person" class="control-label">Person Involved(Please describe if not known)</label>
				<textarea name="involved_person" id="" cols="30" rows="4" class="form-control" required><?php echo isset($involved_person) ? $involved_person : '' ?></textarea>
			</div>
			<div class="form-group">
				<label for="crime_details">Description of the Crime Report (What happened, how it happened, factors leading to the event). Be specific as possible</label>
				<textarea name="crime_details" id="crime_details" cols="30" rows="4" class="form-control" required=""><?php echo isset($crime_details) ? $crime_details : '' ?></textarea>
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
	$('#manage-crime').submit(function(e) {
		e.preventDefault()
		start_load()
		if ($(this).find('.alert-danger').length > 0)
			$(this).find('.alert-danger').remove();
		$.ajax({
			url: 'admin/ajax.php?action=crime',
			method: 'POST',
			data: $(this).serialize(),
			error: err => {
				console.log(err)
				$('#manage-crime button[type="submit"]').removeAttr('disabled').html('Create');

			},
			success: function(resp) {
				if (resp == 1) {
					$('#msg').html('<div class="alert alert-success">Data successfully saved! </div>')
					setTimeout(function() {
						location.href = "success.php";
					}, 1500)
				} else {
					end_load()
				}
			}
		})
	})
</script>