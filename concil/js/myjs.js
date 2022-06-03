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

    $("#consultarData").click(function()
    {
        //alert('inside');
        consulta_integrador=document.getElementById("consulta_integrador").value;
        //alert(consulta_integrador);
        consulta_fecha_conciliacion=document.getElementById("consulta_fecha_conciliacion").value;
        //alert(consulta_fecha_conciliacion);
        if(consulta_fecha_conciliacion=="")
        {
            alert('FECHA CONCILIACION PARA CONSULTAR DATOS NO DEBE SER NULL');
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //document.getElementById("idPerfil").value = this.responseText;
                    //alert(this.responseText);
                    location.replace(this.responseText);
                    //alert(this.responseText);
                }
            };
            xmlhttp.open("GET", "controladorProceso.php?proceso=3&task=1&consulta_integrador="+consulta_integrador+"&consulta_fecha_conciliacion="+consulta_fecha_conciliacion, true);
            xmlhttp.send();
        }
        
    });

    $("#consultarAlepo").click(function()
    {
        //alert('inside');
        consulta_integrador=document.getElementById("consulta_integrador").value;
        //alert(consulta_integrador);
        consulta_fecha_conciliacion=document.getElementById("consulta_fecha_conciliacion").value;
        //alert(consulta_fecha_conciliacion);
        if(consulta_fecha_conciliacion=="")
        {
            alert('FECHA CONCILIACION PARA CONSULTAR DATOS NO DEBE SER NULL');
        }
        else
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    //document.getElementById("idPerfil").value = this.responseText;
                    location.reload();
                    //alert(this.responseText);
                }
            };
            xmlhttp.open("GET", "controladorProceso.php?proceso=3&task=4&consulta_integrador="+consulta_integrador+"&consulta_fecha_conciliacion="+consulta_fecha_conciliacion, true);
            xmlhttp.send();
        }
        
    }); 


    $.ajax({
        url: "https://conciliacion-metrowifi.etapa.net.ec/monitor-data-usercpu.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].data_entry_time);
                score.push(data[i].stat);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'CPU - USUARIO',
                        backgroundColor:'ivory',
                        borderColor: 'ivory',
                        borderWidth: 2,
                        data: score,
                        fill: false
                    }
                ]
            };

            var ctx = $("#monitor-usercpu");

            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'CPU - USUARIO',
                                fontColor: 'ivory'
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: 'ivory',
                                        max: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontColor: 'ivory'
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
        url: "https://conciliacion-metrowifi.etapa.net.ec/monitor-data-systemcpu.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].data_entry_time);
                score.push(data[i].stat);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'CPU - SYSTEM',
                        backgroundColor:'ivory',
                        borderColor: 'ivory',
                        borderWidth: 2,
                        data: score,
                        fill: false
                    }
                ]
            };

            var ctx = $("#monitor-systemcpu");

            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'SYSTEM - CPU',
                                fontColor: 'ivory'
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: 'ivory',
                                        max: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontColor: 'ivory'
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
        url: "https://conciliacion-metrowifi.etapa.net.ec/monitor-data-memoryfisico.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].data_entry_time);
                score.push(data[i].stat);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'MEMORY - FISICO',
                        backgroundColor:'ivory',
                        borderColor: 'ivory',
                        borderWidth: 2,
                        data: score,
                        fill: false
                    }
                ]
            };

            var ctx = $("#monitor-memoryfisico");

            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'MEMORY - FISICO',
                                fontColor: 'ivory'
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: 'ivory',
                                        max: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontColor: 'ivory'
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
        url: "https://conciliacion-metrowifi.etapa.net.ec/monitor-data-memorypaging.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];

            for(var i in data) {
                TipoTarea.push(data[i].data_entry_time);
                score.push(data[i].stat);
            }

            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'MEMORY - PAGING',
                        backgroundColor:'ivory',
                        borderColor: 'ivory',
                        borderWidth: 2,
                        data: score,
                        fill: false
                    }
                ]
            };

            var ctx = $("#monitor-memorypaging");

            var barGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                            responsive: true,
                            title: {
                                display: true,
                                text: 'MEMORY - PAGING',
                                fontColor: 'ivory'
                            },
                            legend: {
                                display: false
                            },
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        drawBorder: false,
                                        color: 'grey'
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        fontColor: 'ivory',
                                        max: 100
                                    }
                                }],
                                xAxes: [{
                                    ticks: {
                                        fontColor: 'ivory'
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

    
});

function buscarPermisos() 
{
    //alert('inside');
    idPerfil=document.getElementById("idPerfil").value;
    //alert(idPerfil);
    idMenu=document.getElementById("idMenu").value;
    //alert(idMenu);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=6&task=3&idPerfil="+idPerfil+"&idMenu="+idMenu, true);
    xmlhttp.send();
}