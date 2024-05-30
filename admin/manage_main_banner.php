<?php
include './partials/header.php';

// Fetch banners
$query = "SELECT * FROM banners WHERE type = 'main' ORDER BY date";
$banners = mysqli_query($connection, $query);

$brand;
$brand_id;
?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage Main Banners</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage banners</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded shadow-sm">
            <div class="col-md-6 ">
                <h3>Recommended: 1200x500</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_banner.php?type=main">Add new banner</a>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['delete-banner'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-banner'];
                    unset($_SESSION['delete-banner']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-banner-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-banner-success'];
                    unset($_SESSION['delete-banner-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-banner-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-banner-success'];
                    unset($_SESSION['add-banner-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-banner-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-banner-success'];
                    unset($_SESSION['edit-banner-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <?php if (mysqli_num_rows($banners) > 0) : ?>
            <?php while ($banner = mysqli_fetch_assoc($banners)) : ?>
                <div class="container my-5">
                    <div class="row my-2">
                        <div class="col-md-6">
                            <img src="<?= ROOT_URL . 'assets/images/banners/' . $banner['img'] ?>" class="img-fluid mx-auto" width="96%" alt="">
                        </div>
                        <div class="col-md-6 py-3">
                            <div>
                                <h4><?= $banner['description'] ?></h4>
                                <p><?= $banner['date'] ?></p>
                            </div>
                            <div>
                                <a class="btn btn-danger" href="./delete_banner_logic.php?id=<?= $banner['id'] ?>">Delete</a>
                                <a class="btn btn-secondary" href="./edit_banner.php?id=<?= $banner['id'] ?>">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No banners found" </h4>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>