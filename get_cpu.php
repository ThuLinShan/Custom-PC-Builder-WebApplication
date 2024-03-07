<?php
require 'config/database.php';

if (isset($_POST["cpu_id"])) {

    $id = filter_var($_POST["cpu_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,cpu_name,price,frequency FROM cpu WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $cpu = mysqli_fetch_assoc($result);
    }

    echo json_encode($cpu);
}
