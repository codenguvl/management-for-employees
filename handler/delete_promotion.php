<?php
include '../config/mysql_connection.php';

try {

    if (isset($_POST['id'])) {

        $promotion_id = $_POST['id'];


        $query_delete = "DELETE FROM KhuyenMai WHERE ma_khuyen_mai = ?";
        $stmt = $conn->prepare($query_delete);
        $stmt->bind_param("i", $promotion_id);


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