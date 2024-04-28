<?php
include '../config/mysql_connection.php';

if (isset($_POST['id'])) {
    $order_id = $_POST['id'];

    $query_delete_details = "DELETE FROM ChiTietDonHang WHERE ma_don_hang = ?";
    $stmt_details = $conn->prepare($query_delete_details);
    $stmt_details->bind_param("i", $order_id);

    if ($stmt_details->execute()) {
        $query_delete_order = "DELETE FROM DonHang WHERE ma_don_hang = ?";
        $stmt_order = $conn->prepare($query_delete_order);
        $stmt_order->bind_param("i", $order_id);

        if ($stmt_order->execute()) {
            echo "success";
        } else {
            echo "error";
        }

        $stmt_order->close();
    } else {
        echo "error";
    }

    $stmt_details->close();
    $conn->close();
} else {

    echo "error";
}
?>