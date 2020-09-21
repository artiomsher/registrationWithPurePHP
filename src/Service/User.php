<?php

namespace Registration;

class User {
    private $name;
    private $lastName;
    private $phone;
    private $registeredAt;
    private $email;

    public function __construct($email, $name, $lastName, $phone, $registeredAt) {
        $this->email = $email;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->phone = $phone;
        $this->registeredAt = $registeredAt;
    }

    public function getName() {
        return $this->name;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRegisteredAt() {
        return $this->registeredAt;
    }
}
?>