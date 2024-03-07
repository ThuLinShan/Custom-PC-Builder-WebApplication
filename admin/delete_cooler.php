<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch cooler
    $query = "SELECT * FROM cooler WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $cooler = mysqli_fetch_assoc($result);

    // Make sure cooler row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($cooler);
        $thumbnail_name = $cooler['img'];
        $thumbnail_path =  '../assets/images/products/cooler/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete cooler from database
    $delete_cooler_query = "DELETE FROM cooler WHERE id=$id";
    $delete_cooler_result = mysqli_query($connection, $delete_cooler_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-cooler'] = "Could not delete cooler: {$cooler['cooler_name']}";
    } else {
        $_SESSION['delete-cooler-success'] = "cooler: {$cooler['cooler_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_cooler.php');
die();
