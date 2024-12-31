<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="bg-primary text-white text-center py-3">
        <h1>Trang Chủ</h1>
        <p>Chào mừng bạn đến với cửa hàng của chúng tôi</p>
    </header>

    <!-- Navbar -->
    @include('client.components.navbar')

    <!-- Banner -->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://via.placeholder.com/1920x500" class="d-block w-100" alt="Banner 1">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x500" class="d-block w-100" alt="Banner 2">
            </div>
            <div class="carousel-item">
                <img src="https://via.placeholder.com/1920x500" class="d-block w-100" alt="Banner 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

     <!-- Sản phẩm nổi bật -->
    <section class="container my-5">
        <h2 class="text-center">Sản Phẩm Nổi Bật</h2>
        <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 1">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 1</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 1.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 2">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 2</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 2.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 3">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 3</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 3.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 4">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 4</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 4.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 5">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 5</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 5.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Sản phẩm 6">
                                <div class="card-body">
                                    <h5 class="card-title">Sản phẩm 6</h5>
                                    <p class="card-text">Mô tả ngắn gọn về sản phẩm 6.</p>
                                    <a href="#" class="btn btn-primary">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Danh mục sản phẩm -->
    <section class="container my-5">
        <h2 class="text-center">Danh Mục Sản Phẩm</h2>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Danh mục 1">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục 1</h5>
                        <p class="card-text">Mô tả ngắn về danh mục 1.</p>
                        <a href="#" class="btn btn-secondary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Danh mục 2">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục 2</h5>
                        <p class="card-text">Mô tả ngắn về danh mục 2.</p>
                        <a href="#" class="btn btn-secondary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Danh mục 3">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục 3</h5>
                        <p class="card-text">Mô tả ngắn về danh mục 3.</p>
                        <a href="#" class="btn btn-secondary">Xem thêm</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="Danh mục 4">
                    <div class="card-body">
                        <h5 class="card-title">Danh mục 4</h5>
                        <p class="card-text">Mô tả ngắn về danh mục 4.</p>
                        <a href="#" class="btn btn-secondary">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2024 Cửa hàng của bạn. Tất cả các quyền được bảo lưu.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
