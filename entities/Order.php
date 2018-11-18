<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helper/DataProvider.php';
class Order {

    var $orderID, $orderDate, $userID, $total, $note;

    function __construct($orderID, $orderDate, $userID, $total, $note) {
        $this->orderID = $orderID;
        $this->orderDate = $orderDate;
        $this->userID = $userID;
        $this->total = $total;
        $this->note = $note;
    }

    public function getOrderID() {
        return $this->orderID;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getTotal() {
        return $this->total;
    }
    public function getNote() {
        return $this->note;
    }

    public function setOrderID($orderID) {
        $this->orderID = $orderID;
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setTotal($total) {
        $this->total = $total;
    }
    public function setNote($note) {
        $this->note = $note;
    }

    public function add() {
		
        $str_order_date = date('Y-m-d H:i:s', $this->orderDate);

        $sql = "insert into orders (orderDate, user, total, note, status) values ('$str_order_date', '$this->userID' , $this->total, '$this->note', 0)";
		
        $this->orderID = DataProvider::execNonQueryIdentity($sql);
    }

}
