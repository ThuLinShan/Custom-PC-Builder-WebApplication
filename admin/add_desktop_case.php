<?php
require 'partials/header.php';

//get back form data if anything went wrong
$desktop_case_name = $_SESSION['add-desktop_case-data']['desktop_case_name'] ?? null;
$color = $_SESSION['add-desktop_case-data']['color'] ?? null;
$cooling = $_SESSION['add-desktop_case-data']['cooling'] ?? null;
$dimensions = $_SESSION['add-desktop_case-data']['dimensions'] ?? null;
$io_panel = $_SESSION['add-desktop_case-data']['io_pan$io_panel'] ?? null;
$radiator_support = $_SESSION['add-desktop_case-data']['io_pan$radiator_support'] ?? null;
$price = $_SESSION['add-desktop_case-data']['price'] ?? null;
$link = $_SESSION['add-desktop_case-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-desktop_case-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add desktop_case</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add desktop_case</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add desktop_case</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-desktop_case'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-desktop_case'];
                    unset($_SESSION['add-desktop_case']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_desktop_case_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("Components", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="desktop_case_name" value="<?= $desktop_case_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <select name="type" id="" class="mb-3 form-select">
                    <option value="Mini Tower">Mini Tower</option>
                    <option value="Mid Tower">Mid Tower</option>
                    <option value="Full Tower">Full Tower</option>
                </select>

                <label for="">Color</label>
                <input name="color" value="<?= $color ?>" class="mb-3 form-control" type="text" placeholder="Color" required>

                <label for="">Cooling Support</label>
                <input name="cooling" value="<?= $cooling ?>" class="mb-3 form-control" type="text" step=".1" placeholder="Cooling Support" required>

                <label for="">Dimensions</label>
                <input name="dimensions" value="<?= $dimensions ?>" class="mb-3 form-control" type="text" placeholder="Dimensions" required>

                <label for="">IO Panel</label>
                <input name="io_panel" value="<?= $io_panel ?>" class="mb-3 form-control" type="text" placeholder="IO Panel" required>

                <label for="">Radiator Support</label>
                <input name="radiator_support" value="<?= $radiator_support ?>" class="mb-3 form-control" type="text" placeholder="Radiator Support" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $price ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $link ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>

</main>

<?php
require './partials/footer.php';
?>