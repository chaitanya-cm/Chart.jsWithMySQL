<?php 
include_once 'db.php';

$que = "Select * from fchartdb";
$result = mysqli_query($conn, $que);
$count=mysqli_num_rows($result);
	// Date x axis
	// Rank	y axis
	$rank = array();
	$date = array();
	$symbol = array();
if($count> 0){
		while ($row = mysqli_fetch_array($result)) {
			$rank[] = $row['rank'];
			$date[] = $row['date'];
			$symbol[] = $row['symbol'];
	}
}else{
	echo "No records...!";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chart.js</title>
</head>
<body>
	<h1>Data Visulization Using Chart.js and MySQL</h1>
	<button onclick="linechart();" id="linebtn">Line Chart</button>
	<button onclick="barchart();" id="barbtn">Bar Chart</button>
<div class="ChartBox">
  <canvas id="myChart1"></canvas>
   <canvas id="myChart2"></canvas>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
  const ctx = document.getElementById('myChart');

  //setup Block
  const rank = <?php echo json_encode($rank) ?>;
  const date = <?php echo json_encode($date) ?>;
  const symbol = <?php echo json_encode($symbol) ?>;

  const data ={
  	labels: date,
      datasets: [{
        label: 'Rank',
        data: rank,

        borderWidth: 1,
      }]
  };
  //config block
  const config = {
  	type: 'line',
    data,
    options: {
      scales: {
        y: {
        	grid: { color: '#808080',beginAtZero: true,}
        	
        	// grid:{
        	// 	color:'white'
        	// }
        },
        
      }
    }
  };

   const config1 = {
  	type: 'bar',
    data,
    options: {
      scales: {
        y: {
        	grid: { color: '#808080',beginAtZero: true,}
        	
        	// grid:{
        	// 	color:'white'
        	// }
        },
        
      }
    }
  };

  //Render Block
  var chart1 = document.getElementById('myChart1');
  var chart2 = document.getElementById('myChart2');
  function linechart() {
  	// body...
	
  	if(chart1.style.display =='block' || chart2.style.display=='block'){
  		chart2.style.display = 'none';
  		chart1.style.display = 'block';
  	}else{
  		chart1.style.display = 'block';
  	}

  	const myChart = new Chart(
  	document.getElementById('myChart1'),
  	config
  );

  }

  function barchart() {
  	
  	if(chart2.style.display =='block' || chart1.style.display=='block'){
  		chart1.style.display = 'none';
  		chart2.style.display = 'block';
  	}else{
  		chart2.style.display = 'block';
  	}
  	// body...
  	const myChart = new Chart(
  	document.getElementById('myChart2'),
  	config1
  );
  }
  
</script>

</body>
</html>