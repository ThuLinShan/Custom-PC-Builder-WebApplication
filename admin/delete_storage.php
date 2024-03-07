<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch storage
    $query = "SELECT * FROM storage WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $storage = mysqli_fetch_assoc($result);

    // Make sure storage row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($storage);
        $thumbnail_name = $storage['img'];
        $thumbnail_path =  '../assets/images/products/storage/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete storage from database
    $delete_storage_query = "DELETE FROM storage WHERE id=$id";
    $delete_storage_result = mysqli_query($connection, $delete_storage_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-storage'] = "Could not delete storage: {$storage['storage_name']}";
    } else {
        $_SESSION['delete-storage-success'] = "storage: {$storage['storage_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_storage.php');
die();
