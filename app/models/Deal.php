<?php

require_once "../config/db.php";

class Deal {


     public function create($user_id, $item_name, $price, $store_name, $phone, $location, $image) {
        global $conn;


        $stmt = $conn->prepare("INSERT INTO deals (user_id, item_name, price, store_name, store_phone, location, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $user_id, $item_name, $price, $store_name, $phone, $location, $image);

        return $stmt->execute();
    }


    public function getAll() {
        global $conn;

        $result = $conn->query("SELECT * FROM deals ORDER BY created_at DESC");
        return $result;
    }

    public function getById($id) {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM deals WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $item_name, $price, $store_name, $phone, $location) {
        global $conn;

        $stmt = $conn->prepare("UPDATE deals SET item_name=?, price=?, store_name=?, store_phone=?, location=? WHERE id=?");
        $stmt->bind_param("sssssi", $item_name, $price, $store_name, $phone, $location, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM deals WHERE id=?");
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

}