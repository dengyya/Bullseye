<?php
ob_start();
$action = $_GET['action'];
include 'admin.php';
$crud = new Action();


if($action == "missing"){
	$save = $crud->missing();
	if($save)
		echo $save;
}
if($action == "delete_missing"){
	$save = $crud->delete_missing();
	if($save)
		echo $save;
}
if($action == "manage_missing"){
	$save = $crud->manage_missing();
	if($save)
	echo $save;
}
if($action == "signature"){
	$save = $crud->signature();
	if($save)
		echo $save;
}

ob_end_flush();
