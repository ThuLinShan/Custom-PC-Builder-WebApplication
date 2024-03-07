<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch power_supply
    $query = "SELECT * FROM power_supply WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $power_supply = mysqli_fetch_assoc($result);

    // Make sure power_supply row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($power_supply);
        $thumbnail_name = $power_supply['img'];
        $thumbnail_path =  '../assets/images/products/power_supply/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete power_supply from database
    $delete_power_supply_query = "DELETE FROM power_supply WHERE id=$id";
    $delete_power_supply_result = mysqli_query($connection, $delete_power_supply_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-power_supply'] = "Could not delete power_supply: {$power_supply['power_supply_name']}";
    } else {
        $_SESSION['delete-power_supply-success'] = "power_supply: {$power_supply['power_supply_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_power_supply.php');
die();
