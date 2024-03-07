<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch motherboard
    $query = "SELECT * FROM motherboard WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $motherboard = mysqli_fetch_assoc($result);

    // Make sure motherboard row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($motherboard);
        $thumbnail_name = $motherboard['img'];
        $thumbnail_path =  '../assets/images/products/motherboard/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete motherboard from database
    $delete_motherboard_query = "DELETE FROM motherboard WHERE id=$id";
    $delete_motherboard_result = mysqli_query($connection, $delete_motherboard_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-motherboard'] = "Could not delete motherboard: {$motherboard['motherboard_name']}";
    } else {
        $_SESSION['delete-motherboard-success'] = "motherboard: {$motherboard['motherboard_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_motherboard.php');
die();
