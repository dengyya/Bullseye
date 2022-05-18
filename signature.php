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
            width: 400px;
            height: 200px;
        }

        #sig canvas {

            width: 100% !important;

            height: auto;

        }
    </style>


</head>

<body>
    <div class="container-wrapper">
        <div class="container">
            <div id="content" class="flex">
                <div class="">
                    <div class="page-content page-container" id="page-content ">
                        <div class="padding">
                            <div class="row ">
                                <div class="col-md-8 offset-md-2 form">
                                    <div class="">
                                        <div class="card-header mb-2"><strong>Thank you for trusting us. Please be patient on the process of your report. </strong>

                                        </div>
                                        <div class="card-body">
                                            <p>By agreeing to this please sign this: </p>
                                            </head>

                                            <div class="container">



                                                <form action="" id="manage-signature">
                                                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

                                                    <div class="col-md-12">

                                                        <label class="" for="">Signature:</label>

                                                        <br />

                                                        <div id="sig"></div>

                                                        <br />

                                                        <button id="clear">Clear Signature</button>

                                                        <textarea id="signature64" name="signed" style="display: none"></textarea>

                                                    </div>

                                                    <br />

                                                    <button class="btn btn-success">Submit</button>

                                                </form>



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


                                                $('#manage-signature').on('reset', function() {
                                                    $('#msg').html('')
                                                    $('input:hidden').val('')
                                                })

                                                $('#manage-signature').submit(function(e) {
                                                    e.preventDefault()
                                                    start_load()
                                                    $.ajax({
                                                        url: 'admin/ajax1.php?action=signature',
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