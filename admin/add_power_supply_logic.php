<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
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
        $time = time();
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
                $_SESSION['add-power_supply'] = "Image size is too large";
            }
        } else {
            $_SESSION['add-power_supply'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-power_supply'])) {
        $_SESSION['add-power_supply-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_power_supply.php');
        die();
    } else {

        $insert_post_query = "INSERT INTO power_supply (
                                power_supply_name,
                                img,
                                brand,
                                modular,
                                pcie,
                                sata,
                                dimension,
                                power,
                                price,
                                link
                                ) VALUES (
                                '$power_supply_name',
                                '$img_name',
                                '$brand',
                                '$modular',
                                '$pcie',
                                '$sata',
                                '$dimension',
                                '$power',
                                '$price',
                                '$link'
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-power_supply-success'] = "New power_supply: $power_supply_name successfully added";
            header('location: ' . ROOT_URL . 'admin/manage_power_supply.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-power_supply-data'] = $_POST;
            $_SESSION['add-power_supply'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_power_supply.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin/add_power_supply.php');
    die();
}
