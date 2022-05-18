<?php
$db = new mysqli('localhost', 'root', '', 'crms_db');
if ($_GET['user_id'] != "" && $_GET['key'] != "") :
  $user_id = mysqli_real_escape_string($db, $_GET['user_id']);
  $active_code = mysqli_real_escape_string($db, $_GET['key']);
  $fetch = $db->query("SELECT * FROM `users` WHERE id='$user_id'
        AND `active_code` = '$active_code'");
  $count = mysqli_num_rows($fetch);
  if ($count != 1) :
    header("Location:change_password.php");
  endif;
else :
  header("Location:change_password.php");
endif;
?>

<?php

include('db_connect.php');
if (isset($_GET['id'])) {
  $crm = $conn->query("SELECT * FROM complaints where id =" . $_GET['id']);
  foreach ($crm->fetch_array() as $k => $val) {
    $$k = $val;
  }
}


$folderPath = "img/upload/";

$image_parts = explode(";base64,", $_POST['signed']);

$image_type_aux = explode("image/", $image_parts[0]);

$image_type = $image_type_aux[1];

$image_base64 = base64_decode($image_parts[1]);

$file = $folderPath . uniqid() . '.' . $image_type;

$sql = "INSERT INTO complaints_signature(signed, complainant_id) VALUES('$file', '$complainant_id')";

mysqli_query($conn, $sql);

file_put_contents($file, $image_base64);

echo "Signature Uploaded Successfully.";
header('location: success.php');

?>