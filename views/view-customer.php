<?php
include 'config/mysql_connection.php'; 


$query_customers = "SELECT ma_khach_hang, ten_khach_hang, email_khach_hang, so_dien_thoai_khach_hang, dia_chi FROM KhachHang";
$result_customers = $conn->query($query_customers);

if (!$result_customers) {
    echo "Lỗi khi truy vấn khách hàng: " . $conn->error;
}
?>

<div class="container mt-4">
    <h4>DANH SÁCH KHÁCH HÀNG</h4>
    <table id="customerTable" class="display">
        <thead>
            <tr>
                <th>Mã Khách Hàng</th>
                <th>Tên Khách Hàng</th>
                <th>Email</th>
                <th>Số Điện Thoại</th>
                <th>Địa Chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result_customers->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ma_khach_hang'] . "</td>";
                echo "<td>" . $row['ten_khach_hang'] . "</td>";
                echo "<td>" . $row['email_khach_hang'] . "</td>";
                echo "<td>" . $row['so_dien_thoai_khach_hang'] . "</td>";
                echo "<td>" . $row['dia_chi'] . "</td>";
                echo "<td>";
                echo "<a href='?page=edit-customer&id=" . $row['ma_khach_hang'] . "' class='btn btn-primary btn-sm'>Sửa</a>";
                echo "<button type='button' class='btn btn-danger btn-sm deleteBtn' data-id='" . $row['ma_khach_hang'] . "' data-name='" . $row['ten_khach_hang'] . "'>Xóa</button>";
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
    $('#customerTable').DataTable();
});
</script>
<script>
$(document).ready(function() {
    $('#customerTable').DataTable();


    $('#customerTable').on('click', '.deleteBtn', function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Bạn có chắc chắn muốn xóa khách hàng " + name + " không?",
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
                    url: 'handler/delete_customer.php',
                    data: {
                        id: id
                    },
                    success: function(response) {

                        Swal.fire(
                            'Đã xóa!',
                            'Khách hàng đã được xóa thành công.',
                            'success'
                        ).then((result) => {

                            location.reload();
                        });
                    },
                    error: function(xhr, status, error) {

                        Swal.fire(
                            'Lỗi!',
                            'Đã xảy ra lỗi khi xóa khách hàng: ' +
                            response,
                            'error'
                        );
                    }
                });
            }
        });
    });
});
</script>