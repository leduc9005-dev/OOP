<?php
require_once 'User.php';

class Customer extends User {
    private $points;

    public function __construct($id, $username, $points) {
        parent::__construct($id, $username, 'customer');
        $this->points = $points;
    }

    public function getPoints() {
        return $this->points;
    }
}
