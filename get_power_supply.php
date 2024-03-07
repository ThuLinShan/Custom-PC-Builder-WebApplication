<?php
require 'config/database.php';

if (isset($_POST["power_supply_id"])) {

    $id = filter_var($_POST["power_supply_id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT id,img,power_supply_name,price,power FROM power_supply WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $power_supply = mysqli_fetch_assoc($result);
    }

    echo json_encode($power_supply);
}
