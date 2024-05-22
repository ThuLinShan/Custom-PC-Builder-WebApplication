<?php
require 'config/database.php';
//Fetch user
if (isset($_SESSION['user-id'])) {
    //Fetch avatar
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT avatar FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $avatar = mysqli_fetch_assoc($result);
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
    <header>

        <div class="alert alert-info alert-dismissible fade show " role="alert" style="background-image:url(<?= ROOT_URL ?>assets/images/banners/promotional-bg.png); background-repeat:repeat; background-color:#0c4174; color:#fff; padding:18px 0; margin:0; line-height:24px; font-size:17px; text-transform:uppercase; text-align:center; ">
            <strong>Holy guacamole!</strong>
            <span>You should check in on some of those fields below.</span>
            <button type="button" class="btn-close bg-white p-2 mt-3 me-2 rounded-5" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

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
                                <li><a class="dropdown-item" href="#">Custom PC builder <span class="badge bg-danger">New</span> </a></li>

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Laptops
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= ROOT_URL . "products/laptops.php?page=1&size=8" ?>">Gaming Laptops</a></li>
                                <li><a class="dropdown-item" href="#">Office use</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Budget Laptops</a></li>
                                <li><a class="dropdown-item" href="#">Most popular ones</a></li>
                                <li><a class="dropdown-item" href="#">Budget Laptops <span class="badge bg-danger">Hot</span> </a></li>
                                <li><a class="dropdown-item" href="#">Promotions <span class="badge bg-danger">Hot</span> </a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Blogs
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">My blogs</a></li>
                                <li><a class="dropdown-item" href="#">Discover blogs</a></li>
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

                        <?php if (isset($_SESSION['user-id'])) : ?>
                            <li class="nav-item me-2">
                                <!-- notification button -->
                                <button type="button" class="btn btn-outline-dark" id="liveToastBtn"><i class="fa-solid fa-bell"></i><span class="ms-1 badge bg-info">5</span></button>
                                <!-- cart button -->
                                <a class="btn btn-outline-dark me-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                                    <i class="fa-solid fa-cart-shopping"></i> <span class="ms-1 badge bg-info">5</span>
                                </a>
                                <!-- profile -->
                                <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                                    <a href="<?= ROOT_URL ?>admin" style="text-decoration: none;">
                                        <img src="<?= ROOT_URL . '/assets/images/avatars/' . $avatar['avatar'] ?>" style="border-radius: 50%; border:solid black 2px; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="50px" height="50px">
                                    </a>
                                <?php else : ?>
                                    <a href="<?= ROOT_URL ?>authenticated/myaccount.php?id=<?= $id ?>" style="text-decoration: none;">
                                        <img src="<?= ROOT_URL . '/assets/images/avatars/' . $avatar['avatar'] ?>" style="border-radius: 50%; border:solid black 2px; padding:2px; overflow:hidden;object-fit: cover;" alt="" width="50px" height="50px">
                                    </a>
                                <?php endif ?>
                                <a href="<?= ROOT_URL ?>signout.php" style="text-decoration: none;" class="btn btn-outline-dark opacity-75">Logout</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= ROOT_URL ?>signin.php" class="btn btn-info text-white">Signin</a>
                            </li>
                        <?php endif ?>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-info text-white" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <!-- header end here -->