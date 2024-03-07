<?php
include '../partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM power_supply WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $power_supply = mysqli_fetch_assoc($result);

    // Fetch power_supply from database
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
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit Power Supply Unit</li>
            </ol>
        </nav>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['edit-power_supply'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['edit-power_supply'];
                unset($_SESSION['edit-power_supply']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <?php if (isset($_GET['id']) && isset($power_supply)) : ?>
        <div class="container my-5">
            <form action="./edit_power_supply_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <!-- hidden id -->
                <input type="hidden" value="<?= $power_supply['id'] ?>" name="id">
                <!-- Previous Thumbnail -->
                <input type="hidden" value="<?= $power_supply['img'] ?>" name="previous_img_name">

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

                <input name="power_supply_name" value="<?= $power_supply['power_supply_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file">

                <label for="">Dimension</label>
                <input name="dimension" value="<?= $power_supply['dimension'] ?>" class="mb-3 form-control" type="text" placeholder="Dimension" required>

                <label for="">Modular</label>
                <select name="modular" class="mb-3 form-select" id="">
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>

                <label for="">PCIe</label>
                <input name="pcie" value="<?= $power_supply['pcie'] ?>" class="mb-3 form-control" type="number" placeholder="PCIe" required>

                <label for="">SATA</label>
                <input name="sata" value="<?= $power_supply['sata'] ?>" class="mb-3 form-control" type="number" placeholder="SATA" required>

                <label for="">Power (Watt)</label>
                <input name="power" value="<?= $power_supply['power'] ?>" class="mb-3 form-control" type="number" placeholder="Power" required>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $power_supply['price'] ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $power_supply['link'] ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No Power Supply found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
include '../partials/footer.php';
?>