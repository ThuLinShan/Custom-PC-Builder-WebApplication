<?php
require 'config/database.php';

if (isset($_POST['submit']) && isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) {
    $header    = filter_var($_POST['header'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description   = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_featured    = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $author = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $img           = $_FILES['img'];


    //Set is_featured to 0 if unchecked
    $is_featured = $is_featured == 1 ?: 0;


    if (!$header) {
        $_SESSION['add-blog'] = "Please enter a header";
    } elseif (!$description) {
        $_SESSION['add-blog'] = "Please enter blog description";
    } elseif (!$img['name']) {
        $_SESSION['add-blog'] = "Please add an img";
    } else {
        $time = time();
        $img_name = $time . $img['name'];
        $img_tmp_name = $img['tmp_name'];
        $img_destination_path = '../assets/images/blogs/' . $img_name;

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
                $_SESSION['add-blog'] = "img is too large";
            }
        } else {
            $_SESSION['add-blog'] = "Please add a valid image file";
        }
    }

    if (isset($_SESSION['add-blog'])) {
        $_SESSION['add-blog-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add_blog.php');
        die();
    } else {

        if ($is_featured == 1) {
            $update_post_query = "UPDATE blog SET is_featured = 0 WHERE is_featured = 1";
            $update_post_result = mysqli_query($connection, $update_post_query);
        }

        $insert_post_query = "INSERT INTO blog (
                                header,
                                description,
                                img,
                                is_featured,
                                author
                                ) VALUES (
                                '$header',
                                '$description',
                                '$img_name',
                                $is_featured,
                                $author
                                )";
        $insert_post_result = mysqli_query($connection, $insert_post_query);

        if (!mysqli_errno($connection)) {
            // Redirect to manage posts page
            $_SESSION['add-blog-success'] = "New blog: $header successfully added";
            header('location: ' . ROOT_URL . 'admin/index.php');
            die();
        } else {
            // Return form data back to add post page
            $_SESSION['add-blog-data'] = $_POST;
            $_SESSION['add-blog'] = "Something went wrong";
            header('location: ' . ROOT_URL . 'admin/add_blog.php');
            die();
        }
    }
} else {
    header('location: ' . ROOT_URL . 'admin.php');
    die();
}
