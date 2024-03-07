<?php
require '../partials/header.php';
//Get brand data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM brand WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $brand = mysqli_fetch_assoc($result);
}
?>

<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Brand Details</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">brand Details</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($brand)) : ?>
        <div class="container my-5 p-5 border rounded">
            <div class="row">
                <div class="col-md-5">
                    <img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" alt="" class="w-100 img-fluid">
                </div>
                <div class="col-md-7 d-flex justify-content-center">
                    <div class="mt-3">
                        <h3 class="mb-3 text-info-emphasis"><?= $brand['brand_name'] ?></h3>

                        <?php $products = explode(" ", $brand['products']);
                        ?>
                        <div class="d-flex mb-3 ">
                            <?php foreach ($products as $product) : ?>
                                <span class="bg-secondary-subtle text-info-emphasis p-1 rounded"><?= $product ?></span>
                            <?php endforeach ?>
                        </div>

                        <p class="d-flex gap-3 mb-3 pb-0">
                            <?= $brand['description'] ?>
                        </p>

                        <a href="<?= $brand['link'] ?>" class="btn btn-secondary">Official Link</a>


                        <?php if (isset($_SESSION['user_is_admin']) && $_SESSION['user_is_admin'] == true) : ?>
                            <div class="container ms-0 ps-0 mt-2">
                                <a href="<?= ROOT_URL ?>admin/edit_brand.php?id=<?= $id ?>" class="btn btn-dark">Edit</a>
                                <a href="<?= ROOT_URL ?>admin/delete_brand.php?id=<?= $id ?>" class="btn btn-danger">Delete</a>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No brand found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
require '../partials/footer.php';
?>