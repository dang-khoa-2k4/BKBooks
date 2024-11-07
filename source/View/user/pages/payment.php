<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thanh Toán</title>
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">Thanh Toán</h2>

        <!-- Phần Địa Chỉ Giao Hàng -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Địa Chỉ Giao Hàng</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Họ và Tên</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Nhập họ và tên người nhận">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Nhập email">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Số Điện Thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="Ví dụ: 0979123xxx">
                    </div>
                    <div class="mb-3">
                        <label for="country" class="form-label">Quốc Gia</label>
                        <select class="form-select" id="country">
                            <option selected>Việt Nam</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">Tỉnh/Thành Phố</label>
                            <select class="form-select" id="state">
                                <option selected>Chọn Tỉnh/Thành Phố</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Quận/Huyện</label>
                            <select class="form-select" id="city">
                                <option selected>Chọn Quận/Huyện</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ giao hàng">
                    </div>
                </form>
            </div>
        </div>

        <!-- Phần Phương Thức Vận Chuyển -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Phương Thức Vận Chuyển</h5>
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="shippingMethod" id="standardShipping" checked>
                    <label class="form-check-label" for="standardShipping">
                        Giao hàng tiêu chuẩn: 22,000₫ (Dự kiến giao: Thứ Sáu 23/12)
                    </label>
                </div>
            </div>
        </div>

        <!-- Phần Phương Thức Thanh Toán -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Phương Thức Thanh Toán</h5>
            </div>
            <div class="card-body">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="zaloPay">
                    <label class="form-check-label" for="zaloPay">Ví ZaloPay</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="moca">
                    <label class="form-check-label" for="moca">Ví Moca trên ứng dụng Grab</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="shopeePay">
                    <label class="form-check-label" for="shopeePay">Ví ShopeePay</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="vnpay">
                    <label class="form-check-label" for="vnpay">VNPay</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="momo">
                    <label class="form-check-label" for="momo">Ví Momo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="atm">
                    <label class="form-check-label" for="atm">ATM / Internet Banking</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="cash" checked>
                    <label class="form-check-label" for="cash">Thanh toán bằng tiền mặt khi nhận hàng</label>
                </div>
            </div>
        </div>

        <!-- Phần Kiểm Tra Đơn Hàng -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Kiểm Tra Đơn Hàng</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p>Sword Art Online Progressive Vol 7</p>
                    <p>120,000₫</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between">
                    <p>Thành tiền</p>
                    <p>120,000₫</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Phí vận chuyển</p>
                    <p>22,000₫</p>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold">
                    <p>Tổng số tiền (gồm VAT)</p>
                    <p>142,000₫</p>
                </div>
                <button class="btn btn-primary w-100 mt-3">Xác Nhận Thanh Toán</button>
            </div>
        </div>
    </div>

</body>
</html>
