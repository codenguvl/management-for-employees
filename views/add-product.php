<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config/mysql_connection.php';

    $ten_san_pham = $_POST['ten_san_pham'];
    $mo_ta = $_POST['mo_ta'];
    $gia = $_POST['gia'];
    $so_luong_ton_kho = $_POST['so_luong_ton_kho'];

    $upload_dir = "uploads/";
    $target_file = $upload_dir . basename($_FILES["hinh_anh"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["hinh_anh"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    if ($_FILES["hinh_anh"]["size"] > 15500000) {
        echo '<div class="alert alert-warning" role="alert">Size ảnh bạn dăng tải quá lớn</div>';
        $uploadOk = 0;
    }

    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo '<div class="alert alert-warning" role="alert">Xin lỗi, chỉ cho phép các tệp JPG, JPEG, PNG và GIF</div>';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo '<div class="alert alert-warning" role="alert">Rất tiếc, tập tin của bạn chưa được tải lên</div>';
    } else {
        if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {

            $sql = "INSERT INTO SanPham (ten_san_pham, hinh_anh, mo_ta, gia, so_luong_ton_kho) 
                    VALUES ('$ten_san_pham', '$target_file', '$mo_ta', '$gia', '$so_luong_ton_kho')";

            if ($conn->query($sql) === TRUE) {

                echo '<div class="alert alert-success" role="alert">Thêm sản phẩm thành công!</div>';
            } else {
                echo "Thêm sản phẩm thất bại: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $conn->close();
}
?>


<div class="container mt-4">
    <h4>THÊM SẢN PHẨM</h4>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="ten_san_pham" class="form-label">Tên Sản Phẩm</label>
            <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" required>
        </div>
        <div class="mb-3">
            <label for="hinh_anh" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="hinh_anh" name="hinh_anh" required>
        </div>
        <div class="mb-3">
            <label for="mo_ta" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="gia" class="form-label">Giá</label>
            <input type="number" class="form-control" id="gia" name="gia" required>
        </div>
        <div class="mb-3">
            <label for="so_luong_ton_kho" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" class="form-control" id="so_luong_ton_kho" name="so_luong_ton_kho" required>
        </div>
        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </form>
</div>