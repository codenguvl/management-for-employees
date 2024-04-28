<div class="container mt-4" id="content">

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">

            <?php

            $query_monthly_earnings = "SELECT SUM(tong_tien) AS monthly_earnings FROM DonHang WHERE MONTH(ngay_dat_hang) = MONTH(CURRENT_DATE)";
            $query_annual_earnings = "SELECT SUM(tong_tien) AS annual_earnings FROM DonHang WHERE YEAR(ngay_dat_hang) = YEAR(CURRENT_DATE)";
            $query_pending_requests = "SELECT COUNT(*) AS pending_requests FROM DonHang WHERE trang_thai = 'Đang Xử Lý'";


            $result_monthly_earnings = $conn->query($query_monthly_earnings);
            $result_annual_earnings = $conn->query($query_annual_earnings);
            $result_pending_requests = $conn->query($query_pending_requests);


            if ($result_monthly_earnings && $result_annual_earnings && $result_pending_requests) {

                $row_monthly_earnings = $result_monthly_earnings->fetch_assoc();
                $row_annual_earnings = $result_annual_earnings->fetch_assoc();
                $row_pending_requests = $result_pending_requests->fetch_assoc();

                ?>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        DOANH THU THÁNG</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $row_monthly_earnings['monthly_earnings']; ?>đ
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        DOANH THU NĂM</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $row_annual_earnings['annual_earnings']; ?>đ
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">ĐƠN HÀNG CHƯA XỬ LÝ
                                    </div>
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                <?php echo $row_pending_requests['pending_requests']; ?>%
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="progress progress-sm mr-2">
                                                <div class="progress-bar bg-info" role="progressbar"
                                                    style="width: <?php echo $row_pending_requests['pending_requests']; ?>%"
                                                    aria-valuenow="<?php echo $row_pending_requests['pending_requests']; ?>"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            } else {

                echo "Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu.";
            }
            ?>




            <div class="row">


                <div class="col-xl-8 col-lg-7">
                    <div class="card h-100 shadow mb-4">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Thống kê đơn hàng</h6>
                        </div>

                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-5">
                    <div class="card h-100 shadow mb-4">

                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Thống kê khách hàng</h6>

                        </div>

                        <div class="card-body">
                            <div class="chart-pie pt-4 pb-2">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            <div class="mt-4 text-center small">
                                <?php
                                $query = "SELECT COUNT(*) AS count, dia_chi FROM KhachHang GROUP BY dia_chi";
                                $result = $conn->query($query);

                                $colors = array(
                                    "An Giang" => "#FF5733",
                                    "Bà Rịa - Vũng Tàu" => "#FFBD33",
                                    "Bắc Giang" => "#33FF45",
                                    "Bắc Kạn" => "#7B68EE",
                                    "Bạc Liêu" => "#00FF7F",
                                    "Bắc Ninh" => "#6495ED",
                                    "Bến Tre" => "#DC143C",
                                    "Bình Định" => "#9932CC",
                                    "Bình Dương" => "#FF8C00",
                                    "Bình Phước" => "#20B2AA",
                                    "Bình Thuận" => "#00CED1",
                                    "Cà Mau" => "#FF00FF",
                                    "Cần Thơ" => "#BA55D3",
                                    "Cao Bằng" => "#B0C4DE",
                                    "Đà Nẵng" => "#32CD32",
                                    "Đắk Lắk" => "#800000",
                                    "Đắk Nông" => "#FF1493",
                                    "Điện Biên" => "#1E90FF",
                                    "Đồng Nai" => "#8A2BE2",
                                    "Đồng Tháp" => "#FF4500",
                                    "Gia Lai" => "#008080",
                                    "Hà Giang" => "#3CB371",
                                    "Hà Nam" => "#FFD700",
                                    "Hà Nội" => "#4169E1",
                                    "Hà Tĩnh" => "#FA8072",
                                    "Hải Dương" => "#00FFFF",
                                    "Hải Phòng" => "#FF69B4",
                                    "Hậu Giang" => "#B22222",
                                    "Hòa Bình" => "#7FFF00",
                                    "Hưng Yên" => "#FF4500",
                                    "Khánh Hòa" => "#9ACD32",
                                    "Kiên Giang" => "#FFA500",
                                    "Kon Tum" => "#FF6347",
                                    "Lai Châu" => "#40E0D0",
                                    "Lâm Đồng" => "#8B008B",
                                    "Lạng Sơn" => "#FF7F50",
                                    "Lào Cai" => "#20B2AA",
                                    "Long An" => "#FFD700",
                                    "Nam Định" => "#6495ED",
                                    "Nghệ An" => "#DDA0DD",
                                    "Ninh Bình" => "#B0E0E6",
                                    "Ninh Thuận" => "#FF6347",
                                    "Phú Thọ" => "#DA70D6",
                                    "Phú Yên" => "#FFA07A",
                                    "Quảng Bình" => "#FFFF00",
                                    "Quảng Nam" => "#CD5C5C",
                                    "Quảng Ngãi" => "#00FF7F",
                                    "Quảng Ninh" => "#D2B48C",
                                    "Quảng Trị" => "#FF4500",
                                    "Sóc Trăng" => "#FF1493",
                                    "Sơn La" => "#2E8B57",
                                    "Tây Ninh" => "#87CEEB",
                                    "Thái Bình" => "#4682B4",
                                    "Thái Nguyên" => "#8B4513",
                                    "Thanh Hóa" => "#8FBC8F",
                                    "Thừa Thiên Huế" => "#FFD700",
                                    "Tiền Giang" => "#4B0082",
                                    "TP Hồ Chí Minh" => "#FF69B4",
                                    "Trà Vinh" => "#8A2BE2",
                                    "Tuyên Quang" => "#00FF00",
                                    "Vĩnh Long" => "#FFD700",
                                    "Vĩnh Phúc" => "#FF6347",
                                    "Yên Bái" => "#00FFFF"
                                );



                                if ($result) {

                                    $customer_data = array();


                                    while ($row = $result->fetch_assoc()) {
                                        $customer_data[$row['dia_chi']] = $row['count'];
                                    }


                                    if (!empty($customer_data)) {
                                        foreach ($customer_data as $city => $count) {
                                            $color = isset($colors[$city]) ? $colors[$city] : "#000000";
                                            echo '<span class="mr-2" style="margin-right: 10px;">';
                                            echo '<i class="fas fa-circle" style="color:' . $color . '"></i> ' . $city;
                                            echo '</span>';
                                        }
                                    } else {
                                        echo "Không có dữ liệu khách hàng.";
                                    }

                                } else {

                                    echo "Đã xảy ra lỗi khi truy vấn cơ sở dữ liệu.";
                                }


                                $conn->close();
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


    <script src="js/sb-admin-2.min.js"></script>


    <script src="vendor/chart.js/Chart.min.js"></script>


    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>