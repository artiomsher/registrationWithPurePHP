<?php
session_start();
if (!empty($_POST["logout-user"])) {
    session_unset();
	session_destroy();
	header("Location: login.php");
}
?>