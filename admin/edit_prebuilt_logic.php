<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $prebuilt_name   = filter_var($_POST['prebuilt_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    if (isset($_POST['free_shipping'])) {
        $free_shipping = filter_var($_POST['free_shipping'], FILTER_SANITIZE_NUMBER_INT);
    } else {
        $free_shipping = 0;
    }
    $chipset = filter_var($_POST['chipset'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $status = filter_var($_POST['status'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $stock = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
    $default_price = filter_var($_POST['default_price'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $motherboard = filter_var($_POST['motherboard'], FILTER_SANITIZE_NUMBER_INT);
    $cpu = filter_var($_POST['cpu'], FILTER_SANITIZE_NUMBER_INT);
    $gpu = filter_var($_POST['gpu'], FILTER_SANITIZE_NUMBER_INT);
    $operating_system = filter_var($_POST['operating_system'], FILTER_SANITIZE_NUMBER_INT);
    $ram = filter_var($_POST['ram'], FILTER_SANITIZE_NUMBER_INT);
    $primary_storage = filter_var($_POST['primary_storage'], FILTER_SANITIZE_NUMBER_INT);
    $secondary_storage = filter_var($_POST['secondary_storage'], FILTER_SANITIZE_NUMBER_INT);
    $power_supply = filter_var($_POST['power_supply'], FILTER_SANITIZE_NUMBER_INT);
    $desktop_case = filter_var($_POST['desktop_case'], FILTER_SANITIZE_NUMBER_INT);
    $cooler = filter_var($_POST['cooler'], FILTER_SANITIZE_NUMBER_INT);
    $img    = $_FILES['img'];

    $free_shipping = $free_shipping == 1 ?: 0;



    if (!$prebuilt_name) {
        $_SESSION['edit-prebuilt'] = "Please enter the name for Prebuilt Desktop";
    } elseif (!$description) {
        $_SESSION['edit-prebuilt'] = "Please enter the description of the prebuilt";
    } elseif (!$chipset) {
        $_SESSION['edit-prebuilt'] = "Please enter the chipset of the prebuilt";
    } elseif (!$status) {
        $_SESSION['edit-prebuilt'] = "Please select a valid status";
    } elseif (!$stock) {
        $_SESSION['edit-prebuilt'] = "Please enter the current stock of the prebuilt desktop";
    } elseif (!$default_price) {
        $_SESSION['edit-prebuilt'] = "Please enter the original price of the prebuilt desktop";
    } elseif (!$price) {
        $_SESSION['edit-prebuilt'] = "Please enter the price of the prebuilt";
    } elseif (!$motherboard) {
        $_SESSION['edit-prebuilt'] = "Please select a motherboard";
    } elseif (!$cpu) {
        $_SESSION['edit-prebuilt'] = "Please select a cpu";
    } elseif (!$gpu) {
        $_SESSION['edit-prebuilt'] = "Please select a gpu";
    } elseif (!$operating_system) {
        $_SESSION['edit-prebuilt'] = "Please select an operation system";
    } elseif (!$ram) {
        $_SESSION['edit-prebuilt'] = "Please select a ram";
    } elseif (!$primary_storage) {
        $_SESSION['edit-prebuilt'] = "Please select a primary_storage";
    } elseif (!$secondary_storage) {
        $secondary_storage = null;
    } elseif (!$power_supply) {
        $_SESSION['edit-prebuilt'] = "Please select a power_supply";
    } elseif (!$desktop_case) {
        $_SESSION['edit-prebuilt'] = "Please select a desktop_case";
    } elseif (!$cooler) {
        $_SESSION['edit-prebuilt'] = "Please select a cooler";
    }
    if (isset($_SESSION['edit-prebuilt'])) {
        header('location: ' . ROOT_URL . 'admin/add_prebuilt.php?id=' . $id . '&config=' . $chipset);
        die();
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/prebuilt/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/products/prebuilt/' . $img_name;

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
                    $_SESSION['edit-prebuilt'] = "img is too large";
                }
            } else {
                $_SESSION['edit-prebuilt'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-prebuilt'])) {
        header('location: ' . ROOT_URL . 'admin/edit_prebuilt.php?id=' . $id . '&config=' . $chipset);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE prebuilt SET 
                        prebuilt_name='$prebuilt_name',
                        img='$img_to_insert',
                        description='$description',
                        os='$operating_system',
                        cpu='$cpu',
                        gpu='$gpu',
                        ram='$ram',
                        primary_storage='$primary_storage',
                        secondary_storage='$secondary_storage',
                        motherboard='$motherboard',
                        desktop_case='$desktop_case',
                        power_supply='$power_supply',
                        default_price='$default_price',
                        price='$price',
                        free_shipping='$free_shipping',
                        status='$status',
                        stock='$stock'
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-prebuilt-success'] = "prebuilt: $prebuilt_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_prebuilt.php');
            die();
        } else {
            $_SESSION['edit-prebuilt'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
