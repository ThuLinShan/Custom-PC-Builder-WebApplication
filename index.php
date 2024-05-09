<?php
include './partials/header.php';

// Fetch brands from database
$query = "SELECT * FROM brand";
$brands = mysqli_query($connection, $query);

?>
<!-- main start here -->
<main>
    <div id="carouselExample" class="carousel slide mb-3">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="">
                    <img src="https://placehold.co/1200x600" class="p-md-4 d-block w-100">
                </a>
            </div>
            <div class="carousel-item">
                <a href="">
                    <img src="https://placehold.co/1200x600" class="p-md-4 d-block w-100">
                </a>
            </div>
            <div class="carousel-item">
                <a href="">
                    <img src="https://placehold.co/1200x600" class="p-md-4 d-block w-100">
                </a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-6 ">
                <div>
                    <div class="card text-dark">
                        <img src="https://placehold.co/500x500" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is some text and this is more text.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 gap-3 gap-md-0">
                <div class="row gap-3 gap-md-0">
                    <div class="col-md-6 ">
                        <div class="card text-dark">
                            <img src="https://placehold.co/500x500" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="card text-dark">
                            <img src="https://placehold.co/500x500" class="card-img" alt="...">
                            <div class="card-img-overlay">
                                <h5 class="card-title">Card title</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="card text-dark">
                        <img src="https://placehold.co/400x200" class="card-img" alt="...">
                        <div class="card-img-overlay">
                            <h5 class="card-title">Card title</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <h3>
            Pre-built
        </h3>
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto" style="width: 18rem;">
                    <img src="https://placehold.co/200x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto" style="width: 18rem;">
                    <img src="https://placehold.co/200x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto" style="width: 18rem;">
                    <img src="https://placehold.co/200x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto" style="width: 18rem;">
                    <img src="https://placehold.co/200x100" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">An item</li>
                        <li class="list-group-item">A second item</li>
                        <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h3 class="text-center">Services</h3>
    <div class="bg-dark mb-5 py-4">
        <div class="container-fluid">
            <div class="row text-secondary h-100">
                <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                    <h4 class="fw-light"><i class="fa-solid fa-plane"></i> Fast Shipping</h4>
                </div>
                <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                    <h4 class="fw-light"><i class="fa-solid fa-percent"></i> Great Promotion</h4>
                </div>
                <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                    <h4 class="fw-light"><i class="fa-solid fa-handshake"></i> Safe Return</h4>
                </div>
                <div class="d-flex pb-1 justify-content-center align-items-center col-lg-3 col-md-6 col-sm-12">
                    <h4 class="fw-light"> 24/7 Support</h4>
                </div>
            </div>
        </div>
    </div>


    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Latest Blogs</h2>
            <a href="" class="btn btn-dark py-2 px-4">View All</a>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto">
                    <img src="https://placehold.co/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto">
                    <img src="https://placehold.co/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                <div class="card mx-auto">
                    <img src="https://placehold.co/400x300" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    </div>
                    <div class="card-body">
                        <a href="#" class="btn btn-info text-white">Card link</a>
                        <a href="#" class="btn btn-secondary">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div id="carouselExampleFade" class="carousel border slide py-1 rounded-3">
            <div class="carousel-inner px-1">
                <div class="carousel-item active">
                    <div style="height: 100px;" class="d-flex justify-content-center text-center align-items-center">
                        <h3>Popular Brands</h3>
                    </div>
                </div>
                <?php while ($brand = mysqli_fetch_assoc($brands)) : ?>
                    <div class="carousel-item">
                        <a class="text-decoration-none" href="<?= ROOT_URL ?>details/brand_details.php?id=<?= $brand['id'] ?>">
                            <img src="<?= ROOT_URL ?>assets/images/brands/<?= $brand['img'] ?>" class="d-block w-100" height="100px" style="object-fit: contain;">
                        </a>
                    </div>
                <?php endwhile; ?>
            </div>
            <button class="carousel-control-prev bg-black rounded" style="width: 50px;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next bg-black rounded" style="width: 50px;" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</main>
<!-- main end here -->

<?php
include './partials/footer.php';
?>