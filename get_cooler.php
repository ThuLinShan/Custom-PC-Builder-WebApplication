<?php
require 'config/database.php';

if (isset($_POST["cooler_id"])) {

    $id = filter_var($_POST["cooler_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,cooler_name,price,fan_speed FROM cooler WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $cooler = mysqli_fetch_assoc($result);
    }

    echo json_encode($cooler);
}
