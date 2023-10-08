// Định nghĩa dữ liệu cho biểu đồ
var data = {
  labels: ['Thể loại 1', 'Thể loại 2', 'Thể loại 3', 'Thể loại 4', 'Thể loại 5'],
  datasets: [{
    label: 'Số lượng sách',
    data: [20, 15, 10, 8, 12],
    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Màu nền cho cột
    borderColor: 'rgba(54, 162, 235, 1)', // Màu viền cho cột
    borderWidth: 1 // Độ dày viền cho cột
  }]
};

// Cấu hình biểu đồ
var options = {
  scales: {
    y: {
      beginAtZero: true,
      stepSize: 5
    }
  }
};

// Vẽ biểu đồ
var ctx = document.getElementById('bookChart').getContext('2d');
var chart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: options
});