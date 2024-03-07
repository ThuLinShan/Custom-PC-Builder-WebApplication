<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch ram
    $query = "SELECT * FROM memory WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $ram = mysqli_fetch_assoc($result);

    // Make sure ram row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($ram);
        $thumbnail_name = $ram['img'];
        $thumbnail_path =  '../assets/images/products/ram/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete ram from database
    $delete_ram_query = "DELETE FROM ram WHERE id=$id";
    $delete_ram_result = mysqli_query($connection, $delete_ram_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-ram'] = "Could not delete ram: {$ram['ram_name']}";
    } else {
        $_SESSION['delete-ram-success'] = "ram: {$ram['ram_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_ram.php');
die();
