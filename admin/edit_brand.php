<?php
require 'partials/header.php';
//Get brand data with id
if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM brand WHERE id=$id";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) == 1) {
        $brand = mysqli_fetch_assoc($result);
    }
}
?>


<main>

    <div class="row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0" style="background-color: #2c2f31;">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Brand</li>
            </ol>
        </nav>
    </div>

    <?php if (isset($_GET['id']) && isset($brand)) : ?>
        <div class="container mt-5 pb-5">
            <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
                <h3>Edit Brand</h3>
            </div>
            <!-- alet message -->
            <?php if (isset($_SESSION['edit-brand'])) : ?>
                <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                    <h3>
                        <?= $_SESSION['edit-brand'];
                        unset($_SESSION['edit-brand']);
                        ?>
                    </h3>
                </div>
            <?php endif ?>
            <!-- alert message end -->

            <?php if (isset($brand)) : ?>
                <div>
                    <form action="<?= ROOT_URL ?>admin/edit_brand_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                        <input type="hidden" value="<?= $brand['id'] ?>" name="id">
                        <input name="brand_name" value="<?= $brand['brand_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                        <!-- Previous Thumbnail -->
                        <input type="hidden" value="<?= $brand['img'] ?>" name="previous_img_name">
                        <label for="img">Choose an image</label>
                        <input name="img" class="mb-3 form-control" id="img" type="file">

                        <div class="py-3">
                            <label class="text-info-emphasis fw-bolder">Main Products</label>
                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="desktops" value="Desktops " />
                                <label class="ms-2" for="desktops">Desktops</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="laptops" value="Laptops " />
                                <label class="ms-2" for="laptops">Laptops</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="motherboard" value="Motherboard " />
                                <label class="ms-2" for="motherboard">Motherboard</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="cpu" value="GPU " />
                                <label class="ms-2" for="cpu">GPU</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="cpu" value="CPU " />
                                <label class="ms-2" for="cpu">CPU</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="components" value="Components " />
                                <label class="ms-2" for="components">Components</label>
                            </div>

                            <div class="d-flex">
                                <input class="form-check" type="checkbox" name="products[]" id="case" value="Cases " />
                                <label class="ms-2" for="case">Cases</label>
                            </div>
                        </div>


                        <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $brand['description'] ?></textarea>

                        <input name="link" value="<?= $brand['link'] ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                        <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
                    </form>
                </div>
            <?php else : ?>
                <div class="text-center ">
                    <p>Unavailable Brand</p>
                </div>
            <?php endif ?>


        <?php else : ?>
            <div class="container my-5 py-5 text-danger text-center">
                <h3>No brand found with current id.</h3>
                <p>Please check the url and try again</p>
            </div>
        <?php endif ?>

        </div>


</main>

<?php
require './partials/footer.php';
?>