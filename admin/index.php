<?php
include './partials/header.php';


// Fetch brands
$query = "SELECT * FROM brand ORDER BY brand_name";
$brands = mysqli_query($connection, $query);
?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Admin</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Admin</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-5">
        <!-- alet message -->
        <?php if (isset($_SESSION['delete-brand'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-brand'];
                    unset($_SESSION['delete-brand']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-brand-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-brand-success'];
                    unset($_SESSION['delete-brand-success']); ?>
                </p>
            </div>
        <?php endif ?>

        <?php if (isset($_SESSION['brand-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['brand-success'];
                    unset($_SESSION['brand-success']);
                    ?>
                </h3>
            </div>
        <?php elseif (isset($_SESSION['brand'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['brand'];
                    unset($_SESSION['brand']);
                    ?>
                </h3>
            </div>
        <?php endif ?>

        <!-- alet message -->
        <?php if (isset($_SESSION['add-brand-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-brand-success'];
                    unset($_SESSION['add-brand-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-brand-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-brand-success'];
                    unset($_SESSION['edit-brand-success']); ?>
                </p>
            </div>
        <?php endif ?>

        <div class="container">
            <h3>Products Management</h3>
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item border-1 border-primary-subtle">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Manage Brands
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <!-- manage brands -->
                        <div>
                            <div class="d-flex justify-content-between p-3 shadow-lg">
                                <h3>Brands</h3>
                                <a class="btn btn-dark px-4" href="./add_brand.php">Add new brand</a>
                            </div>
                            <?php if (mysqli_num_rows($brands) > 0) : ?>
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>Brand_name</th>
                                            <th>Logo</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                                            <tr class="align-middle">
                                                <td><?= $brand['brand_name'] ?></td>
                                                <td><img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" loading="lazy" width="100px" alt=""></td>
                                                <td class="ms-4">
                                                    <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand['id'] ?>">Details</a>
                                                    <a class="btn btn-secondary " style="width: 80px;" href="./edit_brand.php?id=<?= $brand['id'] ?>" class="btn sm">Edit</a>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <div class="alert__message error">
                                    <p> "No brands found" </p>
                                </div>
                            <?php endif ?>

                        </div>
                        <!-- manage brands -->

                    </div>
                </div>
            </div>
            <div class="accordion-item border-1 border-primary-subtle">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Manage Components
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div>
                            <div class="d-flex justify-content-between p-3 shadow-lg">
                                <h3>Desktop Components</h3>
                            </div>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Component Name</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Motherboard</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_motherboard.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Operating System</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_operating_system.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>CPU</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_cpu.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>GPU</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_gpu.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>RAM</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_ram.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Storage (Solid State Drives)</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_storage.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Power Supply</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_power_supply.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Case</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_desktop_case.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Cooler</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_cooler.php">Manage</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- manage brands -->
                    </div>
                </div>
            </div>
            <div class="accordion-item border-1 border-primary-subtle">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Manage Computers
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div>
                            <div class="d-flex justify-content-between p-3 shadow-lg">
                                <h3>Computers</h3>
                            </div>
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="align-middle">
                                        <td>Pre-built Desktops</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_prebuilt.php">Manage</a>
                                        </td>
                                    </tr>
                                    <tr class="align-middle">
                                        <td>Laptops</td>
                                        <td>
                                            <a class="btn btn-secondary" href="<?= ROOT_URL ?>admin/manage_laptop.php">Manage</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- main end here -->

<?php
include './partials/footer.php';
?>