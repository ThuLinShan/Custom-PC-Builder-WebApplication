<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch cpu
    $query = "SELECT * FROM cpu WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $cpu = mysqli_fetch_assoc($result);

    // Make sure cpu row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($cpu);
        $thumbnail_name = $cpu['img'];
        $thumbnail_path =  '../assets/images/products/cpu/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete cpu from database
    $delete_cpu_query = "DELETE FROM cpu WHERE id=$id";
    $delete_cpu_result = mysqli_query($connection, $delete_cpu_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-cpu'] = "Could not delete cpu: {$cpu['cpu_name']}";
    } else {
        $_SESSION['delete-cpu-success'] = "cpu: {$cpu['cpu_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/manage_cpu.php');
die();
