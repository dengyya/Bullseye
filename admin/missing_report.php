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
                                <th class="text-center">#</th>
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
                            $qry = $conn->query("SELECT m.*,rt.name as rname,s.name as sname,u.user_fname as uname,ma.remarks 
                      FROM missing m inner join missing_action ma on ma.complaint_id = m.id inner join responders_team rt
                       on ma.responder_id = rt.id inner join stations s on s.id = rt.station_id inner join users u 
                       on u.id = ma.dispatched_by where m.status = 3 and date_format(m.date_created,'%Y-%m') = '$month' 
                       order by unix_timestamp(m.date_created) desc ");
                            if ($qry->num_rows > 0) :
                                while ($row = $qry->fetch_array()) :
                            ?>
                                    <tr class="">
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td><?php echo date('M d, Y h:i A', strtotime($row['date_created'])) ?></td>
                                        <td>
                                            <p><small>Name: <?php echo $row['missing_fname'] ?></small></p>
                                            <p><small>Age: <?php echo $row['missing_age'] ?></small></p>
                                            <p><small>Gender: <?php echo $row['missing_gender'] ?></small></p>
                                            <p><small>Informer contact Number: <?php echo $row['contact_number'] ?></small></p>
                                            <p><small>Details: <?php echo $row['physical_description'] ?></small></p>

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
            border-collapse: collapse
        }

        table#report-list td,
        table#report-list th {
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
<script>
    $('#month').change(function() {
        location.replace('index.php?page=missing_report&month=' + $(this).val())
    })
    $('#print').click(function() {
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
        ns.append(_c)
        var nw = window.open('', '_blank', 'width=900,height=600')
        nw.document.write('<p class="text-center"><b>Reports as of <?php echo date("F, Y", strtotime($month)) ?></b></p>')
        nw.document.write(ns.html())
        nw.document.close()
        nw.print()
        setTimeout(() => {
            nw.close()
        }, 500);
    })
</script>