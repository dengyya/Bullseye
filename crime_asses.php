<?php require_once "controllerUserData.php"; ?>
<?php
include('db_connect.php');
if (isset($_GET['id'])) {
    $crm = $conn->query("SELECT * FROM complaints where id =" . $_GET['id']);
    foreach ($crm->fetch_array() as $k => $val) {
        $$k = $val;
    }
}
?>
<!DOCTYPE html>
<html>

<head>


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <script type="text/javascript" src="js/jquery.signature.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/jquery.signature.css">



    <style>
        .kbw-signature {
            width: 500px;
            height: 250px;
        }

        #sig canvas {

            width: 100% !important;

            height: auto;

        }
    </style>


</head>

<body>

    <div class="container justify-content-center align-items-center">
        <div id="content" class="flex">
            <div class="">
                <div class="page-content page-container" id="page-content ">
                    <div class="padding mt-5">
                        <div class="row ">
                            <div class="col align-self-center">
                                <img class="rounded" src="img/thanks.png" style="width:200px" alt="Card image cap">

                            </div>
                            <div class="col-md-9 justify-content-md-center"><strong>Thank you for trusting us, please be patient on the process of your report. <br> By agreeing to this please sign here: </strong>
                                <div class="col-md-9 justify-content-md-center">
                                    <form method="POST" action="upload.php">

                                        <input type="hidden" name="id" value="<?php echo $complainant_id; ?>" id="id">

                                        <div class="col-md-12 justify-content-md-center">



                                            <br />

                                            <div id="sig" class="border border-danger rounded"></div>

                                            <br />


                                            <textarea id="signature64" name="signed" style="display: none"></textarea>


                                        </div>
                                        <div class="row pl-5 ">
                                            <div class="col-md-5 mt-4 ">
                                                <button id="clear" class="btn btn-secondary btn-block">Clear Signature</button>
                                            </div>
                                            <div class="col-md-5 mt-4">
                                                <button class="btn btn-dark btn-block">Submit</button>
                                            </div>


                                        </div>








                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class=" align-self-center">



                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    </div>





    <script type="text/javascript">
        var sig = $('#sig').signature({
            syncField: '#signature64',
            syncFormat: 'PNG'
        });

        $('#clear').click(function(e) {

            e.preventDefault();

            sig.signature('clear');

            $("#signature64").val('');

        });
    </script>