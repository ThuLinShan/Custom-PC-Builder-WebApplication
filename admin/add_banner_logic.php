<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $img                = $_FILES['img'];
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = filter_var($_POST['type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sub_type = "";
    $valid_types = ['main', 'secondary', 'products'];

    if (isset($_POST['subtype'])) {
        $sub_type = $_POST['subtype'];
    }


    if (!$description) {
        $_SESSION['add-banner'] = "Please enter the description of the banner";
    } elseif (!$type) {
        $_SESSION['add-banner'] = "Please enter the type of the banner";
    } elseif (!in_array($type, $valid_types)) {
        $_SESSION['add-banner'] = "Banner type is not valid";
    } else {
        $time = time();
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
                $_SESSION['add-banner'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-banner'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-banner'])) {
        $_SESSION['add-banner-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_banner.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO banners (
                                img,
                                description,
                                type,
                                sub_type
                                ) VALUES (
                                '$img_name',
                                '$description',
                                '$type',
                                '$sub_type'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            if ($type == 'main') {
                header('location: ' . ROOT_URL . 'admin/manage_main_banner.php?type=' . $type);
            } else {
                header('location: ' . ROOT_URL . 'admin/');
            }
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-banner-data'] = $_POST;
            $_SESSION['add-banner'] = "Something went wrong";
            if ($type == 'main') {
                header('location: ' . ROOT_URL . 'admin/add_banner.php?type=' . $type);
            } else {
                header('location: ' . ROOT_URL . 'admin/');
            }
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_banner.php');
    die();
}
