<?php
require 'config/database.php';

if (isset($_POST["gpu_id"])) {

    $id = filter_var($_POST["gpu_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,gpu_name,price,vram FROM gpu WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $gpu = mysqli_fetch_assoc($result);
    }

    echo json_encode($gpu);
}
