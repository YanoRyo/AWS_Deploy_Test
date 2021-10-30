<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>OpenClass</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--<script src="node_modules/chartjs/dist/Chart.js"></script>-->
    
</head>
<body>
	<!--<a class="senniButton" href="{{ route('index2') }}">遷移画面</a>-->
	
		
  <h1>レーダーチャート</h1>
  <canvas id="myRaderChart"></canvas>
  <!-- CDN -->
　<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
　<script>
    var ctx = document.getElementById("myRaderChart");
    var myRadarChart = new Chart(ctx, {
        type: 'radar', 
        data: { 
            labels: ["英語", "数学", "国語", "理科", "社会"],
            datasets: [{
                label: 'Aさん',
                data: [{{$que01_num}}, {{$que02_num}}, {{$que03_num}}, {{$que04_num}}, {{$que05_num}}],
                backgroundColor: 'RGBA(225,95,150, 0.5)',
                borderColor: 'RGBA(225,95,150, 1)',
                borderWidth: 1,
                pointBackgroundColor: 'RGB(46,106,177)'
            }]
        },
        options: {
            title: {
                display: true,
                text: '試験成績'
            },
            scale:{
                ticks:{
                    suggestedMin: 0,
                    suggestedMax: 5,
                    stepSize: 1,
                    callback: function(value, index, values){
                        
                        return  value +  '点'
                    }
                }
            }
        }
    });
    </script>
</body>
</html>
