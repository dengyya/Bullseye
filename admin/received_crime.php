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
								<th width="10%">No</th>
								<th width="10%">Date</th>
								<th width="10%">Case N0</th>
								<th width="10%">Type of Crime</th>
								<th width="20%">Location</th>
								<th width="20%">Person Involved</th>
								<th width="20%">Details</th>


							</tr>
						</thead>
						<tbody>
				</div>
				<?php
				$i = 1;
				$status = array("", "Pending", "Received", "Action Made");
				$qry = $conn->query("SELECT * FROM crime where status = 2 order by unix_timestamp(date_created) desc ");
				while ($row = $qry->fetch_array()) :
				?>
					<td class="text-center"><?php echo $i++ ?></td>
					<td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
					<td class="text-center">CR<?php echo $row['id'] ?></td>
					<td><?php echo $row['type_of_crime'] ?></td>
					<td><?php echo $row['crime_street'] ?>, <?php echo $row['crime_barangay'] ?><br>
						(Landmark: <?php echo $row['crime_landmark'] ?>)</td>
					<td><?php echo $row['involved_person'] ?></td>
					<td><?php echo $row['crime_details'] ?></td>


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
		nw.document.write('<p class="text-center"><b>Received Crime Reports </b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})

	$('#complaint-tbl').dataTable();
</script>