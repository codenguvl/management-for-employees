<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="./?page=home" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    Trang quản trị
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAcc"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    Quản lí khách hàng
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-compact-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseAcc" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="./?page=view-customer">Xem tài khoản</a>
                        <a class="nav-link" href="./?page=add-customer">Thêm tài khoản</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseProducts"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-basket"></i>
                    </div>
                    Quản lý sản phẩm
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-compact-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseProducts" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="./?page=view-products">Xem sản phẩm</a>
                        <a class="nav-link" href="./?page=add-product">Thêm sản phẩm</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseOrders"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-cart4"></i>
                    </div>
                    Quản lý đơn hàng
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-compact-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseOrders" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="./?page=view-orders">Xem đơn hàng</a>
                        <a class="nav-link" href="./?page=add-order">Thêm đơn hàng</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePromotions"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-gift"></i>
                    </div>
                    Quản lý khuyến mãi
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-compact-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapsePromotions" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="./?page=view-promotions">Xem khuyến mãi</a>
                        <a class="nav-link" href="./?page=add-promotion">Thêm khuyến mãi</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReviews"
                    aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-star"></i>
                    </div>
                    Quản lý đánh giá
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-compact-down"></i>
                    </div>
                </a>
                <div class="collapse" id="collapseReviews" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="./?page=view-reviews">Xem đánh giá</a>
                    </nav>
                </div>
                <a class="nav-link btn" href="#" onclick="confirmLogout()">
                    <div class="sb-nav-link-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    Đăng xuất
                </a>

            </div>
        </div>
    </nav>
</div>
<script>
    function confirmLogout() {
        Swal.fire({
            title: 'Bạn có chắc muốn đăng xuất?',
            text: "Bạn sẽ được chuyển hướng đến trang đăng nhập!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        });
    }
</script>