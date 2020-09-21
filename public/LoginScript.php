<?php
namespace Registration;

use \Registration\AuthController;

if (!empty($_POST["login-user"])) {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);
    $loginAt = date('Y/m/d h:i:s');
    require_once "../src/Service/AuthController.php";
    $user = new AuthController();
    if ($user->login($email, $password)) {
        var_dump($loginAt);
        header("Location: profile.php");
    } else {
        $errorMessage = "Credentials are incorrect.";
        session_start();
        $_SESSION["error"] = $errorMessage;
        header("Location: login.php");
    }
}
?>