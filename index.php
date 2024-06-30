<?php
include './partials/header.php';

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//Main banners
$query = "SELECT * FROM banners where type = 'main'";
$main_banners = mysqli_query($connection, $query);
//Second banners
$query = "SELECT * FROM banners where type = 'secondary' and sub_type='main'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) == 1) {
    $secondary_main = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM banners where type = 'secondary' and sub_type='sub'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) == 1) {
    $sub_main = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM banners where type = 'secondary' and sub_type='mini1'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) == 1) {
    $secondary_mini1 = mysqli_fetch_assoc($result);
}

$query = "SELECT * FROM banners where type = 'secondary' and sub_type='mini2'";
$result = mysqli_query($connection, $query);
if (mysqli_num_rows($result) == 1) {
    $secondary_mini2 = mysqli_fetch_assoc($result);
}


$banner_loop = 1;
?>
<!-- main start here -->
<main>
    <div id="carouselExample" class="carousel slide mb-3">
        <div class="carousel-inner">

            <?php while ($banner = mysqli_fetch_assoc($main_banners)) : ?>
                <?php if ($banner_loop == 1) : ?>
                    <div class="carousel-item active">
                    <?php else : ?>
                        <div class="carousel-item">
                        <?php endif ?>
                        <img src="<?= ROOT_URL . 'assets/images/banners/' . $banner['img'] ?>" class="p-md-4 d-block w-100">
                        </div>
                        <?php $banner_loop++; ?>
                    <?php endwhile; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
        </div>

        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6 ">
                    <div>
                        <div class="card border-3 text-center">
                            <img src="<?= ROOT_URL . 'assets/images/banners/' . $secondary_main['img'] ?>" class="card-img" alt="...">
                            <div class="card-img-overlay text-white">
                                <h5 class="card-title bg-info-subtle text-dark p-2 rounded">Card title</h5>
                                <p class="card-text bg-info-subtle text-dark p-2 rounded">This is some text and this is more text.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 gap-3 gap-md-0">
                    <div class="row gap-3 gap-md-0">
                        <div class="col-md-6">
                            <div class="card border-3 text-center">
                                <img src="<?= ROOT_URL . 'assets/images/banners/' . $sub_main['img'] ?>" class="card-img" alt="...">
                                <div class="card-img-overlay text-white">
                                    <h5 class="card-title bg-info-subtle text-dark p-2 rounded">Card title</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="card border-3 text-center">
                                <img src="<?= ROOT_URL . 'assets/images/banners/' . $secondary_mini1['img'] ?>" class="card-img" alt="...">
                                <div class="card-img-overlay text-white">
                                    <h5 class="card-title bg-info-subtle text-dark p-2 rounded">Card title</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="card border-3 text-center">
                            <img src="<?= ROOT_URL . 'assets/images/banners/' . $secondary_mini2['img'] ?>" class="card-img" alt="...">
                            <div class="card-img-overlay text-white">
                                <h5 class="card-title bg-info-subtle text-dark p-2 rounded">Card title</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prebuilt -->
        <div class="container mb-5">
            <div class="mb-2 p-2 bg-dark text-white rounded d-flex align-items-center justify-content-between">
                <h3>
                    Pre-built Desktop PCs
                </h3>
                <a href="./products/prebuilts.php" class="btn btn-sm btn-light" style="box-shadow: 2px 2px 0px red;">Show More</a>
            </div>
            <?php
            // Fetch prebuilts
            $query = "SELECT * FROM prebuilt ORDER BY date LIMIT 4";
            $prebuilts = mysqli_query($connection, $query);
            ?>
            <div class="row">
                <?php while ($prebuilt = mysqli_fetch_assoc($prebuilts)) : ?>
                    <?php
                    if (isset($prebuilt)) {
                        //os
                        $id = $prebuilt['os'];
                        $query = "SELECT operating_system_name FROM operating_system WHERE id = $id";
                        $result = mysqli_query($connection, $query);
                        $os = mysqli_fetch_assoc($result);

                        //cpu
                        $id = $prebuilt['cpu'];
                        $query = "SELECT cpu_name FROM cpu WHERE id = $id";
                        $result = mysqli_query($connection, $query);
                        $cpu = mysqli_fetch_assoc($result);

                        //gpu
                        $id = $prebuilt['gpu'];
                        $query = "SELECT gpu_name FROM gpu WHERE id = $id";
                        $result = mysqli_query($connection, $query);
                        $gpu = mysqli_fetch_assoc($result);

                        //ram
                        $id = $prebuilt['ram'];
                        $query = "SELECT ram_name FROM memory WHERE id = $id";
                        $result = mysqli_query($connection, $query);
                        $ram = mysqli_fetch_assoc($result);
                    }
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card mx-auto" style="width: 18rem;">
                            <img src="<?= ROOT_URL . "assets/images/products/prebuilt/" . $prebuilt['img'] ?>" class="card-img-top">
                            <div class="card-body bg-secondary-subtle">
                                <p class="card-text d-flex justify-content-between">
                                    Price: $<?= $prebuilt['price'] ?>

                                    <!-- Status -->
                                    <?php
                                    $status = $prebuilt['status'];
                                    $bgClass = '';

                                    switch ($status) {
                                        case 'Hot':
                                            $bgClass = 'bg-danger text-white';
                                            break;
                                        case 'Discount':
                                            $bgClass = 'bg-success text-white';
                                            break;
                                        case 'New':
                                            $bgClass = 'bg-white text-dark';
                                            break;
                                        case 'None':
                                            $bgClass = '';
                                            break;
                                    }

                                    if ($status !== 'None') :
                                    ?>
                                        <span class="px-1 rounded <?= $bgClass ?>"><?= $status ?></span>
                                    <?php endif; ?>
                                    <!-- Status end -->
                                </p>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $prebuilt['prebuilt_name'] ?></h5>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item small py-1 border-0"><span class="fw-bold">OS:</span> <?= $os['operating_system_name'] ?></li>
                                <li class="list-group-item small py-1 border-0"><span class="fw-bold">CPU:</span> <?= $cpu['cpu_name'] ?></li>
                                <li class="list-group-item small py-1 border-0"><span class="fw-bold">GPU:</span> <?= $gpu['gpu_name'] ?></li>
                                <li class="list-group-item small py-1 border-0"><span class="fw-bold">RAM:</span> <?= $ram['ram_name'] ?></li>
                            </ul>
                            <div class="card-body">
                                <a href="<?= ROOT_URL . "details/prebuilt_details.php?id=" . $prebuilt['id'] ?>" class="btn rounded-5 btn-outline-info ">Details</a>
                                <a href="<?= ROOT_URL ?>authenticated/add_to_cart_logic.php?product_id=<?= $prebuilt['id'] ?>&category='prebuilt'" class="btn rounded-5 btn-secondary">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        <!-- Prebuilt end -->

        <h3 class="text-center">Services</h3>
        <div class="bg-dark mb-5 py-4">
            <div class="container-fluid">
                <div class="row text-secondary h-100">
                    <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                        <h4 class="fw-light"><i class="fa-solid fa-plane"></i> Fast Shipping</h4>
                    </div>
                    <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                        <h4 class="fw-light"><i class="fa-solid fa-percent"></i> Great Promotion</h4>
                    </div>
                    <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                        <h4 class="fw-light"><i class="fa-solid fa-handshake"></i> Safe Return</h4>
                    </div>
                    <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                        <h4 class="fw-light"> 24/7 Support</h4>
                    </div>
                </div>
            </div>
        </div>


        <!-- Blogs -->
        <?php
        $query = "SELECT * FROM blog ORDER BY date LIMIT 3";
        $blogs =  mysqli_query($connection, $query);
        ?>
        <div class="container my-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Latest Blogs</h2>
                <a href="./blogs.php" class="btn btn-dark py-2 px-4">View All</a>
            </div>
            <div class="row">
                <?php while ($blog = mysqli_fetch_assoc($blogs)) : ?>
                    <?php
                    $author_id = $blog['author'];
                    $query = "SELECT * FROM users WHERE id=$author_id";
                    $result =  mysqli_query($connection, $query);
                    $author = mysqli_fetch_assoc($result);
                    $description = htmlspecialchars_decode($blog['description'], ENT_QUOTES);
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <div class="card mx-auto h-100">
                            <img src="./assets/images/blogs/<?= $blog['img'] ?>" class="card-img-top w-100 img-fluid" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= $blog['header'] ?></h5>
                                <p class="card-text"><?= substr($description, 0, 300) ?>...</p>
                            </div>
                            <div class="card-footer">
                                <a href="./details/blog_details.php?id= <?= $blog['id'] ?>" class="btn btn-info text-white">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Blogs End -->

        <div class="container mb-5">
            <div id="carouselExampleFade" class="carousel border slide py-1 rounded-3">
                <div class="carousel-inner px-1">
                    <div class="carousel-item active">
                        <div style="height: 100px;" class="d-flex justify-content-center text-center align-items-center">
                            <h3>Popular Brands</h3>
                        </div>
                    </div>
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <div class="carousel-item">
                            <a class="text-decoration-none" href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand['id'] ?>">
                                <img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" class="d-block w-100" height="100px" style="object-fit: contain;">
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
                <button class="carousel-control-prev bg-black rounded" style="width: 50px;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next bg-black rounded" style="width: 50px;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
</main>
<!-- main end here -->

<?php
include './partials/footer.php';
?>