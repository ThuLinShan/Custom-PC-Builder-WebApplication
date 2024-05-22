<?php
include '../partials/header.php';

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

?>
<!-- main start here -->
<main>

    <div class="bg-dark row h-25 text-center d-flex flex-column justify-content-center py-5 mx-0">
        <h1 class="text-white-50 text-lg my-3">Products</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb d-flex justify-content-center">
                <li class="breadcrumb-item"><a href="<?= ROOT_URL ?>index.php" class="text-secondary">Home</a></li>
                <li class="breadcrumb-item active text-danger" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>

    <div class="container my-5">
        <h2 class="text-center">
            Products Browse
        </h2>
        <div class="row mb-5">
            <img src="https://placehold.co/1000x300" class="img-fluid" alt="">
        </div>
        <h4 class="text-center">
            All Products
        </h4>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3 shadow-sm py-4 rounded">
                <div class="card mx-auto" style="width: 18rem;">
                    <img src="https://placehold.co/200x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product name</h5>
                        <p class="card-text d-flex justify-content-between">
                            Price: $1500
                            <span class="px-1 rounded bg-warning">status</span>
                        </p>
                    </div>
                    <ul class="list-group border-0 list-group-flush">
                        <li class="list-group-item small py-1 border-0"><span class="fw-bold">OS:</span> Windows 11 Pro Edition</li>
                        <li class="list-group-item small py-1 border-0"><span class="fw-bold">CPU:</span> Intel i9 13240k</li>
                        <li class="list-group-item small py-1 border-0"><span class="fw-bold">GPU:</span> Nividia RTX 4030Ti</li>
                        <li class="list-group-item small py-1 border-0"><span class="fw-bold">RAM:</span> 16GB DDR5</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn rounded-5 btn-outline-info ">Details</a>
                        <a href="#" class="btn rounded-5 btn-secondary">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<!-- main end here -->

<?php
include '../partials/footer.php';
?>