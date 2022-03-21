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



	function missing()
	{
		extract($_POST);
		$data = " complainant_id = '{$_SESSION['login_id']}' ";
		$data .= ",missing_fname ='$missing_fname' ";
		$data .= ",missing_lname ='$missing_lname' ";
		$data .= ",missing_age ='$missing_age' ";
		$data .= ",missing_gender ='$missing_gender' ";
		$data .= ",date_happened ='$date_happened' ";
		$data .= ",missing_address ='$missing_address' ";
		$data .= ",physical_description ='$physical_description' ";
		$data .= ",missing_cloth ='$missing_cloth' ";
		$data .= ",informer_fname ='$informer_fname' ";
		$data .= ",informer_lname ='$informer_lname' ";
		$data .= ",contact_number ='$contact_number' ";
		if ($_FILES['missing_image']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['missing_image']['name'];
			$move = move_uploaded_file($_FILES['missing_image']['tmp_name'], 'assets/uploads/' . $fname);
			$data .= ", missing_image = '$fname' ";
		}

		$chk = $this->db->query("Select * from missing where complaint_id = $id");
		if ($chk > 0) {
			return 2;
			exit;
		}
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO missing set " . $data);
		} else {
			$save = $this->db->query("UPDATE missing set " . $data . " where id = " . $id);
		}
		if ($save) {

			return 1;
		}
	}



	function delete_missing()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM missing where id = " . $id);
		if ($delete)
			return 1;
	}



	function manage_missing()
	{
		extract($_POST);
		$save = $this->db->query("UPDATE missing set status = $status where id = $id");
		if ($save) {
			$chk = $this->db->query("SELECT * FROM missing_action where complaint_id = $id ");
			if ($status == 2) {
				$data = " complaint_id = $id ";
				$data .= ", responder_id = $responder_id ";
				$data .= ", dispatched_by = {$_SESSION['login_id']} ";
				if ($chk->num_rows > 0) {
					$res = $chk->fetch_array();
					$save2 = $this->db->query("UPDATE missing_action $data where complaint_id = $id");
				} else {
					$save2 = $this->db->query("INSERT INTO missing_action set $data");
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
					$save2 = $this->db->query("UPDATE missing_action set status = 1 , remarks = '$remarks' where complaint_id = $id");
					if ($save2) {
						$this->db->query("UPDATE responders_team set availability = 1 where id = $responder_id ");
						return 1;
					}
				} else {
					return 2;
				}
			} else {
				$this->db->query("DELETE FROM missing_action where complaint_id = $id ");
				if (isset($res)) {
					$this->db->query("UPDATE responders_team set availability = 1 where id = {$res['responder_id']} ");
				}
				return 1;
			}
		}

		function signature()
		{
			extract($_POST);

			if ($_FILES['signed']['tmp_name'] != '') {
				$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['signed']['name'];
				$move = move_uploaded_file($_FILES['signed']['tmp_name'], 'assets/uploads/' . $fname);
				$data .= ",signed = '$fname' ";
			}

			$chk = $this->db->query("Select * from complaints_signature where complaint_id = $id");
			if ($chk > 0) {
				return 2;
				exit;
			}
			if (empty($id)) {
				$save = $this->db->query("INSERT INTO complaints_signature set " . $data);
			} else {
				$save = $this->db->query("UPDATE complaints_signature set " . $data . " where id = " . $id);
			}
			if ($save) {
				return 1;
			}
		}
	}
}
