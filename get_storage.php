<?php
require 'config/database.php';

if (isset($_POST["storage_id"])) {

    $id = filter_var($_POST["storage_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,storage_name,price,capacity, capacity_format FROM storage WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $storage = mysqli_fetch_assoc($result);
    }

    echo json_encode($storage);
}
