<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch operating_system
    $query = "SELECT * FROM operating_system WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $operating_system = mysqli_fetch_assoc($result);

    // Make sure operating_system row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($operating_system);
        $thumbnail_name = $operating_system['img'];
        $thumbnail_path =  '../assets/images/products/operating_system/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete operating_system from database
    $delete_operating_system_query = "DELETE FROM operating_system WHERE id=$id";
    $delete_operating_system_result = mysqli_query($connection, $delete_operating_system_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-operating_system'] = "Could not delete operating_system: {$operating_system['operating_system_name']}";
    } else {
        $_SESSION['delete-operating_system-success'] = "operating_system: {$operating_system['operating_system_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_operating_system.php');
die();
