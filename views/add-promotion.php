<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config/mysql_connection.php';

    $ten_khuyen_mai = $_POST['ten_khuyen_mai'];
    $ngay_bat_dau = $_POST['ngay_bat_dau'];
    $ngay_ket_thuc = $_POST['ngay_ket_thuc'];
    $gia_tri = $_POST['gia_tri'];

    $sql = "INSERT INTO KhuyenMai (ten_khuyen_mai, ngay_bat_dau, ngay_ket_thuc, gia_tri) 
            VALUES ('$ten_khuyen_mai', '$ngay_bat_dau', '$ngay_ket_thuc', '$gia_tri')";

    if ($conn->query($sql) === TRUE) {
        echo '<div class="alert alert-success" role="alert">Thêm khuyến mãi thành công!</div>';
    } else {
        echo "Thêm khuyến mãi thất bại: " . $conn->error;
    }

    $conn->close();
}
?>

<div class="container mt-4">
    <h4>THÊM KHUYẾN MÃI</h4>
    <form method="POST">
        <div class="mb-3">
            <label for="ten_khuyen_mai" class="form-label">Tên Khuyến Mãi</label>
            <input type="text" class="form-control" id="ten_khuyen_mai" name="ten_khuyen_mai" required>
        </div>
        <div class="mb-3">
            <label for="ngay_bat_dau" class="form-label">Ngày Bắt Đầu</label>
            <input type="date" class="form-control" id="ngay_bat_dau" name="ngay_bat_dau" required>
        </div>
        <div class="mb-3">
            <label for="ngay_ket_thuc" class="form-label">Ngày Kết Thúc</label>
            <input type="date" class="form-control" id="ngay_ket_thuc" name="ngay_ket_thuc" required>
        </div>
        <div class="mb-3">
            <label for="gia_tri" class="form-label">Giá Trị</label>
            <input type="number" class="form-control" id="gia_tri" name="gia_tri" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Khuyến Mãi</button>
    </form>
</div>
<script>
$(document).ready(function() {
    $('#ngay_bat_dau').change(function() {
        var startDate = $(this).val();
        $('#ngay_ket_thuc').attr('min', startDate);
    });
});
</script>