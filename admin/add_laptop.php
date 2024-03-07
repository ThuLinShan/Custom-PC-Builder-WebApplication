<?php
require 'partials/header.php';

//get back form data if anything went wrong
$laptop_name = $_SESSION['add-laptop-data']['laptop_name'] ?? null;
$os = $_SESSION['add-laptop-data']['os'] ?? null;
$cpu = $_SESSION['add-laptop-data']['cpu'] ?? null;
$gpu = $_SESSION['add-laptop-data']['gpu'] ?? null;
$ram = $_SESSION['add-laptop-data']['ram'] ?? null;
$primary_storage = $_SESSION['add-laptop-data']['primary_storage'] ?? null;
$secondary_storage = $_SESSION['add-laptop-data']['secondary_storage'] ?? null;
$io_ports = $_SESSION['add-laptop-data']['io_ports'] ?? null;
$internet = $_SESSION['add-laptop-data']['internet'] ?? null;
$display = $_SESSION['add-laptop-data']['display'] ?? null;
$battery = $_SESSION['add-laptop-data']['battery'] ?? null;
$dimensions = $_SESSION['add-laptop-data']['dimensions'] ?? null;
$bonus = $_SESSION['add-laptop-data']['bonus'] ?? null;
$description = $_SESSION['add-laptop-data']['description'] ?? null;
$stock = $_SESSION['add-laptop-data']['stock'] ?? null;
$price = $_SESSION['add-laptop-data']['price'] ?? null;
$link = $_SESSION['add-laptop-data']['link'] ?? null;

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

//delete from data session  
unset($_SESSION['add-laptop-data']);
?>


<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Add laptop</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Add Laptop</li>
            </ol>
        </nav>

    </div>

    <div class="container mt-5 pb-5">
        <div class="py-4 px-3 d-flex flex-column align-items-center justify-content-center">
            <h3>Add Laptop</h3>
        </div>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-laptop'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-laptop'];
                    unset($_SESSION['add-laptop']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <!-- alert message end -->

        <div>
            <form action="./add_laptop_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <a href="<?= ROOT_URL ?>admin/add_brand.php">Add new brand</a>
                <select class="form-select mb-3" name="brand">
                    <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                        <?php
                        $products = explode(' ', $brand['products']);
                        ?>
                        <?php if (in_array("Laptops", $products)) : ?>
                            <option value="<?= $brand['id'] ?>"><?= $brand['brand_name'] ?></option>
                        <?php endif ?>
                    <?php endwhile; ?>
                </select>

                <input name="laptop_name" value="<?= $laptop_name ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file" required>

                <label for="">Category</label>
                <select class="form-select mb-3" name="category">
                    <option value="Gaming">Gaming</option>
                    <option value="Office">Office</option>
                    <option value="Professional">Professional</option>
                    <option value="Student">Student</option>
                </select>

                <label for="">Operating System</label>
                <input name="os" value="<?= $os ?>" class="mb-3 form-control" type="text" placeholder="OS" required>

                <label for="">CPU</label>
                <input name="cpu" value="<?= $cpu ?>" class="mb-3 form-control" type="text" placeholder="CPU" required>

                <label for="">GPU</label>
                <input name="gpu" value="<?= $gpu ?>" class="mb-3 form-control" type="text" placeholder="GPU" required>

                <label for="">RAM</label>
                <input name="ram" value="<?= $ram ?>" class="mb-3 form-control" type="text" placeholder="RAM" required>

                <label for="">Primary Storage</label>
                <input name="primary_storage" value="<?= $primary_storage ?>" class="mb-3 form-control" type="text" placeholder="Primary Storage" required>

                <label for="">Secondary Storage</label>
                <input name="secondary_storage" value="<?= $secondary_storage ?>" class="mb-3 form-control" type="text" placeholder="Secondary Storage">

                <label for="">I/O ports</label>
                <input name="io_ports" value="<?= $io_ports ?>" class="mb-3 form-control" type="text" placeholder="I/O ports" required>

                <label for="">Internet</label>
                <input name="internet" value="<?= $internet ?>" class="mb-3 form-control" type="text" placeholder="Internet" required>

                <label for="">Display</label>
                <input name="display" value="<?= $display ?>" class="mb-3 form-control" type="text" placeholder="Display" required>

                <label for="">Battery</label>
                <input name="battery" value="<?= $battery ?>" class="mb-3 form-control" type="text" placeholder="Battery" required>

                <label for="">Dimensions</label>
                <input name="dimensions" value="<?= $dimensions ?>" class="mb-3 form-control" type="text" placeholder="Dimensions" required>

                <label for="">Bonus</label>
                <input name="bonus" value="<?= $bonus ?>" class="mb-3 form-control" type="text" placeholder="Bonus">

                <label for="">Stock</label>
                <input name="stock" value="<?= $stock ?>" class="mb-3 form-control" type="text" placeholder="Stock">

                <label class="">Free Shipping</label>
                <input name="free_shipping" class="mb-3 form-check" type="checkbox" value="1">

                <label for="">Description</label>
                <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $description ?></textarea>

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