<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $storage_name   = filter_var($_POST['storage_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $interface = filter_var($_POST['interface'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $capacity = filter_var($_POST['capacity'], FILTER_SANITIZE_NUMBER_INT);
    $capacity_format = filter_var($_POST['capacity_format'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$storage_name) {
        $_SESSION['add-storage'] = "Please enter a storage_name";
    } elseif (!$brand) {
        $_SESSION['add-storage'] = "Please select the brand for the storage";
    } elseif (!$interface) {
        $_SESSION['add-storage'] = "Please enter the interface of the storage drive";
    } elseif (!$capacity) {
        $_SESSION['add-storage'] = "Please enter the total number of capacity in the storage";
    } elseif (!$capacity_format) {
        $_SESSION['add-storage'] = "Please select the storage type of the drive";
    } elseif (!$price) {
        $_SESSION['add-storage'] = "Please enter the price of the storage";
    } elseif (!$link) {
        $_SESSION['add-storage'] = "Please enter the official link of the storage";
    } else {

        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/storage/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/products/storage/' . $img_name;

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
                    $_SESSION['edit-storage'] = "img is too large";
                }
            } else {
                $_SESSION['edit-storage'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-storage'])) {
        header('location: ' . ROOT_URL . 'admin/edit_storage.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE storage SET 
                    storage_name='$storage_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    interface='$interface',
                    capacity='$capacity',
                    capacity_format = '$capacity_format',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-storage-success'] = "storage: $storage_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_storage.php');
            die();
        } else {
            $_SESSION['edit-storage'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
