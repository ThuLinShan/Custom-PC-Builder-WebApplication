<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                         = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name    = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description                       = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                  = $_FILES['img'];

    $query = "SELECT * FROM banners WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $banner = mysqli_fetch_assoc($result);
    }


    if (!$id) {
        $_SESSION['edit-banner'] = "Invalid operation: no id";
    }
    if (!$description) {
        $_SESSION['edit-banner'] = "Please enter description";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/banners/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/banners/' . $img_name;

            // Validate file format
            $allowed_files = ['png', 'jpg', 'jpeg'];
            $extension = explode('.', $img_name);
            $extension = end($extension);
            if (in_array($extension, $allowed_files)) {
                // Validate file size
                if ($img['size'] < 2_000_000) {
                    // Upload image
                    move_uploaded_file($img_tmp_name, $img_destination_path);
                } else {
                    $_SESSION['edit-banner'] = "img is too large";
                }
            } else {
                $_SESSION['edit-banner'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-banner'])) {
        header('location: ' . ROOT_URL . 'admin/edit_banner.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;
        $query =    "UPDATE banners SET 
                    description='$description', 
                    img='$img_to_insert'
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-banner-success'] = "banner: $banner_name successfully updated";
            if ($banner['type'] == 'main') {
                header('location: ' . ROOT_URL . 'admin/manage_main_banner.php');
            } else {
                header('location: ' . ROOT_URL . 'admin/');
            }
            die();
        } else {
            $_SESSION['edit-banner'] = "Something went wrong";
            if ($banner['type'] == 'main') {
                header('location: ' . ROOT_URL . 'admin/edit_banner.php?id=' . $id);
            } else {
                header('location: ' . ROOT_URL . 'admin/');
            }
            die();
        }
    }
} // Redirect to manage posts page

die();
