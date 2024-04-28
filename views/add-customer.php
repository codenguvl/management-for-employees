<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config/mysql_connection.php';

    $ten_khach_hang = $_POST['ten_khach_hang'];
    $email_khach_hang = $_POST['email_khach_hang'];
    $so_dien_thoai_khach_hang = $_POST['so_dien_thoai_khach_hang'];
    $dia_chi = $_POST['dia_chi'];

    $check_query = "SELECT * FROM KhachHang WHERE email_khach_hang = '$email_khach_hang' OR so_dien_thoai_khach_hang = '$so_dien_thoai_khach_hang'";
    $result = $conn->query($check_query);

    if ($result->num_rows > 0) {
        echo '<div class="alert alert-warning" role="alert">Email hoặc số điện thoại đã tồn tại trong cơ sở dữ liệu!</div>';
    } else {
        $sql = "INSERT INTO KhachHang (ten_khach_hang, email_khach_hang, so_dien_thoai_khach_hang, dia_chi) 
                VALUES ('$ten_khach_hang', '$email_khach_hang', '$so_dien_thoai_khach_hang', '$dia_chi')";

        if ($conn->query($sql) === TRUE) {

            echo '<div class="alert alert-success" role="alert">Thêm khách hàng thành công!</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Thêm khách hàng thất bại: ' . $conn->error . '</div>';
        }
    }
}

$conn->close();
?>



<div class="container mt-4">
    <h4>THÊM KHÁCH HÀNG</h4>
    <form method="POST">
        <div class="mb-3">
            <label for="ten_khach_hang" class="form-label">Tên Khách Hàng</label>
            <input type="text" class="form-control" id="ten_khach_hang" name="ten_khach_hang" required>
        </div>
        <div class="mb-3">
            <label for="email_khach_hang" class="form-label">Email Khách Hàng</label>
            <input type="email" class="form-control" id="email_khach_hang" name="email_khach_hang" required>
        </div>
        <div class="mb-3">
            <label for="so_dien_thoai_khach_hang" class="form-label">Số Điện Thoại Khách Hàng</label>
            <input type="tel" class="form-control" id="so_dien_thoai_khach_hang" name="so_dien_thoai_khach_hang"
                required>
        </div>
        <div class="mb-3">
            <label for="tinh_thanh" class="form-label">Tỉnh/Thành Phố</label>
            <select class="form-select" id="dia_chi" name="dia_chi" required>
                <option value="" disabled selected>Chọn tỉnh/thành phố</option>
                <?php
                $tinh_thanh = array(
                    "An Giang",
                    "Bà Rịa - Vũng Tàu",
                    "Bắc Giang",
                    "Bắc Kạn",
                    "Bạc Liêu",
                    "Bắc Ninh",
                    "Bến Tre",
                    "Bình Định",
                    "Bình Dương",
                    "Bình Phước",
                    "Bình Thuận",
                    "Cà Mau",
                    "Cần Thơ",
                    "Cao Bằng",
                    "Đà Nẵng",
                    "Đắk Lắk",
                    "Đắk Nông",
                    "Điện Biên",
                    "Đồng Nai",
                    "Đồng Tháp",
                    "Gia Lai",
                    "Hà Giang",
                    "Hà Nam",
                    "Hà Nội",
                    "Hà Tĩnh",
                    "Hải Dương",
                    "Hải Phòng",
                    "Hậu Giang",
                    "Hòa Bình",
                    "Hưng Yên",
                    "Khánh Hòa",
                    "Kiên Giang",
                    "Kon Tum",
                    "Lai Châu",
                    "Lâm Đồng",
                    "Lạng Sơn",
                    "Lào Cai",
                    "Long An",
                    "Nam Định",
                    "Nghệ An",
                    "Ninh Bình",
                    "Ninh Thuận",
                    "Phú Thọ",
                    "Phú Yên",
                    "Quảng Bình",
                    "Quảng Nam",
                    "Quảng Ngãi",
                    "Quảng Ninh",
                    "Quảng Trị",
                    "Sóc Trăng",
                    "Sơn La",
                    "Tây Ninh",
                    "Thái Bình",
                    "Thái Nguyên",
                    "Thanh Hóa",
                    "Thừa Thiên Huế",
                    "Tiền Giang",
                    "TP Hồ Chí Minh",
                    "Trà Vinh",
                    "Tuyên Quang",
                    "Vĩnh Long",
                    "Vĩnh Phúc",
                    "Yên Bái"
                );

                foreach ($tinh_thanh as $tinh) {
                    echo '<option value="' . $tinh . '">' . $tinh . '</option>';
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm Khách Hàng</button>
    </form>
</div>