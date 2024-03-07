<?php
require 'partials/header.php';

//get back form data if anything went wrong
$brand = $_SESSION['brand-data']['brand_name'] ?? null;
$description = $_SESSION['brand-data']['description'] ?? null;
$link = $_SESSION['brand-data']['link'] ?? null;

//delete from data session  
unset($_SESSION['brand-data']);
?>


<main>

    <div class="row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0" style="background-color: #2c2f31;">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Brand</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add Brand</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-brand'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-brand'];
                    unset($_SESSION['add-brand']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->


        <div>
            <form action="./add_brand_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <input name="brand_name" value="<?= $brand ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

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

                    <div class="d-flex">
                        <input class="form-check" type="checkbox" name="products[]" id="operating_system" value="operating_system " />
                        <label class="ms-2" for="operating_system">Operating System</label>
                    </div>
                </div>


                <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

                <input name="link" value="<?= $link ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>


</main>

<?php
require './partials/footer.php';
?>