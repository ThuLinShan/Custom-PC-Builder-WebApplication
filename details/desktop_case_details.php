<?php
require '../partials/header.php';
//Get desktop_case data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM desktop_case WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $desktop_case = mysqli_fetch_assoc($result);

        $brand_id = $desktop_case['brand'];
        $query = "SELECT * FROM brand WHERE id=$brand_id";
        $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
    }
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Desktop Case Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Desktop Case Details</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($desktop_case)) : ?>
        <div class="container my-5 p-5 border rounded">
            <div class="row">
                <div class="col-md-5">
                    <img src="<?= ROOT_URL ?>assets/images/products/desktop_case/<?= $desktop_case['img'] ?>" alt="" class="w-100 img-fluid">
                </div>
                <div class="col-md-7 d-flex flex-column justify-content-center align-items-center">
                    <div class="ms-0 ms-md-5 mt-3">
                        <a href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand_id ?>"><img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" width="150px" class="mb-2" alt=""></a>
                        <h3 class="mb-1 text-info-emphasis"><?= $desktop_case['desktop_case_name'] ?></h3>

                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Brand: </p>
                            <span class="fw-normal"><?= $brand['brand_name'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Type: </p>
                            <span class="fw-normal"><?= $desktop_case['type'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Color: </p>
                            <span class="fw-normal"><?= $desktop_case['color'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Cooling: </p>
                            <span class="fw-normal"><?= $desktop_case['cooling'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Dimensions: </p>
                            <span class="fw-normal"><?= $desktop_case['dimensions'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">IO Panel: </p>
                            <span class="fw-normal"><?= $desktop_case['io_panel'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Radiator Support: </p>
                            <span class="fw-normal"><?= $desktop_case['radiator_support'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mb-0 pb-0">
                            <p class="fw-bold mb-1 pb-0">Price: </p>
                            <span class="fw-normal">£ <?= $desktop_case['price'] ?></span>
                        </div>
                        <div class="d-flex justify-content-between gap-3 mt-3 pb-0">
                            <a class="fw-normal btn btn-secondary" href="<?= $desktop_case['link'] ?>">Official Website</a>
                        </div>
                        <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                            <div class="container ms-0 ps-0 mt-2">
                                <a href="<?= ROOT_URL ?>admin/edit_desktop_case.php?id=<?= $id ?>" class="btn btn-dark">Edit</a>
                                <a href="<?= ROOT_URL ?>admin/delete_desktop_case.php?id=<?= $id ?>" class="btn btn-danger">Delete</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No desktop_case found with current id.</h3>
            <p class="mb-1 pb-0">Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>