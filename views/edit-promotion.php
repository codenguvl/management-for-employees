<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config/mysql_connection.php';

    $id = $_POST['id'];
    $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
    $ngay_bat_dau = $_POST['ngay_bat_dau'];
    $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
    $gia_tri = $_POST['gia_tri'];

    $sql = "UPDATE KhuyenMai SET ten_khuyen_mai='$ten_khuyen_mai', ngay_bat_dau='$ngay_bat_dau', ngay_ket_thuc='$ngay_ket_thuc', gia_tri='$gia_tri' WHERE ma_khuyen_mai=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    title: 'Cập nhật thành công!',
                    text: 'Thông tin khuyến mãi đã được cập nhật thành công.',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = './?page=view-promotions';
                });
            </script>";
        exit();
    } else {
        echo "Cập nhật khuyến mãi thất bại: " . $conn->error;
    }

    $conn->close();
} else {
    include 'config/mysql_connection.php';

    $id = $_GET['id'];

    $query_promotion = "SELECT * FROM KhuyenMai WHERE ma_khuyen_mai=$id";

    $result_promotion = $conn->query($query_promotion);

    if ($result_promotion->num_rows > 0) {
        $row = $result_promotion->fetch_assoc();
        $ten_khuyen_mai = $row['ten_khuyen_mai'];
        $ngay_bat_dau = $row['ngay_bat_dau'];
        $ngay_ket_thuc = $row['ngay_ket_thuc'];
        $gia_tri = $row['gia_tri'];
        ?>

        <div class="container mt-4">
            <h4>CHỈNH SỬA KHUYẾN MÃI</h4>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="ten_khuyen_mai" class="form-label">Tên Khuyến Mãi</label>
                    <input type="text" class="form-control" id="ten_khuyen_mai" name="ten_khuyen_mai"
                        value="<?php echo $ten_khuyen_mai; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ngay_bat_dau" class="form-label">Ngày Bắt Đầu</label>
                    <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau"
                        value="<?php echo $ngay_bat_dau; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="ngay_ket_thuc" class="form-label">Ngày Kết Thúc</label>
                    <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc"
                        value="<?php echo $ngay_ket_thuc; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="gia_tri" class="form-label">Giá Trị</label>
                    <input type="number" class="form-control" id="gia_tri" name="gia_tri" value="<?php echo $gia_tri; ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật Khuyến Mãi</button>
            </form>
        </div>
        <?php
    } else {
        echo "Không tìm thấy khuyến mãi!";
    }
}
?>