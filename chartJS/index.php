<?php

?>
<head>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
       <!-- <script type="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> -->
</head>
<body>
    <div style="width:900px !important;">
        <canvas id="myChart"></canvas>
    </div>
</body>

<script>

    //line chart
/*var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
    datasets: [{
      label: 'apples',
      data: [12, 19, 3, 17, 6, 3, 7],
      backgroundColor: "rgba(153,255,51,0.4)"
    }, {
      label: 'oranges',
      data: [2, 29, 5, 5, 2, 3, 10],
      backgroundColor: "rgba(255,153,0,0.4)"
    }]
  }
});*/

//Bar chart

var popCanvas = document.getElementById("myChart").getContext("2d");
var barChart = new Chart(popCanvas, {
  type: 'bar',
  data: {
    labels: ["China", "India", "United States", "Indonesia", "Brazil", "Pakistan", "Nigeria", "Bangladesh", "Russia", "Japan"],
    datasets: [{
      label: '2015',
      data: [10,15,8,20,12,18,5,2,25,14],
      backgroundColor: "green"
    },{
      label: '2018',
      data: [9,5,8,12,15,6,12,8,20,17],
      backgroundColor: "red"
    }]
  },
  options: {
      title: {
        display: true,
        text: 'POPULATION'
      }
    }
});


</script>