<?php
include '../config/mysql_connection.php';

try {

    if (isset($_POST['id'])) {

        $product_id = $_POST['id'];
        $query_delete_comments = "DELETE FROM DanhGia WHERE ma_san_pham = ?";
        $stmt_comments = $conn->prepare($query_delete_comments);
        $stmt_comments->bind_param("i", $product_id);
        $stmt_comments->execute();
        $stmt_comments->close();


        $query_delete = "DELETE FROM SanPham WHERE ma_san_pham = ?";
        $stmt = $conn->prepare($query_delete);
        $stmt->bind_param("i", $product_id);


        if ($stmt->execute()) {

            echo "success";
        } else {

            echo "error";
        }


        $stmt->close();
        $conn->close();
    } else {

        echo "error";
    }
} catch (Exception $e) {

    echo "error: " . $e->getMessage();
}
?>