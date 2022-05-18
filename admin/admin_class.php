<?php
session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}

	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login1()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' and user_status = 1 ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {

			$chks = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . md5($password) . "' and user_status = 2 ");
			if ($chks->num_rows > 0) {
				return 3;
			} else {
				return 2;
			}
		}
	}
	function login2()
	{

		extract($_POST);
		$qry = $this->db->query("SELECT * FROM complainants where email = '" . $email . "' and password = '" . md5($password) . "' and complainant_status = 1 ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {

			$chks = $this->db->query("SELECT * FROM complainants where email = '" . $email . "' and password = '" . md5($password) . "' and complainant_status = 2 ");
			if ($chks->num_rows > 0) {
				return 3;
			} else {
				return 2;
			}
		}
	}

	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user()
	{
		extract($_POST);
		$data = " user_fname = '$user_fname' ";
		$data .= ", user_lname = '$user_lname' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '" . md5($password) . "' ";
		$data .= ", type = '$type' ";

		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set " . $data);
		} else {
			$save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}

	function deactive_user()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE users set user_status = $user_status where id = " . $id);
		if ($update)
			return 1;
	}

	function active_user()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE users set user_status = $user_status where id = " . $id);
		if ($update)
			return 1;
	}

	function save_settings()
	{
		extract($_POST);
		$data = " name = '" . str_replace("'", "&#x2019;", $name) . "' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '" . htmlentities(str_replace("'", "&#x2019;", $about)) . "' ";
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", cover_img = '$fname' ";
		}

		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set " . $data);
		}

		if ($save) {
			$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if (!is_numeric($key))
					$_SESSION['system'][$key] = $value;
			}

			return 1;
		}
	}

	function save_page_img()
	{
		extract($_POST);
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], 'assets/uploads/' . $fname);
			if ($move) {
				$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
				$hostName = $_SERVER['HTTP_HOST'];
				$path = explode('/', $_SERVER['PHP_SELF']);
				$currentPath = '/' . $path[1];
				// $pathInfo = pathinfo($currentPath); 

				return json_encode(array('link' => $protocol . '://' . $hostName . $currentPath . '/admin/assets/uploads/' . $fname));
			}
		}
	}
	function save_student()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM students where id_no ='$id_no' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO students set $data");
		} else {
			$save = $this->db->query("UPDATE students set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}

	function delete_student()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM students where id = " . $id);
		if ($delete) {
			return 1;
		}
	}

	function save_responder()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id', 'ref_code')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}

		$check = $this->db->query("SELECT * FROM responders_team where name ='$name' and station_id = '$station_id' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO responders_team set $data");
			$nid = $this->db->insert_id;
		} else {
			$save = $this->db->query("UPDATE responders_team set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}

	function delete_responder()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM responders_team where id = " . $id);
		if ($delete) {
			return 1;
		}
	}

	function save_station()
	{
		extract($_POST);
		$data = "";
		foreach ($_POST as $k => $v) {
			if (!in_array($k, array('id')) && !is_numeric($k)) {
				if (empty($data)) {
					$data .= " $k='$v' ";
				} else {
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM stations where name ='$name' " . (!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if ($check > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO stations set $data");
			$nid = $this->db->insert_id;
		} else {
			$save = $this->db->query("UPDATE stations set $data where id = $id");
		}

		if ($save) {
			return 1;
		}
	}

	function delete_station()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM stations where id = " . $id);
		if ($delete) {
			return 1;
		}
	}

	function save_log()
	{
		extract($_POST);
		$data = array();
		$qry = $this->db->query("SELECT * from $type where id_no = '$id_code' ");
		if ($qry->num_rows > 0) {
			$res = $qry->fetch_array();
			$id = $res['id'];
			$data['name'] = ucwords($res['name']);
		} else {
			$data['status'] = 2;
			return json_encode($data);
			exit;
		}
		$chk = $this->db->query("SELECT * FROM logs  where frm_id = '$id' and date(date_created) = '" . date('Y-m-d') . "' and type = '$type' order by unix_timestamp(date_created) desc limit 1 ");
		$result = $chk->num_rows > 0 ? $chk->fetch_array() : '';
		if (!empty($result)) {
			$ltype = $result['log_type'] == 1 ? 2 : 1;
		} else {
			$ltype = 1;
		}
		$save = $this->db->query("INSERT INTO logs set frm_id = $id, log_type = '$ltype',type='$type' ");

		if ($save)
			$data['status'] = 1;
		$data['type'] = $ltype;
		return json_encode($data);
	}

	function blocked()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE complainants set complainant_status = $complainant_status where id = $id");
		if ($save)
			return 1;
	}
	function complaint()
	{
		extract($_POST);

		$data = " complainant_id = '{$_SESSION['login_id']}' ";
		$data .= ",complainant_fname ='$complainant_fname' ";
		$data .= ",complainant_lname ='$complainant_lname' ";
		$data .= ",complainant_contact ='$complainant_contact' ";
		$data .= ",respondent_fname ='$respondent_fname' ";
		$data .= ",respondent_lname ='$respondent_lname' ";
		$data .= ",complaints_address ='$complaints_address' ";
		$data .= ",complaints_street ='$complaints_street' ";
		$data .= ",complaints_barangay ='$complaints_barangay' ";
		$data .= ",complaints_municipality ='$complaints_municipality' ";
		$data .= ",complaints_province ='$complaints_province' ";
		$data .= ",contact_num ='$contact_num' ";
		$data .= ",date_happened ='$date_happened' ";
		$data .= ",time_of_incident ='$time_of_incident' ";
		$data .= ",type ='$type' ";
		$data .= ",incident_location ='$incident_location' ";
		$data .= ",incident_street ='$incident_street' ";
		$data .= ",incident_barangay ='$incident_barangay' ";
		$data .= ",incident_municipality ='$incident_municipality' ";
		$data .= ",incident_province ='$incident_province' ";
		$data .= ",description ='$description' ";


		$chk = $this->db->query("Select * from complaints where complaint_id = $id");
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO complaints set " . $data);
		} else {
			$save = $this->db->query("UPDATE complaints set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}

	function cancel()
	{
		extract($_POST);
		$update = $this->db->query("UPDATE complaints set status = 5 where id = " . $id);
		if ($update)
			return 1;
	}

	function confirm()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE cancel_reports set cancel_status = $cancel_status where id = $id");
		if ($save)
			return 1;
	}
	function delete_complaint()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM complaints where id = " . $id);
		if ($delete)
			return 1;
	}

	function cancel_complaint()
	{


		extract($_POST);

		$chk = $this->db->query("SELECT * FROM cancel_reports where complaint_id = $id ");

		$data = " complainant_id = '{$_SESSION['login_id']}' ";
		$data .= ", complaint_id = '$id' ";
		$data .= ",cancel_reason ='$cancel_reason' ";

		$save = $this->db->query("INSERT INTO cancel_reports set " . $data);

		return 1;
	}

	function manage_complaint()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE complaints set status = $status where id = $id");

		if ($save) {
			$chk = $this->db->query("SELECT * FROM complaints_action where complaint_id = $id ");

			if ($status == 2) {
				$data = " complaint_id = $id ";
				$data .= ", responder_id = $responder_id ";
				$data .= ", dispatched_by = {$_SESSION['login_id']} ";
				if ($chk->num_rows > 0) {
					$res = $chk->fetch_array();
					$save2 = $this->db->query("UPDATE complaints_action $data where complaint_id = $id");
				} else {
					$save2 = $this->db->query("INSERT INTO complaints_action set $data");
				}
				if ($save2) {
					$this->db->query("UPDATE responders_team set availability = 0 where id = $responder_id ");
				}
				if (isset($res)) {
					$this->db->query("UPDATE responders_team set availability = 1 where id = {$res['responder_id']} ");
				}
				return 1;
			} elseif ($status == 3) {
				if ($chk->num_rows > 0) {
					$save2 = $this->db->query("UPDATE complaints_action set status = 1 , remarks = '$remarks' where complaint_id = $id");
					if ($save2) {
						$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");
						return 1;
					}
				} else {
					return 2;
				}
			} elseif ($status == 4) {
				if ($chk->num_rows > 0) {
					$save2 = $this->db->query("UPDATE complaints_action set status = 1 , remarks = '$remarks', case_closed = '$case_closed' where complaint_id = $id");
					if ($save2) {
						$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");
						return 1;
					}
				} else {
					return 2;
				}
			} elseif ($status == 5) {
				if ($chk->num_rows > 0) {
					$save2 = $this->db->query("UPDATE complaints_action set status = 1 , remarks = '$remarks', cancellation_reason = '$cancellation_reason' where complaint_id = $id");
					if ($save2) {
						$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");

						return 1;
					}
				} else {
					$save2 = $this->db->query("INSERT INTO complaints_action set $data");
					$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");
				}
			} else {
				$this->db->query("DELETE FROM complaints_action where complaint_id = $id ");
				if (isset($res)) {
					$this->db->query("UPDATE responders_team set availability = 1 where id = {$res['responder_id']} ");
				}
				return 1;
			}
		}
	}

	function manage_cancel()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE cancel_reports set cancel_status = $cancel_status where id = $id");
		return 1;
	}


	//crime
	function crime()
	{
		extract($_POST);
		$data = " complainant_id = '{$_SESSION['login_id']}' ";
		$data .= ",type_of_crime ='$type_of_crime' ";
		$data .= ",crime_street ='$crime_street' ";
		$data .= ",crime_barangay ='$crime_barangay' ";
		$data .= ",crime_landmark ='$crime_landmark' ";
		$data .= ",involved_person ='$involved_person' ";
		$data .= ",crime_details ='$crime_details' ";

		$chk = $this->db->query("Select * from crime where where complaint_id = $id");
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO crime set " . $data);
		} else {
			$save = $this->db->query("UPDATE crime set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}

	function delete_crime()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM crime where id = " . $id);
		if ($delete)
			return 1;
	}

	//crime
	function manage_crime()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE crime set status = $status where id = $id");

		if ($save) {
			$chk = $this->db->query("SELECT * FROM crime_action where complaint_id = $id ");

			if ($status == 2) {
				$data = " complaint_id = $id ";
				$data .= ", responder_id = $responder_id ";
				$data .= ", dispatched_by = {$_SESSION['login_id']} ";
				if ($chk->num_rows > 0) {
					$res = $chk->fetch_array();
					$save2 = $this->db->query("UPDATE crime_action $data where complaint_id = $id");
				} else {
					$save2 = $this->db->query("INSERT INTO crime_action set $data");
				}
				if ($save2) {
					$this->db->query("UPDATE responders_team set availability = 0 where id = $responder_id ");
				}
				if (isset($res)) {
					$this->db->query("UPDATE responders_team set availability = 1 where id = {$res['responder_id']} ");
				}
				return 1;
			} elseif ($status == 3) {
				if ($chk->num_rows > 0) {
					$save2 = $this->db->query("UPDATE crime_action set status = 1 , remarks = '$remarks' where complaint_id = $id");
					if ($save2) {
						$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");
						return 1;
					}
				} else {
					return 2;
				}
			} else {
				$this->db->query("DELETE FROM crime_action where complaint_id = $id ");
				if (isset($res)) {
					$this->db->query("UPDATE responders_team set availability = 1 where id = {$res['responder_id']} ");
				}
				return 1;
			}
		}
	}
}
