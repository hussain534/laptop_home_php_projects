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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion1.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion1.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluado);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADO',
                        backgroundColor:'crimson',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion1");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion2.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion2.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluado);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADO',
                        backgroundColor:'lightgreen',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion2");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion3.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion3.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluado);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADO',
                        backgroundColor:'blue',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion3");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion4.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion4.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluado);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADO',
                        backgroundColor:'magenta',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion4");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion1evaluador.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion1evaluador.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluador);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADOR',
                        backgroundColor:'crimson',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion1evaluador");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion2evaluador.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion2evaluador.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluador);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADOR',
                        backgroundColor:'lightgreen',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion2evaluador");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion3evaluador.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion3evaluador.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluador);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADOR',
                        backgroundColor:'blue',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion3evaluador");
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
    $.ajax({
        //url: "http://localhost/tracker/myChartTipoEvaluacion4evaluador.php",
        url: "https://tracker.ayaanfms.com/myChartTipoEvaluacion4evaluador.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var TipoTarea = [];
            var score = [];
            for(var i in data) {
                TipoTarea.push(data[i].evaluador);
                score.push(data[i].cnt);
            }
            var chartdata = {
                labels: TipoTarea,
                datasets : [
                    {
                        label: 'EVALUADOR',
                        backgroundColor:'magenta',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };
            var ctx = $("#myChartTipoEvaluacion4evaluador");
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
    document.getElementById("paralelodropdown").style.display="none";
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
function buscarComboData() 
{
    idPreg=document.getElementById("idPreg").value;
    //idComp=document.getElementById("idComp").value;
    idComp=0;
    //idTiPa=document.getElementById("idTiPa").value;
    idTiPa=0;
    idTiEv=document.getElementById("idTiEv").value;
    idSec=document.getElementById("idSec").value;
    idEvalo=document.getElementById("idEvalo").value;
    idEvalr=document.getElementById("idEvalr").value;
    //alert(idSec);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=9&task=3&idPreg="+idPreg+"&idComp="+idComp+"&idTiPa="+idTiPa+"&idTiEv="+idTiEv+"&idSec="+idSec+"&idEvalo="+idEvalo+"&idEvalr="+idEvalr, true);
    xmlhttp.send();
}
function buscarListaEvaluacion() 
{
    //alert('inside');
    idDescAno=document.getElementById("idDescAno").value;
    //alert('idDescAno:'+idDescAno);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=11&task=3&idDescAno="+idDescAno, true);
    xmlhttp.send();
}
function registrarSatisfaccionNivel(ctr,idPregunta) 
{
    //alert('inside::'+idPregunta);
    idrespuestaevaluacion=document.getElementById("idrespuestaevaluacion"+ctr).value;
    //alert('idrespuestaevaluacion:'+idrespuestaevaluacion);
    document.getElementById("respuestas").value=document.getElementById("respuestas").value+idPregunta+"~"+idrespuestaevaluacion+"|";
    /*var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            location.reload();
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=12&task=3&idrespuestaevaluacion="+idrespuestaevaluacion+"&idPregunta="+idPregunta, true);
    xmlhttp.send();*/
}
function validateFormDatos() 
{
    //alert("validateFormDatos");
    if(document.getElementById("idSec").value==0)
    {
        alert("Existen campos sin seleccion-SECCION");
        return false;
    }
    else if(document.getElementById("idPreg").value==0)
    {
        alert("Existen campos sin seleccion-PREGUNTA");
        return false;
    }
    else if(document.getElementById("idTiEv").value==0)
    {
        alert("Existen campos sin seleccion-TIPO EVALUACION");
        return false;
    }
    /*else if(document.getElementById("idEvalr").value==0)
    {
        alert("Existen campos sin seleccion-EVALUADOR");
        return false;
    }
    else if(document.getElementById("idEvalo").value==0)
    {
        alert("Existen campos sin seleccion-EVALUADO");
        return false;
    }
    else if(document.getElementById("idEvalo").value==document.getElementById("idEvalr").value)
    {
        alert("EVALUADOR y EVALUADO NO PUEDEN SER MISMOS");
        return false;
    }*/
    else
    {
        //alert("ALL OK");
        return true;
    }
}
function validateSatisfaccionNivel(countPreguntas) 
{
    var res="";
    var x=1;
    for (let i = 0; i < countPreguntas; i++) 
    {
        if(document.getElementById("idrespuestaevaluacion"+i).value==5)
        {
            alert("Existen preguntas sin respuestas");
            res="break";
            x=0;
            break;
        }
        else
        {
            res="continue";
            continue;
        }
    }
    if(x==1 && document.getElementById("respuestas").value!="")
        return true;
    else
    {
        alert("No hubo cambio en data para actualizar");
        return false;
    }
    /*if(x==1)
    {
        res=document.getElementById("respuestas").value;
        //alert("RES:"+res);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                //document.getElementById("idPerfil").value = this.responseText;
                location.reload();
            }
        };
        xmlhttp.open("GET", "controladorProceso.php?proceso=12&task=3&res="+res, true);
        xmlhttp.send();
    }*/
}
function mostrarParalelo() 
{
    //alert('inside');
    idPerfil=document.getElementById("perfil").value;
    //alert(idPerfil);
    if(idPerfil==2)
    {
        document.getElementById("paralelodropdown").style.display="block";
    }
    else
    {
        document.getElementById("paralelodropdown").style.display="none";
        document.getElementById("paralelo").value="1";
    }
}
/*function selectParalelo() 
{
    //alert('inside');
    idparalelo=document.getElementById("idparalelo").value;
    //alert(idPerfil);
    if(idparalelo==1)
    {
        alert("Paralelo aplica solo para estudientes");
        document.getElementById("idparalelo").value=-1;
        document.getElementById("paralelo").value=-1;
    }
    else
    {
        document.getElementById("paralelo").value=idparalelo;
    }
}*/
function validateFormCrearCuenta() 
{
    //alert("validateFormDatos");
    if(document.getElementById("perfil").value==-1)
    {
        alert("Existen campos sin seleccion-PERFIL");
        return false;
    }
    else if(document.getElementById("perfil").value==2)
    {
        if(document.getElementById("idparalelo").value==-1)
        {
            alert("Existen campos sin seleccion-PARALELO");
            document.getElementById("paralelo").value=-1;
            return false;
        }
        else if(document.getElementById("idparalelo").value==1)
        {
            alert("Debes escoger un PARALELO");
            document.getElementById("paralelo").value=-1;
            return false;
        }
        else
        {
            alert("ALL OK 2");
            document.getElementById("paralelo").value=document.getElementById("idparalelo").value;
            return true;
        }
    }
    else
    {
        alert("ALL OK 1");
        return true;
    }
}
function selectSeccion() 
{
    //alert('inside');
    idseccion=document.getElementById("idseccion").value;
    //alert('idseccion:'+idseccion);
    document.getElementById("id").value=0;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            //document.getElementById("idPerfil").value = this.responseText;
            //location.reload();
            window.location.href="preguntas.php";
        }
    };
    xmlhttp.open("GET", "controladorProceso.php?proceso=7&task=3&idseccion="+idseccion, true);
    xmlhttp.send();
}

function sortTableByName() 
{
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[1];
      y = rows[i + 1].getElementsByTagName("TD")[1];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

function sortTableByEmail() 
{
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[2];
      y = rows[i + 1].getElementsByTagName("TD")[2];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}


function sortTableByPerfil() 
{
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[3];
      y = rows[i + 1].getElementsByTagName("TD")[3];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

function sortTableByUbicacion() 
{
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[6];
      y = rows[i + 1].getElementsByTagName("TD")[6];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}

function sortTableByParalelo() 
{
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("myTable");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[7];
      y = rows[i + 1].getElementsByTagName("TD")[7];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch = true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }
}