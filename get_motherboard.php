<?php
require 'config/database.php';

if (isset($_POST["motherboard_id"])) {

    $id = filter_var($_POST["motherboard_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,motherboard_name,price,form_factor FROM motherboard WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $motherboard = mysqli_fetch_assoc($result);
    }

    echo json_encode($motherboard);
}
