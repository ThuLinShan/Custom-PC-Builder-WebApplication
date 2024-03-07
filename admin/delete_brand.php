<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch brand
    $query = "SELECT * FROM brand WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $brand = mysqli_fetch_assoc($result);

    // Make sure brand row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($brand);
        $thumbnail_name = $brand['img'];
        $thumbnail_path =  '../assets/images/brands/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete brand from database
    $delete_brand_query = "DELETE FROM brand WHERE id=$id";
    $delete_brand_result = mysqli_query($connection, $delete_brand_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-brand'] = "Could not delete brand: {$brand['brand_name']}";
    } else {
        $_SESSION['delete-brand-success'] = "Brand: {$brand['brand_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/index.php');
die();
