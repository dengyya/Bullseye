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
								<!-- <th width="10%">Date</th>
						<th width="10%">Person Involved</th>
						<th width="10%">Address</th>
						<th width="10%">Contact Number</th>
						<th width="10%">Type of Complaint</th>
						<th width="10%">Location</th>
						<th width="20%">Description</th> -->
								<th>Date</th>
								<th>Person Involved</th>
								<th>Address</th>
								<th>Contact Number</th>
								<th>Type of Complaint</th>
								<th>Location</th>
								<th>Description</th>


							</tr>
						</thead>
						<tbody>
				</div>
				<?php
				$status = array("", "Pending", "Received", "Action Made", "Cased Closed", "Cancelled");
				$qry = $conn->query("SELECT * FROM complaints where status = 2 order by unix_timestamp(date_created) desc ");
				while ($row = $qry->fetch_array()) :
				?>
					<td><?php echo date('M d, Y ', strtotime($row['date_created'])) ?></td>
					<td><?php echo $row['respondent_fname'] ?> <?php echo $row['respondent_lname'] ?></td>
					<td><?php echo $row['complaints_address'] ?>, <?php echo $row['complaints_street'] ?>, <br>
						<?php echo $row['complaints_barangay'] ?>, <?php echo $row['complaints_municipality'] ?>, <br>
						<?php echo $row['complaints_province'] ?></td>
					<td><?php echo $row['contact_num'] ?></td>
					<td><?php echo $row['type'] ?></td>
					<td><?php echo $row['incident_location'] ?>, <?php echo $row['incident_street'] ?>, <br>
						<?php echo $row['incident_barangay'] ?>, <?php echo $row['incident_municipality'] ?>, <br>
						<?php echo $row['incident_province'] ?></td>
					<td><?php echo $row['description'] ?></td>

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
		nw.document.write('<p class="text-center"><b>Received Reports </b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})

	$('#complaint-tbl').dataTable();
</script>