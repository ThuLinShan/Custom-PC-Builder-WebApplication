<?php
include '../partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM motherboard WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $motherboard = mysqli_fetch_assoc($result);

    // Fetch brands from database
    $query = "SELECT * FROM brand";
    $brands = mysqli_query($connection, $query);
}
?>
<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Admin</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="../index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item"><a href="./" class="text-secondary">Admin Dashboard</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Motherboard</li>
            </ol>
        </nav>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['edit-motherboard'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['edit-motherboard'];
                unset($_SESSION['edit-motherboard']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <?php if (isset($_GET['id']) && isset($motherboard)) : ?>
        <div class="container my-5">
            <form action="./edit_motherboard_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <!-- hidden id -->
                <input type="hidden" value="<?= $motherboard['id'] ?>" name="id">
                <!-- Previous Thumbnail -->
                <input type="hidden" value="<?= $motherboard['img'] ?>" name="previous_img_name">

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

                <input name="motherboard_name" value="<?= $motherboard['motherboard_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file">

                <label for="chipset">Chipset</label>
                <select class="form-select mb-3" name="chipset" id="chipset">
                    <option value="AMD">AMD</option>
                    <option value="Intel">Intel</option>
                </select>

                <input name="chipset_name" value="<?= $motherboard['chipset_name'] ?>" class="mb-3 form-control" type="text" placeholder="Chipset name" required>

                <label for="form_factor">Form Factor</label>
                <select class="form-control mb-3" name="form_factor" id="form_factor">
                    <option value="Mini ITX">Mini ITX</option>
                    <option value="Micro ATX">Micro ATX</option>
                    <option value="ATX">ATX</option>
                    <option value="E-ATX">E-ATX</option>
                </select>

                <label for="">Ram Slots</label>
                <input name="ram_slots" value="<?= $motherboard['ram_slots'] ?>" class="mb-3 form-control" type="number" placeholder="Ram Slots" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $motherboard['price'] ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $motherboard['link'] ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No motherboard found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
include '../partials/footer.php';
?>