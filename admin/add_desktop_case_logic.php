<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $desktop_case_name   = filter_var($_POST['desktop_case_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $type = filter_var($_POST['type'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $color = filter_var($_POST['color'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $cooling = filter_var($_POST['cooling'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dimensions = filter_var($_POST['dimensions'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $io_panel = filter_var($_POST['io_panel'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $radiator_support = filter_var($_POST['radiator_support'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$desktop_case_name) {
        $_SESSION['add-desktop_case'] = "Please enter a desktop_case_name";
    } elseif (!$brand) {
        $_SESSION['add-desktop_case'] = "Please select the brand for the desktop_case";
    } elseif (!$color) {
        $_SESSION['add-desktop_case'] = "Please enter the color for the desktop_case";
    } elseif (!$cooling) {
        $_SESSION['add-desktop_case'] = "Please enter the supported liquid cooling system for the desktop_case";
    } elseif (!$dimensions) {
        $_SESSION['add-desktop_case'] = "Please enter the dimensions of the desktop_case";
    } elseif (!$io_panel) {
        $_SESSION['add-desktop_case'] = "Please enter the IO panels of the desktop_case";
    } elseif (!$radiator_support) {
        $_SESSION['add-desktop_case'] = "Please enter the supported radiator for the desktop_case";
    } elseif (!$link) {
        $_SESSION['add-desktop_case'] = "Please enter the official link for the desktop_case";
    } elseif (!$price) {
        $_SESSION['add-desktop_case'] = "Please enter the price for the desktop_case";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/desktop_case/' . $img_name;

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
                $_SESSION['add-desktop_case'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-desktop_case'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-desktop_case'])) {
        $_SESSION['add-desktop_case-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_desktop_case.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO desktop_case (
                                desktop_case_name,
                                img,
                                brand,
                                type,
                                color,
                                cooling,
                                dimensions,
                                io_panel,
                                radiator_support,
                                price,
                                link
                                ) VALUES (
                                '$desktop_case_name',
                                '$img_name',
                                '$brand',
                                '$type',
                                '$color',
                                '$cooling',
                                '$dimensions',
                                '$io_panel',
                                '$radiator_support',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-desktop_case-success'] = "New desktop_case: $desktop_case_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_desktop_case.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-desktop_case-data'] = $_POST;
            $_SESSION['add-desktop_case'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_desktop_case.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_desktop_case.php');
    die();
}
