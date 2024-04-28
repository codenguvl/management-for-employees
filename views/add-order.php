<?php
include 'config/mysql_connection.php';

$query_customers = "SELECT ma_khach_hang, ten_khach_hang FROM KhachHang";
$result_customers = $conn->query($query_customers);
if (!$result_customers) {
    echo "Lỗi khi truy vấn khách hàng: " . $conn->error;
}

$query_products = "SELECT ma_san_pham, ten_san_pham, gia FROM SanPham";
$result_products = $conn->query($query_products);


if (!$result_products) {
    echo "Lỗi khi truy vấn sản phẩm: " . $conn->error;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ma_khach_hang = $_POST['ma_khach_hang'];
    $ma_nhan_vien = $_POST['ma_nhan_vien'];
    $ngay_dat_hang = date("Y-m-d H:i:s");
    $ma_khuyen_mai = isset($_POST['selected_promotion']) ? floatval($_POST['selected_promotion']) : 0;
    $selected_product_ids = isset($_POST['selected_product_ids']) ? $_POST['selected_product_ids'] : array();

    $orderDetails = array();

    $tong_tien = 0;
    foreach ($selected_product_ids as $selected_product_id) {
        $so_luong = isset($_POST['quantity_' . $selected_product_id]) ? intval($_POST['quantity_' . $selected_product_id]) : 1;

        $query_product_info = "SELECT ten_san_pham, gia FROM SanPham WHERE ma_san_pham = '$selected_product_id'";
        $result_product_info = $conn->query($query_product_info);
        if ($result_product_info && $result_product_info->num_rows > 0) {
            $product_info = $result_product_info->fetch_assoc();
            $ten_san_pham = $product_info['ten_san_pham'];
            $gia = $product_info['gia'];

            $tong_tien += $gia * $so_luong;

            $orderDetails[] = array(
                'ma_san_pham' => $selected_product_id,
                'ten_san_pham' => $ten_san_pham,
                'so_luong' => $so_luong,
                'gia' => $gia
            );
        }
    }




    $tong_tien -= $ma_khuyen_mai;

    if ($tong_tien < 0) {
        $tong_tien = 0;
    }
    $insert_donhang_query = "INSERT INTO DonHang (ma_khach_hang, ma_nhan_vien, ngay_dat_hang, tong_tien, trang_thai) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_donhang_query);
    if ($stmt) {
        $trang_thai = "Đang Xử Lý";
        $stmt->bind_param("iisds", $ma_khach_hang, $ma_nhan_vien, $ngay_dat_hang, $tong_tien, $trang_thai);
        if ($stmt->execute()) {
            $ma_don_hang = $conn->insert_id;
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Đã thêm đơn hàng thành công. Mã đơn hàng: ' . $ma_don_hang . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';


            foreach ($orderDetails as $orderDetail) {
                $ma_san_pham = $orderDetail['ma_san_pham'];
                $so_luong = $orderDetail['so_luong'];
                $gia = $orderDetail['gia'];

                $insert_chitiet_query = "INSERT INTO ChiTietDonHang (ma_don_hang, ma_san_pham, so_luong, gia) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_chitiet_query);
                if ($stmt) {
                    $stmt->bind_param("iiid", $ma_don_hang, $ma_san_pham, $so_luong, $gia);
                    if (!$stmt->execute()) {
                        echo "Lỗi khi thêm chi tiết đơn hàng: " . $stmt->error;
                    }
                } else {
                    echo "Lỗi khi chuẩn bị truy vấn: " . $conn->error;
                }
            }
            $stmt->close();
        } else {
            echo "Lỗi khi thêm đơn hàng: " . $stmt->error;
        }
    } else {
        echo "Lỗi khi chuẩn bị truy vấn: " . $conn->error;
    }
}

?>

<style>
    .list-group-item {
        width: auto;
        max-width: 50%;
    }

    .quantity-input {
        width: 70px;
    }
</style>
<!-- Form thêm đơn hàng -->
<div class="container mt-4">
    <h4>THÊM ĐƠN HÀNG</h4>
    <form method="POST">
        <div class="mb-3">
            <label for="ma_khach_hang" class="form-label">Mã Khách Hàng</label>
            <select class="form-select" id="ma_khach_hang" name="ma_khach_hang" required>
                <?php
                while ($row = $result_customers->fetch_assoc()) {
                    echo "<option value='" . $row['ma_khach_hang'] . "'>" . $row['ten_khach_hang'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" id="ma_nhan_vien" name="ma_nhan_vien"
                value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="ngay_dat_hang" class="form-label">Ngày Đặt Hàng</label>
            <input type="date" class="form-control" id="ngay_dat_hang" name="ngay_dat_hang" required>
        </div>

        <div class="row mb-3">
            <div class="col-sm-9">
                <label for="ma_san_pham" class="form-label">Sản Phẩm</label>
                <select class="form-select" id="ma_san_pham" name="ma_san_pham[]" required>
                    <?php
                    while ($row = $result_products->fetch_assoc()) {
                        echo "<option value='" . $row['ma_san_pham'] . "'>" . $row['ten_san_pham'] . " - " . $row['gia'] . " VNĐ</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-sm-3 d-flex align-items-end">
                <button type="button" class="btn btn-primary" onclick="addOrUpdateProduct()">Chọn</button>
            </div>
            <input type="hidden" id="selected_product_id" name="selected_product_id">
        </div>



        <div class="mt-3">
            <h5>Danh Sách Sản Phẩm</h5>
            <ul class="list-group" id="selected-products">

            </ul>
            <div id="total-amount">Tổng tiền: 0 VNĐ</div>
        </div>

        <input type="hidden" id="selected_promotion" name="selected_promotion" value="">

        <button type="submit" class="mt-3 btn btn-primary">Thêm Đơn Hàng</button>
    </form>
</div>


<div class="modal fade" id="selectPromotionModal" tabindex="-1" aria-labelledby="selectPromotionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="selectPromotionModalLabel">Chọn Mã Khuyến Mãi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <?php
                echo "<div class='form-check'>";
                echo "<input class='form-check-input' type='radio' name='promotion' id='promotion_none' value='0' checked>";
                echo "<label class='form-check-label' for='promotion_none'>Không áp dụng khuyến mãi</label>";
                echo "</div>";

                $query_promotions = "SELECT ma_khuyen_mai, ten_khuyen_mai, gia_tri FROM KhuyenMai";
                $result_promotions = $conn->query($query_promotions);
                if ($result_promotions->num_rows > 0) {
                    while ($row = $result_promotions->fetch_assoc()) {
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='promotion' id='promotion_" . $row['ma_khuyen_mai'] . "' value='" . $row['gia_tri'] . "'>";
                        echo "<label class='form-check-label' for='promotion_" . $row['ma_khuyen_mai'] . "'>" . $row['ten_khuyen_mai'] . " - Giá trị: " . $row['gia_tri'] . "</label>";
                        echo "</div>";
                    }
                } else {
                    echo "Không có mã khuyến mãi.";
                }
                ?>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="applyPromotion()">Áp Dụng</button>
            </div>
        </div>
    </div>
</div>


<script>
    var totalAmount = 0;

    function addOrUpdateProduct() {
        var select = document.getElementById("ma_san_pham");
        var selectedOption = select.options[select.selectedIndex];
        var productId = selectedOption.value;
        var productName = selectedOption.text;

        var selectedProductsUl = document.getElementById("selected-products");
        var productLis = selectedProductsUl.getElementsByTagName("li");
        var productExists = false;

        var productPrice = parseFloat(selectedOption.textContent.split(" - ")[1].split(" ")[0]); // Lấy giá từ tùy chọn
        totalAmount += productPrice;

        for (var i = 0; i < productLis.length; i++) {
            var li = productLis[i];
            if (li.getAttribute("data-id") === productId) {
                var quantityInput = li.querySelector("input");
                quantityInput.value = parseInt(quantityInput.value) + 1;
                productExists = true;
                break;
            }
        }

        if (!productExists) {
            var productLi = document.createElement("li");
            productLi.setAttribute("data-id", productId);
            productLi.setAttribute("data-price", productPrice);
            productLi.className = "list-group-item d-flex justify-content-between align-items-center";

            var hiddenInput = document.createElement("input");
            hiddenInput.type = "hidden";
            hiddenInput.name = "selected_product_ids[]";
            hiddenInput.value = productId;

            var quantityInput = document.createElement("input");
            quantityInput.type = "number";
            quantityInput.name = "quantity_" + productId;
            quantityInput.min = "1";
            quantityInput.style.width = "50px";
            quantityInput.style.marginLeft = "10px";
            quantityInput.value = "1";

            var deleteButton = document.createElement("button");
            deleteButton.textContent = "Xóa";
            deleteButton.className = "btn btn-danger btn-sm";
            deleteButton.onclick = function () {
                removeProduct(this);
            };

            productLi.appendChild(document.createTextNode(productName));
            productLi.appendChild(quantityInput);
            productLi.appendChild(deleteButton);
            productLi.appendChild(hiddenInput);

            selectedProductsUl.appendChild(productLi);
        }


        document.getElementById("total-amount").textContent = "Tổng tiền: " + totalAmount.toFixed(2) + " VNĐ";
    }


    function removeProduct(button) {
        var li = button.parentNode;
        var productPrice = parseFloat(li.getAttribute("data-price"));
        var quantityInput = li.querySelector("input");
        var quantity = parseInt(quantityInput.value);
        totalAmount -= productPrice * quantity;
        li.parentNode.removeChild(li);

        document.getElementById("total-amount").textContent = "Tổng tiền: " + totalAmount.toFixed(2) + " VNĐ";
    }

    function applyPromotion() {
        var promotionRadios = document.getElementsByName("promotion");
        var selectedPromotionValue = 0;
        for (var i = 0; i < promotionRadios.length; i++) {
            if (promotionRadios[i].checked) {
                selectedPromotionValue = parseFloat(promotionRadios[i].value);
                break;
            }
        }
        document.getElementById("selected_promotion").value = selectedPromotionValue;

        document.querySelector("form").submit();

        var modal = document.getElementById("selectPromotionModal");
        var modalInstance = bootstrap.Modal.getInstance(modal);
        modalInstance.hide();
    }

    document.querySelector("form").addEventListener("submit", function (event) {
        event.preventDefault();

        var promotionModal = new bootstrap.Modal(document.getElementById("selectPromotionModal"));
        promotionModal.show();
    });
</script>