<?php
require_once('index.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radar Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="radarChart" width="300" height="300"></canvas>

    <script>
    // PHP에서 가져온 데이터를 JavaScript 변수에 저장합니다.
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo $data; ?>;
   
    // Chart.js를 사용하여 레이더 차트를 생성합니다.
    var ctx = document.getElementById('radarChart').getContext('2d');
    var radarChart = new Chart(ctx, {
        type: 'radar',
        data: {
            labels: labels,
            datasets: [{
                label: 'SCAN 1',
                data: data
            }]
        },
        options: {
            scale: {
                r: {
                    beginAtZero: true,
                    min: 0, // 최소값 설정
                    max: 4, // 최대값 설정
                
                }
            }
        }
    });
    </script>
</body>
</html>

