window.setTimeout(function() 
{
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 6000);

$(document).ready(function()
{
    $('img').each(function() 
    {
        $(this).attr('height','600px');
    });

    /*$.ajax({
        url: "http://localhost/m360hd/report_status_por_notification.php?status=31",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'CREADO',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion1");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });*/

    $.ajax({
        url: "http://m360hd.merakiminds.com/report_status_por_notification.php?status=6",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'ATENDIDO',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion2");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                	legend: {
				        display: false
				    },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    /*$.ajax({
        url: "http://localhost/m360hd/report_status_por_notification.php?status=34",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - INTERNO',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion3");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_notification.php?status=45",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - CLIENTE',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion4");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_notification.php?status=46",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - EMAIL',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion5");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_notification.php?status=47",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_notified_through);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - LLAMADA',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorNotificacion6");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });


    $.ajax({
        url: "http://localhost/m360hd/report_status_por_tarea.php?status=31",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'CREADO',
                        backgroundColor:'gold',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea1");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });*/

    $.ajax({
        url: "http://m360hd.merakiminds.com/report_status_por_tarea.php?status=6",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'ATENDIDO',
                        backgroundColor:'aquamarine',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea2");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                	legend: {
					        display: false
					    },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    /*$.ajax({
        url: "http://localhost/m360hd/report_status_por_tarea.php?status=34",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - INTERNO',
                        backgroundColor:'gold',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea3");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_tarea.php?status=45",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - CLIENTE',
                        backgroundColor:'gold',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea4");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_tarea.php?status=46",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - EMAIL',
                        backgroundColor:'gold',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea5");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_tarea.php?status=47",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_type);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - LLAMADA',
                        backgroundColor:'gold',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTarea6");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });



    $.ajax({
        url: "http://localhost/m360hd/report_status_por_appl.php?status=31",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'CREADO',
                        backgroundColor:'#80ff00',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion1");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });*/

    $.ajax({
        url: "http://m360hd.merakiminds.com/report_status_por_appl.php?status=6",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'ATENDIDO',
                        backgroundColor:'#6980c3',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion2");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                	legend: {
					        display: false
					    },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    /*$.ajax({
        url: "http://localhost/m360hd/report_status_por_appl.php?status=34",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - INTERNO',
                        backgroundColor:'#80ff00',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion3");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_appl.php?status=45",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EN ESPERA - CLIENTE',
                        backgroundColor:'#80ff00',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion4");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_appl.php?status=46",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - EMAIL',
                        backgroundColor:'#80ff00',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion5");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

    $.ajax({
        url: "http://localhost/m360hd/report_status_por_appl.php?status=47",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].task_service_appl);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'NOTIFICACION - LLAMADA',
                        backgroundColor:'#80ff00',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorAplicacion6");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata,
                options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
            });
        },
        error: function(data) {
            console.log(data);
        }
    });*/


    $.ajax({
        url: "http://m360hd.merakiminds.com/report_status_por_tiempo.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].category);
                score.push(data[i].cnt);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'ATENDIDO',
                        backgroundColor:["#85bf4b", "#e8d257","#59bdde","#ec3558"],
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'orange',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartEstadosPorTiempo1");

            var barGraph = new Chart(ctx, {
                type: 'pie',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });

});

