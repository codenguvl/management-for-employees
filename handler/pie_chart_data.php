<?php
include '../config/mysql_connection.php';


$query_customer_count = "SELECT COUNT(*) AS count, dia_chi FROM KhachHang GROUP BY dia_chi";
$result_customer_count = $conn->query($query_customer_count);

$customer_data = array();

while ($row = $result_customer_count->fetch_assoc()) {
    $customer_data[$row['dia_chi']] = $row['count'];
}

echo json_encode($customer_data);
?>