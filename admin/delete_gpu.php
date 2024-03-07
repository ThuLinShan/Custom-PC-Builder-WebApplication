<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch gpu
    $query = "SELECT * FROM gpu WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $gpu = mysqli_fetch_assoc($result);

    // Make sure gpu row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($gpu);
        $thumbnail_name = $gpu['img'];
        $thumbnail_path =  '../assets/images/products/gpu/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete gpu from database
    $delete_gpu_query = "DELETE FROM gpu WHERE id=$id";
    $delete_gpu_result = mysqli_query($connection, $delete_gpu_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-gpu'] = "Could not delete gpu: {$gpu['gpu_name']}";
    } else {
        $_SESSION['delete-gpu-success'] = "gpu: {$gpu['gpu_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_gpu.php');
die();
