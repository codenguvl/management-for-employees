Chart.defaults.global.defaultFontFamily = "Nunito";
Chart.defaults.global.defaultFontColor = "#858796";

var ctxArea = document.getElementById("myAreaChart");
var ctxPie = document.getElementById("myPieChart");
var colors = {
  "An Giang": "#FF5733",
  "Bà Rịa - Vũng Tàu": "#FFBD33",
  "Bắc Giang": "#33FF45",
  "Bắc Kạn": "#7B68EE",
  "Bạc Liêu": "#00FF7F",
  "Bắc Ninh": "#6495ED",
  "Bến Tre": "#DC143C",
  "Bình Định": "#9932CC",
  "Bình Dương": "#FF8C00",
  "Bình Phước": "#20B2AA",
  "Bình Thuận": "#00CED1",
  "Cà Mau": "#FF00FF",
  "Cần Thơ": "#BA55D3",
  "Cao Bằng": "#B0C4DE",
  "Đà Nẵng": "#32CD32",
  "Đắk Lắk": "#800000",
  "Đắk Nông": "#FF1493",
  "Điện Biên": "#1E90FF",
  "Đồng Nai": "#8A2BE2",
  "Đồng Tháp": "#FF4500",
  "Gia Lai": "#008080",
  "Hà Giang": "#3CB371",
  "Hà Nam": "#FFD700",
  "Hà Nội": "#4169E1",
  "Hà Tĩnh": "#FA8072",
  "Hải Dương": "#00FFFF",
  "Hải Phòng": "#FF69B4",
  "Hậu Giang": "#B22222",
  "Hòa Bình": "#7FFF00",
  "Hưng Yên": "#FF4500",
  "Khánh Hòa": "#9ACD32",
  "Kiên Giang": "#FFA500",
  "Kon Tum": "#FF6347",
  "Lai Châu": "#40E0D0",
  "Lâm Đồng": "#8B008B",
  "Lạng Sơn": "#FF7F50",
  "Lào Cai": "#20B2AA",
  "Long An": "#FFD700",
  "Nam Định": "#6495ED",
  "Nghệ An": "#DDA0DD",
  "Ninh Bình": "#B0E0E6",
  "Ninh Thuận": "#FF6347",
  "Phú Thọ": "#DA70D6",
  "Phú Yên": "#FFA07A",
  "Quảng Bình": "#FFFF00",
  "Quảng Nam": "#CD5C5C",
  "Quảng Ngãi": "#00FF7F",
  "Quảng Ninh": "#D2B48C",
  "Quảng Trị": "#FF4500",
  "Sóc Trăng": "#FF1493",
  "Sơn La": "#2E8B57",
  "Tây Ninh": "#87CEEB",
  "Thái Bình": "#4682B4",
  "Thái Nguyên": "#8B4513",
  "Thanh Hóa": "#8FBC8F",
  "Thừa Thiên Huế": "#FFD700",
  "Tiền Giang": "#4B0082",
  "TP Hồ Chí Minh": "#FF69B4",
  "Trà Vinh": "#8A2BE2",
  "Tuyên Quang": "#00FF00",
  "Vĩnh Long": "#FFD700",
  "Vĩnh Phúc": "#FF6347",
  "Yên Bái": "#00FFFF",
};
Promise.all([
  fetch("handler/chart_data.php"),
  fetch("handler/pie_chart_data.php"),
])
  .then(function (responses) {
    return Promise.all(
      responses.map(function (response) {
        if (!response.ok) {
          throw Error(response.statusText);
        }
        return response.json();
      })
    );
  })
  .then(function (data) {
    // Data[0] là dữ liệu cho biểu đồ area
    var labelsArea = Object.keys(data[0]);
    var valuesArea = Object.values(data[0]);

    // Data[1] là dữ liệu cho biểu đồ pie
    var labelsPie = Object.keys(data[1]);
    var valuesPie = Object.values(data[1]);

    // Vẽ biểu đồ area
    var myLineChart = new Chart(ctxArea, {
      type: "line",
      data: {
        labels: labelsArea,
        datasets: [
          {
            label: "Earnings",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: valuesArea,
          },
        ],
      },
      options: {},
    });

    var backgroundColor = [];
    var hoverBackgroundColor = [];
    for (var i = 0; i < labelsPie.length; i++) {
      var color = colors[labelsPie[i]]; // Lấy màu tương ứng với tỉnh thành
      backgroundColor.push(color);
      hoverBackgroundColor.push(color);
    }
    var myPieChart = new Chart(ctxPie, {
      type: "doughnut",
      data: {
        labels: labelsPie,
        datasets: [
          {
            data: valuesPie,
            backgroundColor: backgroundColor,
            hoverBackgroundColor: hoverBackgroundColor,
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false,
        },
        cutoutPercentage: 80,
      },
    });
  })
  .catch(function (error) {
    console.error("Fetch error:", error);
  });
