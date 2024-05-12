<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch prebuilt
    $query = "SELECT * FROM prebuilt WHERE id=$id LIMIT 1";
    $result = mysqli_query($connection, $query);
    $prebuilt = mysqli_fetch_assoc($result);

    // Make sure prebuilt row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($prebuilt);
        $thumbnail_name = $prebuilt['img'];
        $thumbnail_path =  '../assets/images/products/prebuilt/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete prebuilt from database
    $delete_prebuilt_query = "DELETE FROM prebuilt WHERE id=$id";
    $delete_prebuilt_result = mysqli_query($connection, $delete_prebuilt_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-prebuilt'] = "Could not delete prebuilt: {$prebuilt['prebuilt_name']}";
    } else {
        $_SESSION['delete-prebuilt-success'] = "prebuilt: {$prebuilt['prebuilt_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_prebuilt.php');
die();
