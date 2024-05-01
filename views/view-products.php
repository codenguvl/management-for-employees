<?php
include 'config/mysql_connection.php';

$query_products = "SELECT * FROM SanPham";
$result_products = $conn->query($query_products);
if (!$result_products) {
    echo "Lỗi khi truy vấn sản phẩm: " . $conn->error;
}
?>

<div class="container mt-4">
    <h4>DANH SÁCH SẢN PHẨM</h4>
    <table id="productTable" class="display">
        <thead>
            <tr>
                <th>Mã Sản Phẩm</th>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Số Lượng Tồn Kho</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result_products->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ma_san_pham'] . "</td>";
                echo "<td>" . $row['ten_san_pham'] . "</td>";
                echo "<td><img src='" . $row['hinh_anh'] . "' style='width: 100px; height: auto;'></td>";
                echo "<td>" . $row['gia'] . "</td>";
                echo "<td>" . $row['so_luong_ton_kho'] . "</td>";
                echo "<td>";
                echo "<a href='./?page=edit-product&id=" . $row['ma_san_pham'] . "' class='btn btn-primary btn-sm'>Sửa</a>";
                echo "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['ma_san_pham'] . "' data-name='" . $row['ten_san_pham'] . "'>Xóa</button>"; // Nút xóa
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    $(document).ready(function () {
        $('#productTable').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#productTable').DataTable();

        $('#productTable').on('click', '.deleteBtn', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn có chắc chắn muốn xóa sản phẩm " + name + " không?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: 'POST',
                        url: 'handler/delete_product.php',
                        data: {
                            id: id
                        },
                        success: function (response) {

                            if (response === "success") {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Sản phẩm đã được xóa thành công.',
                                    'success'
                                ).then((result) => {

                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Không thể xóa sản phẩm do có đơn hàng đang tồn tại',
                                    'error'
                                );
                            }
                        },
                        error: function (xhr, status, error) {

                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi gửi yêu cầu xóa đến máy chủ.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>