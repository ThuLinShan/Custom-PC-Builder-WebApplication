<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch desktop_case
    $query = "SELECT * FROM desktop_case WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $desktop_case = mysqli_fetch_assoc($result);

    // Make sure desktop_case row equal to one
    if (mysqli_num_rows($result) == 1) {
        $thumbnail_name = $desktop_case['img'];
        $thumbnail_path =  '../assets/images/products/desktop_case/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }

        // Delete desktop_case from database
        $delete_desktop_case_query = "DELETE FROM desktop_case WHERE id=$id";
        $delete_desktop_case_result = mysqli_query($connection, $delete_desktop_case_query);

        if (mysqli_errno($connection)) {
            $_SESSION['delete-desktop_case'] = "Could not delete desktop_case: {$desktop_case['desktop_case_name']}";
        } else {
            $_SESSION['delete-desktop_case-success'] = "desktop_case: {$desktop_case['desktop_case_name']} deleted succesfully";
        }
    }
}

header('location: ' . ROOT_URL . 'admin/manage_desktop_case.php');
die();
