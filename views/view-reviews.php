<?php
include 'config/mysql_connection.php';

$query_reviews = "SELECT dg.ma_danh_gia, dg.ma_san_pham, dg.ma_khach_hang, dg.ngay_danh_gia, dg.danh_gia, dg.binh_luan, sp.ten_san_pham, kh.ten_khach_hang
                  FROM DanhGia dg
                  LEFT JOIN SanPham sp ON dg.ma_san_pham = sp.ma_san_pham
                  LEFT JOIN KhachHang kh ON dg.ma_khach_hang = kh.ma_khach_hang";
$result_reviews = $conn->query($query_reviews);
if (!$result_reviews) {
    echo "Lỗi khi truy vấn đánh giá: " . $conn->error;
}
?>

<div class="container mt-4">
    <h4>DANH SÁCH ĐÁNH GIÁ</h4>
    <table id="reviewTable" class="display">
        <thead>
            <tr>
                <th>Mã Đánh Giá</th>
                <th>Tên Sản Phẩm</th>
                <th>Tên Khách Hàng</th>
                <th>Ngày Đánh Giá</th>
                <th>Đánh Giá</th>
                <th>Bình Luận</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result_reviews->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ma_danh_gia'] . "</td>";
                echo "<td>" . $row['ten_san_pham'] . "</td>";
                echo "<td>" . $row['ten_khach_hang'] . "</td>";
                echo "<td>" . $row['ngay_danh_gia'] . "</td>";
                echo "<td>" . $row['danh_gia'] . "</td>";
                echo "<td>" . $row['binh_luan'] . "</td>";
                echo "<td>";
                echo "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['ma_danh_gia'] . "'>Xóa</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        $('#reviewTable').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#reviewTable').DataTable();

        $('#reviewTable').on('click', '.deleteBtn', function () {
            var review_id = $(this).data('id');
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn có chắc chắn muốn xóa đánh giá này không?",
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
                        url: 'handler/delete_review.php',
                        data: {
                            id: review_id
                        },
                        success: function (response) {
                            if (response === "success") {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Đánh giá đã được xóa thành công.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi xóa đánh giá.',
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