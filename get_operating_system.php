<?php
require 'config/database.php';

if (isset($_POST["operating_system_id"])) {

    $id = filter_var($_POST["operating_system_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,operating_system_name,price FROM operating_system WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $operating_system = mysqli_fetch_assoc($result);
    }

    echo json_encode($operating_system);
}
