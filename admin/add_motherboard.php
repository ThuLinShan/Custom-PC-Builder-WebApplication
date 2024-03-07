<?php
require 'partials/header.php';

//get back form data if anything went wrong
$motherboard = $_SESSION['add-motherboard-data']['motherboard_name'] ?? null;
$description = $_SESSION['add-motherboard-data']['description'] ?? null;
$chipset_name = $_SESSION['add-motherboard-data']['chipset_name'] ?? null;
$ram_slots = $_SESSION['add-motherboard-data']['ram_slots'] ?? null;
$price = $_SESSION['add-motherboard-data']['price'] ?? null;
$link = $_SESSION['add-motherboard-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-motherboard-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Motherboard</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add Motherboard</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-motherboard'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-motherboard'];
                    unset($_SESSION['add-motherboard']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_motherboard_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("Motherboard", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input value="<?= $motherboard ?>" name="motherboard_name" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="chipset">Chipset</label>
                <select class="form-select mb-3" name="chipset" id="chipset">
                    <option value="AMD">AMD</option>
                    <option value="Intel">Intel</option>
                </select>

                <input value="<?= $chipset_name ?>" name="chipset_name" class="mb-3 form-control" type="text" placeholder="Chipset name" required>

                <label for="chipset">Form Factor</label>
                <select class="form-control mb-3" name="form_factor" id="form_factor">
                    <option value="Mini ITX">Mini ITX</option>
                    <option value="Micro ATX">Micro ATX</option>
                    <option value="ATX">ATX</option>
                    <option value="E-ATX">E-ATX</option>
                </select>

                <input value="<?= $ram_slots ?>" name="ram_slots" class="mb-3 form-control" type="number" placeholder="Ram Slots" required>

                <input value="<?= $price ?>" name="price" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input value="<?= $link ?>" name="link" value="<?= $link ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>

</main>

<?php
require './partials/footer.php';
?>