<?php
include 'db_connect.php';
?>
<div class="container">
	<div class="row">
		<div class="col-12 ">
			<div class="">
				<div class="">
					<b>List of Report of Complaints</b>
					<br><br>

					<table class=" table table-bordered " id='complaint-tbl'>
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th width="10%">Date</th>
								<th class="text-center">Missing Case No</th>
								<th width="20%">Image</th>
								<th width="20%">Missing Person</th>
								<th width="10%">Informer Information</th>
								<th width="20%">Details</th>

							</tr>
						</thead>
						<tbody>
				</div>
				<?php
				$i = 1;
				$status = array("", "Pending", "Received", "Action Made");
				$qry = $conn->query("SELECT * FROM missing where status=2 order by unix_timestamp(date_created) desc ");
				while ($row = $qry->fetch_array()) :
				?>
					<tr class="<?php echo $row['status'] == 1 ? 'border-alert' : '' ?>">
						<td class="text-center"><?php echo $i++ ?></td>
						<td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>

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
							<?php echo $row['informer_fname'] ?> <?php echo $row['informer_lname'] ?><br>
							<?php echo $row['contact_number'] ?>
						</td>

						<td>
							Last seen: <?php echo $row['missing_address'] ?><br>
							<?php echo $row['physical_description'] ?>,<br>
							<?php echo $row['missing_cloth'] ?>
						</td>


					</tr>

				<?php endwhile; ?>
				</tbody>
				</table>
			</div>
			<div class="col-md-12 mb-4">

			</div>
		</div>
		<center>
			<button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
		</center>
		<!-- <button onclick="generatePdf()">print</button> -->
	</div>
</div>
</div>
</div>


<noscript>
	<style>
		table#complaint-tbl {
			width: 100%;
			border-collapse: collapse
		}

		table#complaint-tbl td,
		table#complaint-tbl th {
			border: 1px solid
		}

		p {
			margin: unset;
		}

		.text-center {
			text-align: center
		}
	</style>
</noscript>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="toGeneratePdf.js"></script>
<script>
	$('#print').click(function() {
		var _c = $('#complaint-tbl').clone();
		var ns = $('noscript').clone();
		ns.append(_c)
		var nw = window.open('', '_blank', 'width=900,height=600')
		nw.document.write('<p class="text-center"><b>Received Missing Reports </b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})

	$('#complaint-tbl').dataTable();
</script>