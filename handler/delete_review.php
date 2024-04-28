<?php
include '../config/mysql_connection.php';


if (isset($_POST['id'])) {
    $review_id = $_POST['id'];


    $query_delete = "DELETE FROM DanhGia WHERE ma_danh_gia = ?";
    $stmt = $conn->prepare($query_delete);
    $stmt->bind_param("i", $review_id);


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
?>