<?php
include 'config/mysql_connection.php';


$id = $_GET['id'];


$query_order_info = "SELECT dh.ma_don_hang, dh.ma_khach_hang, kh.ten_khach_hang, dh.ma_nhan_vien, nv.ten_nhan_vien, dh.ngay_dat_hang, dh.tong_tien, dh.trang_thai
                    FROM DonHang dh
                    LEFT JOIN KhachHang kh ON dh.ma_khach_hang = kh.ma_khach_hang
                    LEFT JOIN NhanVien nv ON dh.ma_nhan_vien = nv.ma_nhan_vien
                    WHERE dh.ma_don_hang = $id";

$result_order_info = $conn->query($query_order_info);

if ($result_order_info->num_rows > 0) {
    $order_info = $result_order_info->fetch_assoc();


    $query_order_details = "SELECT ctdh.ma_chi_tiet_don_hang, sp.ten_san_pham, ctdh.so_luong, ctdh.gia
                            FROM ChiTietDonHang ctdh
                            INNER JOIN SanPham sp ON ctdh.ma_san_pham = sp.ma_san_pham
                            WHERE ctdh.ma_don_hang = $id";

    $result_order_details = $conn->query($query_order_details);
    ?>

    <div class="container mt-4">
        <h4>CHI TIẾT ĐƠN HÀNG</h4>
        <p><strong>Mã Đơn Hàng:</strong> <?php echo $order_info['ma_don_hang']; ?></p>
        <p><strong>Tên Khách Hàng:</strong> <?php echo $order_info['ten_khach_hang']; ?></p>
        <p><strong>Tên Nhân Viên:</strong> <?php echo $order_info['ten_nhan_vien']; ?></p>
        <p><strong>Ngày Đặt Hàng:</strong> <?php echo $order_info['ngay_dat_hang']; ?></p>
        <p><strong>Tổng Tiền:</strong> <?php echo $order_info['tong_tien']; ?></p>
        <p><strong>Trạng Thái:</strong> <?php echo $order_info['trang_thai']; ?></p>

        <h5 class="mt-5">Danh Sách Sản Phẩm:</h5>
        <table id="orderDetailsTable" class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                while ($row = $result_order_details->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $count++ . "</td>";
                    echo "<td>" . $row['ten_san_pham'] . "</td>";
                    echo "<td>" . $row['so_luong'] . "</td>";
                    echo "<td>" . $row['gia'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
} else {
    echo "Không tìm thấy thông tin đơn hàng!";
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#orderDetailsTable').DataTable();
    });
</script>