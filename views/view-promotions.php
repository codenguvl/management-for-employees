<?php
include 'config/mysql_connection.php';

$query_promotions = "SELECT * FROM KhuyenMai";
$result_promotions = $conn->query($query_promotions);

if (!$result_promotions) {
    echo "Lỗi khi truy vấn khuyến mãi: " . $conn->error;
}
?>

<div class="container mt-4">
    <h4>DANH SÁCH KHUYẾN MÃI</h4>
    <table id="promotionTable" class="display">
        <thead>
            <tr>
                <th>Mã Khuyến Mãi</th>
                <th>Tên Khuyến Mãi</th>
                <th>Ngày Bắt Đầu</th>
                <th>Ngày Kết Thúc</th>
                <th>Giá Trị</th>
                <th>Trạng Thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result_promotions->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ma_khuyen_mai'] . "</td>";
                echo "<td>" . $row['ten_khuyen_mai'] . "</td>";
                echo "<td>" . $row['ngay_bat_dau'] . "</td>";
                echo "<td>" . $row['ngay_ket_thuc'] . "</td>";
                echo "<td>" . $row['gia_tri'] . "</td>";

                $current_date = date("Y-m-d");
                if ($row['ngay_ket_thuc'] < $current_date) {
                    $status = "<span class='badge bg-danger'>Hết hạn</span>";
                } else {
                    $status = "<span class='badge bg-success'>Còn hạn</span>";
                }
                echo "<td>" . $status . "</td>";

                echo "<td>";
                echo "<a href='http://localhost:2222/nhanvien/?page=edit-promotion&id=" . $row['ma_khuyen_mai'] . "' class='btn btn-primary btn-sm'>Sửa</a>";
                echo "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['ma_khuyen_mai'] . "' data-name='" . $row['ten_khuyen_mai'] . "'>Xóa</button>";
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
        $('#promotionTable').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#promotionTable').DataTable();

        $('#promotionTable').on('click', '.deleteBtn', function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Bạn có chắc chắn muốn xóa khuyến mãi " + name + " không?",
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
                        url: 'handler/delete_promotion.php',
                        data: {
                            id: id
                        },
                        success: function (response) {
                            if (response === "success") {
                                Swal.fire(
                                    'Đã xóa!',
                                    'Khuyến mãi đã được xóa thành công.',
                                    'success'
                                ).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Lỗi!',
                                    'Đã xảy ra lỗi khi xóa khuyến mãi: ' +
                                    response,
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