<?php
namespace Registration;

use \Registration\dbConnection;

class AuthController {

	private $dbConn;

	private $ds;

	public function __construct() {
		require_once "dbConnection.php";
		$this->ds = new dbConnection();
	}

	public function userRegister($email, $name, $lastName, $phone, $password, $registered_at, $last_login_at) {
		$password = password_hash($password, PASSWORD_BCRYPT);
		$qr = mysqli_query($this->ds->conn,
			"INSERT INTO registered_users(email, name, last_name, phone, password, registered_at, last_login_at)
            values('" . $email . "','" . $name . "','" . $lastName . "',
                   '" . $phone . "','" . $password . "','" . $registered_at . "',
                   '" . $last_login_at . "')")
		or die(mysqli_error($this->ds->conn));
		return $qr;

	}
	public function validateMember() {
		$valid = true;
		$errorMessage = array();
		foreach ($_POST as $key => $value) {
			if (empty($_POST[$key])) {
				$valid = false;
			}
		}

		if ($valid == true) {
			if ($_POST['password'] != $_POST['password_confirmation']) {
				$errorMessage[] = 'Passwords should be same.';
				$valid = false;
			}
			if (!isset($error_message)) {
				if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
					$errorMessage[] = "Invalid email address.";
					$valid = false;
				}
			}
			if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $_POST['password'])) {
				$errorMessage[] = "Password should contain uppercase letter and number.";
				$valid = false;
			}
            if (strlen($_POST['password']) < 8 || strlen($_POST['password']) > 12) {
                $errorMessage[] = "Password length should be 8-12.";
                $valid = false;
            }
		} else {
			$errorMessage[] = "All fields are required.";
		}

		if ($valid == false) {
			return $errorMessage;
		}
		return;
	}
	public function login($email, $password) {
		$res = mysqli_query($this->ds->conn, "SELECT * FROM registered_users WHERE email = '" . $email . "'");
		$userData = mysqli_fetch_array($res);
		$noRows = mysqli_num_rows($res);
		$isVerified = password_verify($password, $userData['password']);
		if ($noRows == 1 && $isVerified) {
            $loggedInAt = date('Y-m-d H:i:s');
            $res = mysqli_query($this->ds->conn, "UPDATE registered_users SET last_login_at='".$loggedInAt."'
                                                  WHERE user_id = '".$userData["user_id"]."'");
			session_start();
            require_once "../src/Service/User.php";
			$_SESSION['loggedin'] = true;
			$_SESSION['user'] = new User($userData["email"],
                                         $userData["name"],
                                         $userData["last_name"],
                                         $userData["phone"],
                                         $userData["registered_at"]);
			return true;
		} else {
			return false;
		}
	}
	public function isUserExist($email) {
		$result = mysqli_query($this->ds->conn, "SELECT * FROM registered_users WHERE email = '" . $email . "'");
		$row = mysqli_num_rows($result);
		if ($row > 0) {
			return true;
		} else {
			return false;
		}
	}
}
