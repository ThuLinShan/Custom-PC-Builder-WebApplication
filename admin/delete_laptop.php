<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch laptop
    $query = "SELECT * FROM laptop WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $laptop = mysqli_fetch_assoc($result);

    // Make sure laptop row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($laptop);
        $thumbnail_name = $laptop['img'];
        $thumbnail_path =  '../assets/images/products/laptop/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete laptop from database
    $delete_laptop_query = "DELETE FROM laptop WHERE id=$id";
    $delete_laptop_result = mysqli_query($connection, $delete_laptop_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-laptop'] = "Could not delete laptop: {$laptop['laptop_name']}";
    } else {
        $_SESSION['delete-laptop-success'] = "laptop: {$laptop['laptop_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_laptop.php');
die();
