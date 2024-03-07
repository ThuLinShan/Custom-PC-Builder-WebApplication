<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $motherboard_name   = filter_var($_POST['motherboard_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $chipset        = filter_var($_POST['chipset'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $chipset_name        = filter_var($_POST['chipset_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $form_factor        = filter_var($_POST['form_factor'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ram_slots                 = filter_var($_POST['ram_slots'], FILTER_SANITIZE_NUMBER_INT);
    $brand                 = filter_var($_POST['brand'], FILTER_SANITIZE_NUMBER_INT);
    $price                 = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$motherboard_name) {
        $_SESSION['edit-motherboard'] = "Please enter a motherboard_name";
    } elseif (!$link) {
        $_SESSION['edit-motherboard'] = "Please enter official link of the motherboard";
    } elseif (!$chipset) {
        $_SESSION['edit-motherboard'] = "Please select the chipset type";
    } elseif (!$chipset_name) {
        $_SESSION['edit-motherboard'] = "Please enter the chipset name";
    } elseif (!$form_factor) {
        $_SESSION['edit-motherboard'] = "Please select the form factor";
    } elseif (!$ram_slots) {
        $_SESSION['edit-motherboard'] = "Please enter the total number of ram slots";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/motherboard/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
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
                    $_SESSION['edit-motherboard'] = "img is too large";
                }
            } else {
                $_SESSION['edit-motherboard'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-motherboard'])) {
        header('location: ' . ROOT_URL . 'admin/edit_motherboard.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE motherboard SET 
                    motherboard_name='$motherboard_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    chipset='$chipset',
                    chipset_name='$chipset_name',
                    ram_slots='$ram_slots',
                    form_factor='$form_factor',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-motherboard-success'] = "motherboard: $motherboard_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_motherboard.php');
            die();
        } else {
            $_SESSION['edit-motherboard'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
