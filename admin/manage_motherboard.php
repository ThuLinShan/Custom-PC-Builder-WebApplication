<?php
include './partials/header.php';

// Fetch motherboards
$query = "SELECT * FROM motherboard ORDER BY motherboard_name";
$motherboards = mysqli_query($connection, $query);
?>

<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Manage Motherboard</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>admin" class="text-warning">Admin</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Manage Motherboard</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- alet message -->
    <?php if (isset($_SESSION['delete-motherboard'])) : ?>
        <div class="bg-danger d-flex justify-content-center align-items-center text-white p-3">
            <p>
                <?= $_SESSION['delete-motherboard'];
                unset($_SESSION['delete-motherboard']); ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION['delete-motherboard-success'])) : ?>
        <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
            <p>
                <?= $_SESSION['delete-motherboard-success'];
                unset($_SESSION['delete-motherboard-success']); ?>
            </p>
        </div>
    <?php endif ?>
    <!-- alet message -->
    <?php if (isset($_SESSION['add-motherboard-success'])) : ?>
        <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
            <h3>
                <?= $_SESSION['add-motherboard-success'];
                unset($_SESSION['add-motherboard-success']);
                ?>
            </h3>
        </div>
    <?php endif ?>
    <?php if (isset($_SESSION['edit-motherboard-success'])) : ?>
        <div class="bg-success d-flex justify-content-center align-items-center text-white p-3">
            <p>
                <?= $_SESSION['edit-motherboard-success'];
                unset($_SESSION['edit-motherboard-success']); ?>
            </p>
        </div>
    <?php endif ?>
    <!-- alert message end -->

    <div class="container py-5">
        <div class="row p-4 rounded shadow-lg">
            <div class="col-md-6 ">
                <h3>Motherboardsl</h3>
            </div>
            <a class="col-md-6 btn btn-dark px-4" href="./add_motherboard.php">Add new motherboard</a>
        </div>
        <?php if (mysqli_num_rows($motherboards) > 0) : ?>
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>Motherboard Name</th>
                        <th>Chipset</th>
                        <th>Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($motherboard = mysqli_fetch_assoc($motherboards)) : ?>
                        <tr class="align-middle">
                            <td><?= $motherboard['motherboard_name'] ?></td>
                            <td><?= $motherboard['chipset'] ?></td>
                            <td>
                                <a class="btn btn-primary mb-1" style="width: 80px;" href="<?= ROOT_URL ?>details/motherboard_details.php?id=<?= $motherboard['id'] ?>">Details</a>
                                <a class="btn btn-secondary " style="width: 80px;" href="./edit_motherboard.php?id=<?= $motherboard['id'] ?>" class="btn sm">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert__message error">
                <p> "No motherboards found" </p>
            </div>
        <?php endif ?>

    </div>
</main>


<?php
include './partials/footer.php';
?>