<?php
include '../config/mysql_connection.php';

if (isset($_POST['id'])) {
    $customer_id = $_POST['id'];

    $query_delete = "DELETE FROM KhachHang WHERE ma_khach_hang = ?";
    $stmt = $conn->prepare($query_delete);
    $stmt->bind_param("i", $customer_id);

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