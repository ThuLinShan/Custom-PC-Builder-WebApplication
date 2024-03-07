<?php
require '../partials/header.php';
//Get cpu data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM cpu WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $cpu = mysqli_fetch_assoc($result);

        $brand_id = $cpu['brand'];
        $query = "SELECT * FROM brand WHERE id=$brand_id";
        $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
    }
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">CPU Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">CPU Details</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($cpu)) : ?>
        <div class="container my-5 p-5 border rounded">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <img src="<?= ROOT_URL ?>assets/images/products/cpu/<?= $cpu['img'] ?>" alt="" class="w-100 img-fluid">
                </div>
                <div class="col-md-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="ms-0 ms-md-5 mt-3">
                        <a href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand_id ?>"><img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" width="150px" class="mb-2" alt=""></a>
                        <h3 class="mb-1 text-info-emphasis"><?= $cpu['cpu_name'] ?></h3>
                        <p class="mb-3 pb-0 text-info-emphasis"><?= $cpu['description'] ?></p>

                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Brand: </p>
                            <span class="fw-normal"><?= $brand['brand_name'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Generation: </p>
                            <span class="fw-normal"><?= $cpu['generation'] ?>th Gen</span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Frequency: </p>
                            <span class="fw-normal"><?= $cpu['frequency'] ?> GHz</span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Cores: </p>
                            <span class="fw-normal"><?= $cpu['cores'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Threads: </p>
                            <span class="fw-normal"><?= $cpu['threads'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Power: </p>
                            <span class="fw-normal"><?= $cpu['power'] ?> Watt</span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Price: </p>
                            <span class="fw-normal">£ <?= $cpu['price'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mt-3 pb-0">
                            <a class="fw-normal btn btn-secondary" href="<?= $cpu['link'] ?>">Official Website</a>
                        </div>

                        <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                            <div class="container ms-0 ps-0 mt-2">
                                <a href="<?= ROOT_URL ?>admin/edit_cpu.php?id=<?= $id ?>" class="btn btn-dark">Edit</a>
                                <a href="<?= ROOT_URL ?>admin/delete_cpu.php?id=<?= $id ?>" class="btn btn-danger">Delete</a>
                            </div>
                        <?php endif ?>

                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No cpu found with current id.</h3>
            <p class="mb-1 pb-0">Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>