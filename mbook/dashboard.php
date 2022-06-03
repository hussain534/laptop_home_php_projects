<?php
    session_start();
    include_once('util.php');
    include_once('logopanel.php');
    if(isset($_GET["err"]))
        $err=$_GET["err"];
    else 
        $err=1;
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10  links text-right">
            <a href="home.php">Home</a>
            <a href="dashboard.php"> <span class="glyphicon glyphicon-chevron-right"></span> Dashboard</a>
        </div>
        <div class="col-sm-1"></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12 text-center"><h1>Dashboard</h1></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 chart_back">
                    <div>
                        <canvas id="myChart1"></canvas>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10 chart_back">
                    <div>
                        <canvas id="myChart2"></canvas>
                    </div>
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>
    </div>    
   
</div>

<script>

//line chart
var ctx = document.getElementById('myChart1').getContext('2d');
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
});


//Bar chart

var popCanvas = document.getElementById("myChart2").getContext("2d");
var barChart = new Chart(popCanvas, {
  type: 'bar',
  data: {
    labels: ["China", "India", "United States", "Indonesia", "Brazil", "Pakistan", "Nigeria", "Bangladesh", "Russia", "Japan"],
    datasets: [{
      label: '2015',
      data: [10,15,8,20,12,18,5,2,25,14],
      backgroundColor: "gold"
    },{
      label: '2018',
      data: [9,5,8,12,15,6,12,8,20,17],
      backgroundColor: "red"
    }]
  },
  options: {
      title: {
        display: true,
        text: 'USERS'
      }
    }
});

var popCanvas = document.getElementById("myChart2").getContext("2d");
var barChart = new Chart(popCanvas, {
  type: 'bar',
  data: {
    labels: ["China", "India", "United States", "Indonesia", "Brazil", "Pakistan", "Nigeria", "Bangladesh", "Russia", "Japan"],
    datasets: [{
      label: '2015',
      data: [10,15,8,20,12,18,5,2,25,14],
      backgroundColor: "gold"
    },{
      label: '2018',
      data: [9,5,8,12,15,6,12,8,20,17],
      backgroundColor: "red"
    }]
  },
  options: {
      title: {
        display: true,
        text: 'USERS'
      }
    }
});


</script>