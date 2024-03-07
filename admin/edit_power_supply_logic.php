<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    // Get form data
    $id                 = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $previous_img_name  = filter_var($_POST['previous_img_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $power_supply_name   = filter_var($_POST['power_supply_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_var($_POST['brand'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $img                = $_FILES['img'];
    $modular = filter_var($_POST['modular'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $dimension = filter_var($_POST['dimension'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pcie = filter_var($_POST['pcie'], FILTER_SANITIZE_NUMBER_INT);
    $sata = filter_var($_POST['sata'], FILTER_SANITIZE_NUMBER_INT);
    $power = filter_var($_POST['power'], FILTER_SANITIZE_NUMBER_INT);
    $price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
    $link               = filter_var($_POST['link'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    if (!$power_supply_name) {
        $_SESSION['add-power_supply'] = "Please enter a power_supply_name";
    } elseif (!$brand) {
        $_SESSION['add-power_supply'] = "Please select the brand for the power_supply";
    } elseif (!$pcie) {
        $_SESSION['add-power_supply'] = "Please enter the total number of PCIe slots in the power_supply";
    } elseif (!$dimension) {
        $_SESSION['add-power_supply'] = "Please enter the physical dimension of the power_supply";
    } elseif (!$power) {
        $_SESSION['add-power_supply'] = "Please enter the power consumption of the power_supply in Watt";
    } elseif (!$price) {
        $_SESSION['add-power_supply'] = "Please enter the price of the power_supply";
    } elseif (!$link) {
        $_SESSION['add-power_supply'] = "Please enter the official link of the power_supply";
    } else {
        // Delete existing img if new one is uploaded
        if ($img['name']) {
            $previous_img_name = '../assets/images/products/powersupply/' . $previous_img_name;
            if ($previous_img_name) {
                unlink($previous_img_name);
            }

            // Rename img file
            $time = time(); // Time as unique identifier
            $img_name = $time . $img['name'];
            $img_tmp_name = $img['tmp_name'];
            $img_destination_path = '../assets/images/products/powersupply/' . $img_name;

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
                    $_SESSION['edit-power_supply'] = "img is too large";
                }
            } else {
                $_SESSION['edit-power_supply'] = "Please add a valid image file";
            }
        }
    }

    // Return if validation fails
    if (isset($_SESSION['edit-power_supply'])) {
        header('location: ' . ROOT_URL . 'admin/edit_power_supply.php?id=' . $id);
        die();
    } else {

        $img_to_insert = $img_name ?? $previous_img_name;

        $query =    "UPDATE power_supply SET 
                    power_supply_name='$power_supply_name', 
                    img='$img_to_insert', 
                    brand = '$brand',
                    modular='$modular',
                    pcie='$pcie',
                    sata='$sata',
                    dimension='$dimension',
                    power = '$power',
                    price='$price',
                    link='$link' 
                    WHERE id=$id ";

        $result = mysqli_query($connection, $query);

        if (!mysqli_errno($connection)) {
            $_SESSION['edit-power_supply-success'] = "power_supply: $power_supply_name successfully updated";
            header('location: ' . ROOT_URL . 'admin/manage_power_supply.php');
            die();
        } else {
            $_SESSION['edit-power_supply'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/index.php');
    die();
}
