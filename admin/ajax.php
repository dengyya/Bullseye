<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login1'){
	$login = $crud->login1();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'deactive_user'){
	$save = $crud->deactive_user();
	if($save)
		echo $save;
}
if($action == 'active_user'){
	$save = $crud->active_user();
	if($save)
		echo $save;
}

if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_page_img"){
	$save = $crud->save_page_img();
	if($save)
		echo $save;
}

if($action == "save_station"){
	$save = $crud->save_station();
	if($save)
		echo $save;
}
if($action == "delete_station"){
	$save = $crud->delete_station();
	if($save)
		echo $save;
}
if($action == "save_responder"){
	$save = $crud->save_responder();
	if($save)
		echo $save;
}
if($action == "delete_responder"){
	$save = $crud->delete_responder();
	if($save)
		echo $save;
}

if($action == "save_student"){
	$save = $crud->save_student();
	if($save)
		echo $save;
}
if($action == "delete_student"){
	$save = $crud->delete_student();
	if($save)
		echo $save;
}
if($action == "save_log"){
	$save = $crud->save_log();
	if($save)
		echo $save;
}
if($action == "blocked"){
	$save = $crud->blocked();
	if($save)
		echo $save;
}

if($action == "manage_complaint"){
	$save = $crud->manage_complaint();
	if($save)
		echo $save;
}
if($action == "complaint"){
	$save = $crud->complaint();
	if($save)
		echo $save;
}
if($action == "delete_complaint"){
	$save = $crud->delete_complaint();
	if($save)
		echo $save;
}
if($action == "cancel_complaint"){
	$save = $crud->cancel_complaint();
	if($save)
		echo $save;
}
if($action == "confirm"){
	$save = $crud->confirm();
	if($save)
		echo $save;
}
if($action == "cancel"){
	$save = $crud->cancel();
	if($save)
		echo $save;
}
if($action == "crime"){
	$save = $crud->crime();
	if($save)
		echo $save;
}
if($action == "delete_crime"){
	$save = $crud->delete_crime();
	if($save)
		echo $save;
}
if($action == "manage_crime"){
	$save = $crud->manage_crime();
	if($save)
	echo $save;
}

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

ob_end_flush();
