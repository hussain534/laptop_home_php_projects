$(document).ready(function()
{
	$('[data-toggle="popover"]').popover();  

    $("#fullscreenOff").hide(); 


	$("#addNode").click(function () 
    {   
    	//alert("HI");
        var validateMandatoryFields=0;


        var node_id = window.document.getElementById("node_id").value;
        var node_name = window.document.getElementById("node_name").value;
        var node_desc = window.document.getElementById("node_desc").value;
        var node_type = window.document.getElementById("node_type").value;
        var flow_id = window.document.getElementById("id").value;

        if(node_id==null || node_id=='')
        {
            document.getElementById("error_node_id").innerHTML = "ENTER NODE ID!";
            validateMandatoryFields=1;
        }
        else
            document.getElementById("error_node_id").innerHTML = "";
        

        if(node_name==null || node_name=='')
        {
            document.getElementById("error_node_name").innerHTML = "ENTER NODE NAME!";
            validateMandatoryFields=2;
        }
        else
            document.getElementById("error_node_name").innerHTML = "";

        if(node_desc==null || node_desc=='')
        {
            document.getElementById("error_node_desc").innerHTML = "ENTER NODE DESCRIPTION!";
            validateMandatoryFields=3;
        }
        else
            document.getElementById("error_node_desc").innerHTML = "";

        if(node_type==0)
        {
            document.getElementById("error_node_type").innerHTML = "SELECT NODE TYPE!";
            validateMandatoryFields=4;
        }
        else
            document.getElementById("error_node_type").innerHTML = "";
        
        //alert(flow_id);
        if(validateMandatoryFields==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=1&node_id="+node_id+"&node_name="+node_name+"&node_desc="+node_desc+"&node_type="+node_type+"&flow_id="+flow_id, true);
            //alert(destino);
            xmlhttp.send();
        }
    });


    $("#addConnector").click(function () 
    {   
        //alert("HI");
        var validateMandatoryFields=0;


        var from_node = window.document.getElementById("from_node").value;
        var to_node = window.document.getElementById("to_node").value;
        var conn_label = window.document.getElementById("conn_label").value;
        var conn_type = window.document.getElementById("conn_type").value;
        var flow_id = window.document.getElementById("id").value;

        if(from_node==null || from_node=='')
        {
            document.getElementById("error_from_node").innerHTML = "ENTER FROM NODE!";
            validateMandatoryFields=1;
        }
        else
            document.getElementById("error_from_node").innerHTML = "";
        

        if(to_node==null || to_node=='')
        {
            document.getElementById("error_to_node").innerHTML = "ENTER NODE NAME!";
            validateMandatoryFields=2;
        }
        else
            document.getElementById("error_to_node").innerHTML = "";

        if(conn_type==0)
        {
            document.getElementById("error_conn_type").innerHTML = "SELECT NODE TYPE!";
            validateMandatoryFields=4;
        }
        else
            document.getElementById("error_conn_type").innerHTML = "";
        
        //alert(flow_id);
        if(validateMandatoryFields==0)
        {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    location.reload();
                }
            };

            xmlhttp.open("GET", "datacontroller.php?dojob=2&metodo=2&from_node="+from_node+"&to_node="+to_node+"&conn_label="+conn_label+"&conn_type="+conn_type+"&flow_id="+flow_id, true);
            //alert(destino);
            xmlhttp.send();
        }
    });

    
    $("#fullscreenOn").click(function () 
    {
        $("#myInput").hide();
        $("#flowPanel").removeClass("col-sm-6").addClass("col-sm-12");
        $("#fullscreenOn").hide();
        $("#fullscreenOff").show();
    });

    $("#fullscreenOff").click(function () 
    {
        $("#flowPanel").removeClass("col-sm-12").addClass("col-sm-6");
        $("#myInput").show();
        $("#fullscreenOff").hide();
        $("#fullscreenOn").show();
    });
});