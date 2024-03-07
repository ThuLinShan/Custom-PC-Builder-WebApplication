<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $motherboard_name   = filter_var($_POST['motherboard_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $chipset        = filter_var($_POST['chipset'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $chipset_name        = filter_var($_POST['chipset_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $form_factor        = filter_var($_POST['form_factor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ram_slots                 = filter_var($_POST['ram_slots'], FILTER_SANITIZE_NUMBER_INT);
    $brand                 = filter_var($_POST['brand'], FILTER_SANITIZE_NUMBER_INT);
    $price                 = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img           = $_FILES['img'];



    if (!$motherboard_name) {
        $_SESSION['add-motherboard'] = "Please enter a motherboard_name";
    } elseif (!$link) {
        $_SESSION['add-motherboard'] = "Please enter official link of the motherboard";
    } elseif (!$chipset) {
        $_SESSION['add-motherboard'] = "Please select the chipset type";
    } elseif (!$chipset_name) {
        $_SESSION['add-motherboard'] = "Please enter the chipset name";
    } elseif (!$form_factor) {
        $_SESSION['add-motherboard'] = "Please select the form factor";
    } elseif (!$ram_slots) {
        $_SESSION['add-motherboard'] = "Please enter the total number of ram slots";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/products/motherboard/' . $img_name;

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
                $_SESSION['add-motherboard'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-motherboard'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-motherboard'])) {
        $_SESSION['add-motherboard-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_motherboard.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO motherboard (
                                motherboard_name,
                                img,
                                brand,
                                chipset,
                                chipset_name,
                                ram_slots,
                                form_factor,
                                price,
                                link
                                ) VALUES (
                                '$motherboard_name',
                                '$img_name',
                                '$brand',
                                '$chipset',
                                '$chipset_name',
                                '$ram_slots',
                                '$form_factor',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            // $name = $img['name'];
            // $size = $img['size'];
            // $tmp_name = $img['tmp_name'];
            $_SESSION['add-motherboard-success'] = "New motherboard: $motherboard_name successfully added $img_name";
            header('location: ' . ROOT_URL . 'admin/manage_motherboard.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-motherboard-data'] = $_POST;
            $_SESSION['add-motherboard'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_motherboard.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_motherboard.php');
    die();
}
