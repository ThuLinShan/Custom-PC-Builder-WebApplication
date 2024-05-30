<?php
include './partials/header.php';

// Refill from if registration fails
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password       = $_SESSION['signin-data']['password'] ?? null;

// Delete signup data session
unset($_SESSION['signin-data']);
?>
<!-- main start here -->
<main>
    <div class="bg-dark text-center d-flex flex-column justify-content-center" style="height: 25vh;">
        <h3 class="text-secondary fw-bold fs-1">Signin</h3>
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-warning justify-content-center">
                    <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>" class="text-warning">Home</a></li>
                    <li class="breadcrumb-item active text-secondary" aria-current="page">Signin</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container my-5">
        <div>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="text-center py-3 bg-success text-white opacity-75">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']); ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="text-center py-3 bg-danger text-white opacity-75">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']); ?>
                    </p>
                </div>
            <?php endif ?>
        </div>
        <!-- form -->
        <form class="form-control px-3 py-5 shadow" action="./signin_logic.php" method="post">
            <input class="form-control mb-2" type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or E-mail">
            <input class="form-control mb-2" type="password" name="password" value="<?= $password ?>" placeholder="Password">

            <button class="form-control mb-2 btn btn-primary" type="submit" name="submit">Signin</button>
        </form>
        <!-- form end -->
        <div class="mt-4 d-flex gap-2">
            <p class="p-0 m-0">Don't have an account? </p>
            <a href="./signup.php">Register</a>
        </div>
    </div>
</main>
<!-- main end here -->

<?php
include './partials/footer.php';
?>