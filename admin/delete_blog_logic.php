<?php
require 'config/database.php';

if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true && isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

    // Fetch blog
    $query = "SELECT * FROM blog WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $blog = mysqli_fetch_assoc($result);

    // Make sure blog row equal to one
    if (mysqli_num_rows($result) == 1) {
        var_dump($blog);
        $thumbnail_name = $blog['img'];
        $thumbnail_path =  '../assets/images/blogs/' . $thumbnail_name;

        if ($thumbnail_path) {
            unlink($thumbnail_path);
        }
    }

    // Delete blog from database
    $delete_blog_query = "DELETE FROM blog WHERE id=$id";
    $delete_blog_result = mysqli_query($connection, $delete_blog_query);

    if (mysqli_errno($connection)) {
        $_SESSION['delete-blog'] = "Could not delete blog: {$blog['blog_name']}";
    } else {
        $_SESSION['delete-blog-success'] = "blog: {$blog['blog_name']} deleted succesfully";
    }
}

header('location: ' . ROOT_URL . 'admin/index.php');
die();
