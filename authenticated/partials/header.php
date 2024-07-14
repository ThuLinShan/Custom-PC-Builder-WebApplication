<?php
require 'config/database.php';

//Fetch user
if (isset($_SESSION['user-id'])) {
    //Fetch avatar
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $current_user = mysqli_fetch_assoc($result);
    $avatar = $current_user['avatar'];

    $query = "SELECT * FROM cart WHERE userid=$id";
    $result = mysqli_query($connection, $query);
    $cart_items = mysqli_fetch_assoc($result);

    $query = "SELECT COUNT(*) AS count FROM cart WHERE userid=$id and bought=0";
    $result = mysqli_query($connection, $query);
    $assoc = mysqli_fetch_assoc($result);
    $cart_count = $assoc['count'];

    $query = "SELECT * FROM notification WHERE userid=$id";
    $result = mysqli_query($connection, $query);
    $noti_items = mysqli_fetch_assoc($result);

    $query = "SELECT COUNT(*) AS count FROM notification WHERE userid=$id AND status = 0";
    $result = mysqli_query($connection, $query);
    $assoc = mysqli_fetch_assoc($result);
    $noti_count = $assoc['count'];

    $query = "SELECT * FROM cart WHERE userid=$id and bought=0";
    $cart_assocs = mysqli_query($connection, $query);

    $query = "SELECT * FROM notification WHERE userid=$id AND status = 0";
    $noti_assocs = mysqli_query($connection, $query);
} else {
    header('location:' . ROOT_URL . 'signin.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computing Project</title>

    <!-- fevicon -->
    <link rel="shortcut icon" href="<?= ROOT_URL ?>assets/images/logos/fevicon.png" type="image/x-icon">

    <!-- style -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ROOT_URL ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <!-- header start here -->
    <header class="sticky-top shadow">
        <nav class="navbar navbar-expand-lg bg-white px-5" style="font-size: large;">
            <div class="container-fluid">
                <a class="navbar-brand img-fluid" href="<?= ROOT_URL ?>"><img src="<?= ROOT_URL ?>assets/images/logos/logo.png" width="100px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-baseline">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Desktop PCs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/prebuilts.php?page=1&size=8" ?>">Prebuilt PCs</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL ?>/products/custom_builder.php?config=intel">Custom PC builder <span class="badge bg-danger">New</span> </a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laptops
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8" ?>">All Laptops</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8&category='Gaming'" ?>">Gaming Laptops <span class="badge bg-danger">Hot</span> </a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8&category='Office'" ?>">Office Laptops</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8&category='Student'" ?>">Student Laptops <span class="badge bg-success">Sweet</span> </a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8&category='Professional'" ?>">Professional</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blogs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "blogs.php?page=1&size=8" ?>">Discover blogs</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                More
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">About us</a></li>
                                <li><a class="dropdown-item" href="#">Contact us</a></li>
                                <li><a class="dropdown-item" href="#">FAQs</a></li>
                            </ul>
                        </li>

                    </ul>
                    <div class="d-flex" role="search">
                        <?php if (isset($_SESSION['user-id'])) : ?>
                            <div class="nav-item me-2">
                                <!-- notification button -->
                                <button type="button" class="btn btn-outline-dark" id="liveToastBtn"><i class="fa-solid fa-bell"></i>
                                    <?php if ($noti_count > 0) : ?>
                                        <span class="ms-1 badge bg-info">
                                            <?= $noti_count ?>
                                        </span>
                                    <?php endif; ?>
                                </button>
                                <!-- cart button -->
                                <a class="btn btn-outline-dark me-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="fa-solid fa-cart-shopping"></i> <span class="ms-1 badge bg-info"><?= $cart_count ?></span>
                                </a>
                                <!-- profile -->
                                <a href="<?= ROOT_URL ?>authenticated/myaccount.php?id=<?= $id ?>" style="text-decoration: none;">
                                    <img src="<?= ROOT_URL . '/assets/images/avatars/' . $avatar ?>" style="border-radius: 50%; border:solid black 2px; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="50px" height="50px">
                                </a>
                                <a href="<?= ROOT_URL ?>signout.php" style="text-decoration: none;" class="btn btn-outline-dark opacity-75">Logout</a>
                            </div>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>signin.php" class="btn btn-info text-white">Signin</a>
                            </li>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- header end here -->