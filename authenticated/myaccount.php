<?php
include './partials/header.php';
?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">My account</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">My account</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-5">
        <img src="<?= ROOT_URL . '/assets/images/avatars/' . $avatar ?>" style="border-radius: 50%; border:solid black 2px; padding:2px; overflow:hidden; object-fit: cover;" alt="" width="500rem;" height="500rem;">
        <h4>Hello <?= $current_user['username'] ?></h4>
    </div>
</main>
<!-- main end here -->

<?php
include '../partials/footer.php';
?>