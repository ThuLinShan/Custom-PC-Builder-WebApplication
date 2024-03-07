<?php
require 'config/database.php';

if (isset($_POST["ram_id"])) {

    $id = filter_var($_POST["ram_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,ram_name,price,capacity FROM memory WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $ram = mysqli_fetch_assoc($result);
    }

    echo json_encode($ram);
}
