<?php
include './partials/header.php';

// Fetch power_supplys
$query = "SELECT * FROM power_supply ORDER BY power_supply_name";
$power_supplys = mysqli_query($connection, $query);

$brand;
$brand_id;
?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage PSU</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage PSU</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row p-4 rounded shadow-lg">
            <div class="col-md-6 ">
                <h3>Power Supply</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_power_supply.php">Add new power supply</a>
        </div>

        <!-- alet message -->
        <?php if (isset($_SESSION['delete-power_supply'])) : ?>
            <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-power_supply'];
                    unset($_SESSION['delete-power_supply']); ?>
                </p>
            </div>
        <?php elseif (isset($_SESSION['delete-power_supply-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['delete-power_supply-success'];
                    unset($_SESSION['delete-power_supply-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alet message -->
        <?php if (isset($_SESSION['add-power_supply-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <h3>
                    <?= $_SESSION['add-power_supply-success'];
                    unset($_SESSION['add-power_supply-success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['edit-power_supply-success'])) : ?>
            <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
                <p>
                    <?= $_SESSION['edit-power_supply-success'];
                    unset($_SESSION['edit-power_supply-success']); ?>
                </p>
            </div>
        <?php endif ?>
        <!-- alert message end -->
        <?php if (mysqli_num_rows($power_supplys) > 0) : ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Name</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($power_supply = mysqli_fetch_assoc($power_supplys)) : ?>
                        <tr class="align-middle">
                            <!-- fetch brand with id -->
                            <?php
                            $brand_id = $power_supply['brand'];
                            $query = "SELECT brand_name FROM brand WHERE id=$brand_id";
                            $brand = mysqli_fetch_assoc(mysqli_query($connection, $query));
                            ?>
                            <td><?= $brand['brand_name'] ?></td>
                            <td><?= $power_supply['power_supply_name'] ?></td>
                            <td>
                                <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/power_supply_details.php?id=<?= $power_supply['id'] ?>">Details</a>
                                <a class="btn btn-secondary " style="width: 80px;" href="./edit_power_supply.php?id=<?= $power_supply['id'] ?>" class="btn sm">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert__message error d-flex justify-content-center align-items-center py-5 my-5">
                <h4> "No power_supplys found" </h4>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>