<?php
include 'config/mysql_connection.php'; // Kết nối CSDL

$query_orders = "SELECT dh.ma_don_hang, dh.ma_khach_hang, kh.ten_khach_hang, dh.ma_nhan_vien, nv.ten_nhan_vien, dh.ngay_dat_hang, dh.tong_tien, dh.trang_thai
                FROM DonHang dh
                LEFT JOIN KhachHang kh ON dh.ma_khach_hang = kh.ma_khach_hang
                LEFT JOIN NhanVien nv ON dh.ma_nhan_vien = nv.ma_nhan_vien";
$result_orders = $conn->query($query_orders);
if (!$result_orders) {
    echo "Lỗi khi truy vấn đơn hàng: " . $conn->error;
}
?>

<div class="container mt-4">
    <h4>DANH SÁCH ĐƠN HÀNG</h4>
    <table id="orderTable" class="display">
        <thead>
            <tr>
                <th>Mã Đơn Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Tên Nhân Viên</th>
                <th>Ngày Đặt Hàng</th>
                <th>Tổng Tiền</th>
                <th>Trạng Thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php

            while ($row = $result_orders->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ma_don_hang'] . "</td>";
                echo "<td>" . $row['ten_khach_hang'] . "</td>";
                echo "<td>" . $row['ten_nhan_vien'] . "</td>";
                echo "<td>" . $row['ngay_dat_hang'] . "</td>";
                echo "<td>" . $row['tong_tien'] . "</td>";
                echo "<td>" . $row['trang_thai'] . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['ma_don_hang'] . "' data-name='Đơn hàng " . $row['ma_don_hang'] . "'>Xóa</button>"; // Nút xóa đơn hàng
                echo "<a href='./?page=view-order-detail&id=" . $row['ma_don_hang'] . "' class='btn btn-info btn-sm'>Xem Chi Tiết</a>"; // Nút xem chi tiết đơn hàng
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
$(document).ready(function() {
    $('#orderTable').DataTable();
});
</script>
<script>
$(document).ready(function() {
    $('#orderTable').DataTable();


    $('#orderTable').on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Bạn có chắc chắn muốn xóa đơn hàng " + name + " không?",
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
                    url: 'handler/delete_order.php',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        if (response === "success") {
                            Swal.fire(
                                'Đã xóa!',
                                'Đơn hàng đã được xóa thành công.',
                                'success'
                            ).then((result) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi xóa đơn hàng: ' +
                                response,
                                'error'
                            );
                        }
                    },
                    error: function(xhr, status, error) {
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