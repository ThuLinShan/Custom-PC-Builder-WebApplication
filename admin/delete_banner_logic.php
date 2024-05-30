<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT id FROM banners";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) < 3) {
        $_SESSION['delete-banner'] = "Banner is less 3. Please add a new banner to perform future delete actions.";
    } else {

        // Fetch banner
        $query = "SELECT * FROM banners WHERE id=$id";
        $result = mysqli_query($connection, $query);
        $banner = mysqli_fetch_assoc($result);

        // Make sure banner row equal to one
        if (mysqli_num_rows($result) == 1) {
            var_dump($banner);
            $thumbnail_name = $banner['img'];
            $thumbnail_path =  '../assets/images/banners/' . $thumbnail_name;

            if ($thumbnail_path) {
                unlink($thumbnail_path);
            }
        }

        // Delete banner from database
        $delete_banner_query = "DELETE FROM banners WHERE id=$id";
        $delete_banner_result = mysqli_query($connection, $delete_banner_query);

        if (mysqli_errno($connection)) {
            $_SESSION['delete-banner'] = "Could not delete banner id " . $id;
        } else {
            $_SESSION['delete-banner-success'] = "Banner deleted succesfully";
        }
    }
}
// Redirect to manage posts page
if ($banner['type'] == 'main') {
    header('location: ' . ROOT_URL . 'admin/manage_main_banner.php?type=' . $type);
} else {
    header('location: ' . ROOT_URL . 'admin/');
}

die();
