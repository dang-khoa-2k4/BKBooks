<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles to make it look like the image */
        .cart-item { border-bottom: 1px solid #ddd; padding: 15px 0; }
        .price { font-size: 1.2rem; font-weight: bold; }
        .promo-section { border-top: 1px solid #ddd; padding-top: 15px; }
        .btn-custom { background-color: #007bff; color: white; }
        .total-section { border-top: 1px solid #ddd; padding-top: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <!-- Shopping Cart Section -->
        <h4 class="mb-4">GIỎ HÀNG (1 sản phẩm)</h4>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-md-8">
                <div class="cart-item d-flex align-items-center">
                    <img src="book-cover.jpg" alt="Book Cover" class="img-thumbnail mr-3" style="width: 100px;">
                    <div>
                        <h5 class="mb-1">Sword Art Online Progressive Vol 7</h5>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary btn-sm">-</button>
                            <input type="text" class="form-control mx-2" style="width: 50px; text-align: center;" value="1">
                            <button class="btn btn-outline-secondary btn-sm">+</button>
                        </div>
                    </div>
                    <div class="ml-auto price">120.000 Đ</div>
                </div>
            </div>

            <!-- Promotion Codes and Total -->
            <!-- Promotion Section -->
            <div class="col-md-4">
                <div class="promo-section p-3 border mb-3">
                    <h6 class="text-uppercase font-weight-bold">Khuyến Mãi</h6>

                    <!-- Mã Giảm 20% -->
                    <div class="border-bottom pb-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Mã GIẢM 20%</span>
                            <a href="#" class="text-primary">Chi tiết</a>
                        </div>
                        <small>Cho đơn hàng từ 720K - Không áp dụng cho Phiếu Quà Tặng - Hiệu lực ngày 20.12.2022 - 27.12.2022</small>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary btn-sm">Áp dụng</button>
                        </div>
                    </div>

                    <!-- Mã Miễn Phí Giao Hàng -->
                    <div class="border-bottom pb-2 mb-2">
                        <div class="d-flex justify-content-between">
                            <span>Mã MIỄN PHÍ GIAO HÀNG</span>
                            <a href="#" class="text-primary">Chi tiết</a>
                        </div>
                        <small>Cho đơn hàng từ 500K - Không áp dụng cho Phiếu Quà Tặng - Hiệu lực ngày 21.12.2022</small>
                        <div class="d-flex justify-content-end mt-2">
                            <button class="btn btn-primary btn-sm">Áp dụng</button>
                        </div>
                    </div>
                </div>

                <!-- Total Section -->
                <div class="total-section mt-3 p-3 border">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Thành tiền</span>
                        <span>120.000 Đ</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tổng số tiền (gồm VAT)</span>
                        <span>120.000 Đ</span>
                    </div>
                    <button class="btn btn-custom btn-block mt-3">THANH TOÁN</button>
                </div>
            </div>
        </div>

        <!-- Promo Code Section -->
        <div class="promo-section mt-4 p-3 border">
            <h6 class="text-uppercase font-weight-bold">Mã Khuyến Mãi / Mã Quà Tặng</h6>
            <div class="input-group mt-2">
                <input type="text" class="form-control" placeholder="Nhập mã khuyến mãi / quà tặng">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm" style="width: 20vw;">Áp dụng</button>
                </div>
            </div>
            <a href="#" class="d-block mt-2 text-primary">Chọn mã khuyến mãi</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
