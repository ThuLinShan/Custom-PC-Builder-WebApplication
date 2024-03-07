<?php
require '../partials/header.php';
//Get laptop data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM laptop WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $laptop = mysqli_fetch_assoc($result);

        $brand_id = $laptop['brand'];
        $query = "SELECT * FROM brand WHERE id=$brand_id";
        $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
    }
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Laptop Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Laptop Details</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($laptop)) : ?>
        <div class="container my-5 p-5 border rounded">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <img src="<?= ROOT_URL ?>assets/images/products/laptop/<?= $laptop['img'] ?>" alt="" class="w-100 img-fluid">

                    <div class="row mt-3 pb-0">
                        <div class="col-12 mt-2 ms-0 ps-0">
                            <a class="fw-normal btn btn-secondary form-control" href="<?= $laptop['link'] ?>">Official Website</a>
                        </div>

                        <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                            <div class="col-12 ms-0 ps-0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 ">
                                        <a href="<?= ROOT_URL ?>admin/edit_laptop.php?id=<?= $id ?>" class="btn btn-dark form-control mt-2">Edit</a>
                                    </div>
                                    <div class="col-lg-6 col-md-12 ">
                                        <a href="<?= ROOT_URL ?>admin/delete_laptop.php?id=<?= $id ?>" class="btn btn-danger form-control mt-2">Delete</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                </div>
                <div class="col-md-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="ms-0 ms-md-5 mt-3">
                        <a href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand_id ?>"><img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" width="150px" class="mb-2" alt=""></a>
                        <h3 class="mb-1 text-info-emphasis"><?= $laptop['laptop_name'] ?></h3>
                        <p class="mb-3 pb-0 text-info-emphasis"><?= $laptop['description'] ?></p>

                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Brand: </p>
                            <span class="fw-normal"><?= $brand['brand_name'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Category: </p>
                            <span class="fw-normal"><?= $laptop['category'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Operating System: </p>
                            <span class="fw-normal"><?= $laptop['os'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">CPU: </p>
                            <span class="fw-normal"><?= $laptop['cpu'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">GPU: </p>
                            <span class="fw-normal"><?= $laptop['gpu'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Memory: </p>
                            <span class="fw-normal"><?= $laptop['ram'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Primary Storage: </p>
                            <span class="fw-normal"><?= $laptop['primary_storage'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Secondary Storage: </p>
                            <span class="fw-normal"><?= $laptop['secondary_storage'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">I/O ports: </p>
                            <span class="fw-normal"><?= $laptop['io_ports'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Internet: </p>
                            <span class="fw-normal"><?= $laptop['internet'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Display: </p>
                            <span class="fw-normal"><?= $laptop['display'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Battery: </p>
                            <span class="fw-normal"><?= $laptop['battery'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Dimensions: </p>
                            <span class="fw-normal"><?= $laptop['dimensions'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Bonus: </p>
                            <span class="fw-normal"><?= $laptop['bonus'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Free shipping: </p>
                            <?php if ($laptop['free_shipping'] == 1) : ?>
                                <span class="fw-normal">Yes</span>
                            <?php else : ?>
                                <span class="fw-normal">No</span>
                            <?php endif ?>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Rating: </p>
                            <span class="fw-normal"><?= $laptop['rating'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-3 pb-0">
                            <p class="fw-bold mb-1 pb-0">Price: </p>
                            <span class="fw-normal">£ <?= $laptop['price'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No laptop found with current id.</h3>
            <p class="mb-1 pb-0">Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>