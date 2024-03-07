<?php
include '../partials/header.php';

if (isset($_GET['id'])) {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM laptop WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $laptop = mysqli_fetch_assoc($result);

    // Fetch laptop from database
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
                <li class="breadcrumb-item active text-danger" aria-current="page">Edit laptop</li>
            </ol>
        </nav>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['edit-laptop'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['edit-laptop'];
                unset($_SESSION['edit-laptop']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <?php if (isset($_GET['id']) && isset($laptop)) : ?>
        <div class="container my-5">
            <form action="./edit_laptop_logic.php" class="form-control mb-5" enctype="multipart/form-data" method="post">
                <!-- hidden id -->
                <input type="hidden" value="<?= $laptop['id'] ?>" name="id">
                <!-- Previous Thumbnail -->
                <input type="hidden" value="<?= $laptop['img'] ?>" name="previous_img_name">

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

                <input name="laptop_name" value="<?= $laptop['laptop_name'] ?>" class="mb-3 form-control" type="text" placeholder="Name" required>

                <label for="img">Choose an image</label>
                <input name="img" class="mb-3 form-control" id="img" type="file">

                <label for="">Category</label>
                <select class="form-select mb-3" name="category">
                    <option value="Gaming">Gaming</option>
                    <option value="Office">Office</option>
                    <option value="Professional">Professional</option>
                    <option value="Student">Student</option>
                </select>

                <label for="">Operating System</label>
                <input name="os" value="<?= $laptop['os'] ?>" class="mb-3 form-control" type="text" placeholder="OS" required>

                <label for="">CPU</label>
                <input name="cpu" value="<?= $laptop['cpu'] ?>" class="mb-3 form-control" type="text" placeholder="CPU" required>

                <label for="">GPU</label>
                <input name="gpu" value="<?= $laptop['gpu'] ?>" class="mb-3 form-control" type="text" placeholder="GPU" required>

                <label for="">RAM</label>
                <input name="ram" value="<?= $laptop['ram'] ?>" class="mb-3 form-control" type="text" placeholder="RAM" required>

                <label for="">Primary Storage</label>
                <input name="primary_storage" value="<?= $laptop['primary_storage'] ?>" class="mb-3 form-control" type="text" placeholder="Primary Storage" required>

                <label for="">Secondary Storage</label>
                <input name="secondary_storage" value="<?= $laptop['secondary_storage'] ?>" class="mb-3 form-control" type="text" placeholder="Secondary Storage">

                <label for="">I/O ports</label>
                <input name="io_ports" value="<?= $laptop['io_ports'] ?>" class="mb-3 form-control" type="text" placeholder="I/O ports" required>

                <label for="">Internet</label>
                <input name="internet" value="<?= $laptop['internet'] ?>" class="mb-3 form-control" type="text" placeholder="Internet" required>

                <label for="">Display</label>
                <input name="display" value="<?= $laptop['display'] ?>" class="mb-3 form-control" type="text" placeholder="Display" required>

                <label for="">Battery</label>
                <input name="battery" value="<?= $laptop['battery'] ?>" class="mb-3 form-control" type="text" placeholder="Battery" required>

                <label for="">Dimensions</label>
                <input name="dimensions" value="<?= $laptop['dimensions'] ?>" class="mb-3 form-control" type="text" placeholder="Dimensions" required>

                <label for="">Bonus</label>
                <input name="bonus" value="<?= $laptop['bonus'] ?>" class="mb-3 form-control" type="text" placeholder="Bonus">

                <label for="" class="text-warning-emphasis fw-bold">Stock</label>
                <input name="stock" value="<?= $laptop['stock'] ?>" class="mb-3 form-control bg-warning-subtle" type="number" placeholder="stock">

                <label class="">Free Shipping</label>
                <input name="free_shipping" class="mb-3 form-check" type="checkbox" value="1">

                <label for="">Description</label>
                <textarea name="description" id="" placeholder="Description" class="form-control mb-4" required><?= $laptop['description'] ?></textarea>

                <label for="">Price (£)</label>
                <input name="price" value="<?= $laptop['price'] ?>" class="mb-3 form-control" type="number" placeholder="Price" required>

                <input name="link" value="<?= $laptop['link'] ?>" class="mb-3 form-control" type="text" placeholder="Official Website Link" required>

                <button name="submit" type="submit" class="form-control mb-3 btn btn-info text-white">Edit</button>
            </form>
        </div>
    <?php else : ?>
        <div class="container my-5 py-5 text-danger text-center">
            <h3>No laptop found with current id.</h3>
            <p>Please check the url and try again</p>
        </div>
    <?php endif ?>
</main>
<?php
include '../partials/footer.php';
?>