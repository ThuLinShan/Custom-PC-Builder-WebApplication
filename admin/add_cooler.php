<?php
require 'partials/header.php';

//get back form data if anything went wrong
$cooler_name = $_SESSION['add-cooler-data']['cooler_name'] ?? null;
$type = $_SESSION['add-cooler-data']['type'] ?? null;
$fan_speed = $_SESSION['add-cooler-data']['fan_$fan_speed'] ?? null;
$power = $_SESSION['add-cooler-data']['power'] ?? null;
$radiator_dimension = $_SESSION['add-cooler-data']['radi$radiator_dimension'] ?? null;
$tube_length = $_SESSION['add-cooler-data']['tub$tube_length'] ?? null;
$price = $_SESSION['add-cooler-data']['price'] ?? null;
$link = $_SESSION['add-cooler-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-cooler-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add Cooler</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Cooler</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add Cooler</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-cooler'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-cooler'];
                    unset($_SESSION['add-cooler']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_cooler_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
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

                <input name="cooler_name" value="<?= $cooler_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">Type</label>
                <input name="type" value="<?= $type ?>" class="mb-3 form-control" type="text" placeholder="Type" required>

                <label for="">Fan Speed (rpm)</label>
                <input name="fan_speed" value="<?= $fan_speed ?>" class="mb-3 form-control" type="number" placeholder="Fan Speed" required>

                <label for="">Power (Watt)</label>
                <input name="power" value="<?= $power ?>" class="mb-3 form-control" type="number" placeholder="Power" required>

                <label for="">Radiator Dimension</label>
                <input name="radiator_dimension" value="<?= $radiator_dimension ?>" class="mb-3 form-control" type="text" placeholder="Radiator Dimension" required>

                <label for="">Tube Length(mm)</label>
                <input name="tube_length" value="<?= $tube_length ?>" class="mb-3 form-control" type="number" placeholder="Tube Length" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $price ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <label for="">Link</label>
                <input name="link" value="<?= $link ?>" class="mb-3 form-control" type="text" placeholder="Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Add</button>
            </form>
        </div>
    </div>

</main>

<?php
require './partials/footer.php';
?>