window.setTimeout(function() {
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
    $('#busquedaBtn').click(function() 
    {
        var x=parseInt(document.getElementById('busquedaBtnValue').value);
        //alert(x);
        if(x==1)
            document.getElementById('busquedaBtn').innerHTML="CERRAR PANEL DE BUSQUEDA";
        else
            document.getElementById('busquedaBtn').innerHTML="ABRIR PANEL DE BUSQUEDA";
        document.getElementById('busquedaBtnValue').value=document.getElementById('busquedaBtnValue').value*(-1);
    });

    
    /*var x = document.getElementById("taskOwner");
    var perfil = document.getElementById("userDropDownValue").value;
    var i;
    for (i = 0; i < x.length; i++) 
    {
        if(x.options[i].value==perfil)
            x.selectedIndex=i;
    }*/




    $.ajax({
        url: "http://9.13.45.88/sit/report_daily.php?pid=1",
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
                        label: 'MULTICANALIDAD',
                        backgroundColor:'aquamarine',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChart1");

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
        url: "http://9.13.45.88/sit/report_daily.php?pid=2",
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
                        label: 'PORTAL',
                        backgroundColor:'aquamarine',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChart2");

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
        url: "http://9.13.45.88/sit/report_daily.php?pid=3",
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
                        label: 'CONTINGENCIA',
                        backgroundColor:'aquamarine',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChart3");

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
        url: "http://9.13.45.88/sit/report_daily.php?pid=4",
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
                        label: 'OTROS',
                        backgroundColor:'aquamarine',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChart4");

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
        url: "http://9.13.45.88/sit/report_weekly.php?pid=1",
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
                        label: 'MULTICANALIDAD',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartWeekly1");

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
        url: "http://9.13.45.88/sit/report_weekly.php?pid=2",
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
                        label: 'PORTAL',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartWeekly2");

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
        url: "http://9.13.45.88/sit/report_weekly.php?pid=3",
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
                        label: 'CONTINGENCIA',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartWeekly3");

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
        url: "http://9.13.45.88/sit/report_weekly.php?pid=4",
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
                        label: 'OTROS',
                        backgroundColor:'darkcyan',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartWeekly4");

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
        url: "http://9.13.45.88/sit/report_monthly.php?pid=1",
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
                        label: 'MULTICANALIDAD',
                        backgroundColor:'orange',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartMonthly1");

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
        url: "http://9.13.45.88/sit/report_monthly.php?pid=2",
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
                        label: 'PORTAL',
                        backgroundColor:'orange',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartMonthly2");

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
        url: "http://9.13.45.88/sit/report_monthly.php?pid=3",
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
                        label: 'CONTINGENCIA',
                        backgroundColor:'orange',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartMonthly3");

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
        url: "http://9.13.45.88/sit/report_monthly.php?pid=4",
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
                        label: 'OTROS',
                        backgroundColor:'orange',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#myChartMonthly4");

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


});




function getLocation() 
{
    alert("Get Location");
    if (navigator.geolocation) 
    {
        alert("IF");
        navigator.geolocation.getCurrentPosition(showPosition, showError);
        alert("END IF");
    } 
    else 
    { 
        alert("ELSE");
        x.innerHTML = "Geolocation is not supported by this browser.";

    }
    alert("OUTSIDE");
}

function showPosition(position) 
{
    alert("HI");
    alert("Set Location:LAT:"+position.coords.latitude);
    alert("Set Location:LON:"+position.coords.longitude);
    document.getElementById('rn_latitude').value = position.coords.latitude;
    document.getElementById('rn_longitude').value = position.coords.longitude;
    alert("HI-1");
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    alert("HI-2");
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '250px';
    mapholder.style.width = '100%';
    alert("HI-3");
    var myOptions = {
    center:latlon,zoom:16,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    alert("HI-4");
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
    alert("HI-5");
}


function showMap(element) 
{   
            //alert("HI-3:"+window.document.getElementById("sector").value);
            var ln=window.document.getElementById("sector").value.split(":");
            var latitud_longitud = ln[1].split(",");
            //alert("HI-31:"+latitud_longitud[0]);
            //alert("HI-32:"+latitud_longitud[1]);
            latlon=new google.maps.LatLng(latitud_longitud[0],latitud_longitud[1]);
            //latlon=new google.maps.LatLng(-0.1815911,-78.5085319);
            
            //latlon=new google.maps.LatLng(window.document.getElementById("mapLatLon").value.trim());
            mapholder = document.getElementById('mapa')
            mapholder.style.minHeight  = '250px';
            mapholder.style.width = '100%';
            
            var myOptions = {
            center:latlon,zoom:17,
            mapTypeId:google.maps.MapTypeId.ROADMAP,
            mapTypeControl:false,
            navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
            }
            //alert("HI-4");
            var map = new google.maps.Map(document.getElementById("mapa"), myOptions);
            //alert();
            var marker = new google.maps.Marker({position:latlon,label:element.options[element.selectedIndex].text,map:map,title:"You are here!"});
            //alert("HI-5");
}

function showError(error) 
{
    
    switch(error.code) 
    {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
        default: alert("Error:");
    }
}

