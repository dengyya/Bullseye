<?php
include 'db_connect.php';
$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
?>
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="">
            <div class="">
                <div class="row justify-content-center pt-4">
                    <label for="" class="mt-2">Month</label>
                    <div class="col-sm-3">
                        <input type="month" name="month" id="month" value="<?php echo $month ?>" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <table class="table table-bordered" id='report-list'>
                        <thead>
                            <tr>
                                <th width="10%" class="text-center">#</th>
                                <th class="text-center">Date/Time</th>
                                <th class="text-center">Information</th>
                                <th class="text-center">Team Responded</th>
                                <th class="text-center">Dispatched By</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $conn->query("SELECT c.*,rt.name as rname,s.name as sname,u.user_fname as uname,ca.remarks FROM crime c inner join crime_action ca on ca.complaint_id = c.id inner join responders_team rt on ca.responder_id = rt.id inner join stations s on s.id = rt.station_id inner join users u on u.id = ca.dispatched_by where c.status = 3 and date_format(c.date_created,'%Y-%m') = '$month' order by unix_timestamp(c.date_created) desc ");
                            if ($qry->num_rows > 0) :
                                while ($row = $qry->fetch_array()) :
                            ?>
                                    <tr class="">
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
                                        <td>
                                            <p><small>Type of Crime: <?php echo $row['type_of_crime'] ?></small></p>
                                            <p><small>Location: <?php echo $row['crime_street'] ?>, <?php echo $row['crime_barangay'] ?> (Landmark: <?php echo $row['crime_landmark'] ?>)</small></p>
                                            <p><small>Type of Crime: <?php echo $row['type_of_crime'] ?></small></p>
                                            <p><small>Person Involved: <?php echo $row['involved_person'] ?></small></p>
                                        </td>
                                        <td><?php echo $row['sname'] . ' - ' . $row['rname'] ?></td>
                                        <td><?php echo ucwords($row['uname']) ?></td>
                                        <td><?php echo ucwords($row['remarks']) ?></td>
                                    </tr>
                                <?php
                                endwhile;
                            else :
                                ?>
                                <tr>
                                    <th class="text-center" colspan="6">No Data.</th>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </tbody>
                    </table>
                    <hr>
                    <div class="col-md-12 mb-4">
                        <center>
                            <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<noscript>
    <style>
        table#report-list {
            width: 100%;
            border-collapse: collapse;
        }

        table#report-list td,
        table#report-list th {
            border: 1px solid;
        }

        p {
            margin: unset;
            padding: inherit;
        }

        .text-center {
            text-align: center;
        }
    </style>
</noscript>
<script>
    $('#month').change(function() {
        location.replace('index.php?page=crime_report&month=' + $(this).val())
    })
    $('#print').click(function() {
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
        ns.append(_c)
        var nw = window.open('', '_blank', 'width=900,height=600')
        nw.document.write('<p class="text-center"><b>Crime Reports as of <?php echo date("F, Y", strtotime($month)) ?></b></p>')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(() => {
            nw.close()
        }, 500);
    })
</script>