<?php
declare (strict_types = 1);

namespace Registration;

class dbConnection {
	const HOST = 'localhost';

	const USERNAME = 'root';

	const PASSWORD = '';

	const DATABASENAME = 'registration';

	public $conn;

	public function __construct() {
		$this->conn = $this->getConnection();
		return $this->conn;
	}

	public function getConnection() {
		$conn = new \mysqli(self::HOST, self::USERNAME, self::PASSWORD, self::DATABASENAME);

		if (mysqli_connect_errno()) {
			trigger_error("Problem with connecting to database.");
		}

		$conn->set_charset("utf8");
		return $conn;
	}
}
