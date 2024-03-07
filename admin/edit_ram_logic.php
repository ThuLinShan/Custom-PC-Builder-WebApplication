<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ram_name   = filter_var($_POST['ram_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_NUMBER_INT);
    $frequency = filter_var($_POST['frequency'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $combo = filter_var($_POST['combo'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$ram_name) {
        $_SESSION['add-ram'] = "Please enter a ram_name";
    } elseif (!$brand) {
        $_SESSION['add-ram'] = "Please select the brand for the ram";
    } elseif (!$capacity) {
        $_SESSION['add-ram'] = "Please enter the capacity of the ram";
    } elseif (!$frequency) {
        $_SESSION['add-ram'] = "Please enter the frequency of the ram";
    } elseif (!$combo) {
        $_SESSION['add-ram'] = "Please enter the total number of physical combo in the ram";
    } elseif (!$price) {
        $_SESSION['add-ram'] = "Please enter the price of the ram";
    } elseif (!$link) {
        $_SESSION['add-ram'] = "Please enter the official link of the ram";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/ram/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/products/ram/' . $img_name;

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
                    $_SESSION['edit-ram'] = "img is too large";
                }
            } else {
                $_SESSION['edit-ram'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-ram'])) {
        header('location: ' . ROOT_URL . 'admin/edit_ram.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE memory SET 
                    ram_name='$ram_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    capacity='$capacity',
                    frequency='$frequency',
                    combo='$combo',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-ram-success'] = "ram: $ram_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_ram.php');
            die();
        } else {
            $_SESSION['edit-ram'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
