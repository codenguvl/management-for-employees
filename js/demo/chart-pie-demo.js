/* // Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Nunito"),
  '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = "#858796";

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

// Gửi yêu cầu Ajax để lấy dữ liệu từ máy chủ
var xhr = new XMLHttpRequest();
xhr.open("GET", "handler/pie_chart_data.php", true);
xhr.onload = function () {
  if (xhr.status >= 200 && xhr.status < 300) {
    var data = JSON.parse(xhr.responseText);
    var labels = Object.keys(data);
    var values = Object.values(data);

    var myPieChart = new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: labels,
        datasets: [
          {
            data: values,
            backgroundColor: ["#4e73df", "#1cc88a", "#36b9cc"], // Màu sắc có thể thay đổi tùy theo nhu cầu
            hoverBackgroundColor: ["#2e59d9", "#17a673", "#2c9faf"],
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
  } else {
    console.error(xhr.statusText);
  }
};
xhr.onerror = function () {
  console.error(xhr.statusText);
};
xhr.send();
 */
