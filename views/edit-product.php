<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'config/mysql_connection.php';


    $id = $_POST['id'];
    $ten_san_pham = $_POST['ten_san_pham'];
    $mo_ta = $_POST['mo_ta'];
    $gia = $_POST['gia'];
    $so_luong_ton_kho = $_POST['so_luong_ton_kho'];


    if ($_FILES["hinh_anh"]["name"]) {
        $upload_dir = "uploads/";
        $target_file = $upload_dir . basename($_FILES["hinh_anh"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


        if ($_FILES["hinh_anh"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            exit();
        }


        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        if (move_uploaded_file($_FILES["hinh_anh"]["tmp_name"], $target_file)) {

            $delete_old_image_query = "SELECT hinh_anh FROM SanPham WHERE ma_san_pham=$id";
            $old_image_result = $conn->query($delete_old_image_query);
            if ($old_image_result->num_rows > 0) {
                $old_image_row = $old_image_result->fetch_assoc();
                $old_image_path = $old_image_row['hinh_anh'];
                unlink($old_image_path);
            }


            $target_file = htmlspecialchars($target_file);
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {

        $target_file = $_POST['hinh_anh_old'];
    }


    $sql = "UPDATE SanPham SET ten_san_pham='$ten_san_pham', hinh_anh='$target_file', mo_ta='$mo_ta', gia='$gia', so_luong_ton_kho='$so_luong_ton_kho' WHERE ma_san_pham=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                Swal.fire({
                    title: 'Cập nhật thành công!',
                    text: 'Thông tin sản phẩm đã được cập nhật thành công.',
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    window.location.href = './?page=view-products';
                });
            </script>";
        exit();
    } else {
        echo "Cập nhật sản phẩm thất bại: " . $conn->error;
    }

    $conn->close();
} else {
    include 'config/mysql_connection.php';

    $id = $_GET['id'];

    $query_product = "SELECT * FROM SanPham WHERE ma_san_pham=$id";
    $result_product = $conn->query($query_product);

    if ($result_product->num_rows > 0) {
        $row = $result_product->fetch_assoc();
        $ten_san_pham = $row['ten_san_pham'];
        $hinh_anh = $row['hinh_anh'];
        $mo_ta = $row['mo_ta'];
        $gia = $row['gia'];
        $so_luong_ton_kho = $row['so_luong_ton_kho'];
        ?>

        <div class="container mt-4">
            <h4>CHỈNH SỬA SẢN PHẨM</h4>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="hinh_anh_old" value="<?php echo $hinh_anh; ?>">
                <div class="mb-3">
                    <label for="ten_san_pham" class="form-label">Tên Sản Phẩm</label>
                    <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham"
                        value="<?php echo $ten_san_pham; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="hinh_anh" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" id="hinh_anh" name="hinh_anh">
                    <img src="<?php echo $hinh_anh; ?>" alt="Product Image" style="max-width: 200px; max-height: 200px;">
                </div>
                <div class="mb-3">
                    <label for="mo_ta" class="form-label">Mô Tả</label>
                    <textarea class="form-control" id="mo_ta" name="mo_ta" rows="3" required><?php echo $mo_ta; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="gia" class="form-label">Giá</label>
                    <input type="number" class="form-control" id="gia" name="gia" value="<?php echo $gia; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="so_luong_ton_kho" class="form-label">Số Lượng Tồn Kho</label>
                    <input type="number" class="form-control" id="so_luong_ton_kho" name="so_luong_ton_kho"
                        value="<?php echo $so_luong_ton_kho; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
            </form>
        </div>
        <?php
    } else {
        echo "Không tìm thấy sản phẩm!";
    }
}
?>