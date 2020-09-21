<?php
namespace Registration;

session_unset();
if (!empty($_POST["register-user"])) {
	session_start();
	$name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$lastName = filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
	$password = $_POST["password"];
	$email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    date_default_timezone_set('Europe/Vilnius');
	$registeredAt = date('Y-m-d H:i:s');

	require_once "../src/Service/AuthController.php";

	$user = new AuthController();
	$errorMessage = $user->validateMember();

	if (empty($errorMessage)) {
		if (!$user->isUserExist($email)) {

			$insertId = $user->userRegister($email, $name, $lastName, $phone, $password, $registeredAt, $registeredAt);
			if (!empty($insertId)) {
				require_once "../src/Service/User.php";
				$_SESSION['loggedin'] = true;
				$_SESSION['user'] = new User($email, $name, $lastName, $phone, $registeredAt);

				header("Location: profile.php");
			}
		} else {

			$errorMessage[] = "User already exists.";
			$_SESSION['errors'] = $errorMessage;
			
			header("Location: registration.php");
		}
	}
	else {
			$_SESSION['errors'] = $errorMessage;
			header("Location: registration.php");
	}
}
?>