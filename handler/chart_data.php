<?php
include '../config/mysql_connection.php'; 

$current_month = date('m');

$query_earnings_overview = "SELECT DAY(ngay_dat_hang) AS day, SUM(tong_tien) AS earnings FROM DonHang WHERE MONTH(ngay_dat_hang) = $current_month GROUP BY DAY(ngay_dat_hang)";
$result_earnings_overview = $conn->query($query_earnings_overview);
$earnings_overview_data = array();
while ($row = $result_earnings_overview->fetch_assoc()) {
    $earnings_overview_data[$row['day']] = $row['earnings'];
}

echo json_encode($earnings_overview_data);