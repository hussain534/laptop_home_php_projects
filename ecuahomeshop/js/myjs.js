$(document).ready(function()
{   
    $("#btnOpenRecuperarClaveForm").click(function () 
    {  
        window.location.replace("recuperarClave.php");
    });

    $("#btnOpenManageBusinessForm").click(function () 
    {  
        window.location.replace("manageBusiness.php");
    });
    $("#btnOpenNewBusinessForm").click(function () 
    {  
        window.location.replace("editBusiness.php?business_id=0");
    });

    

    $("#fileToUpload").on('change', function () 
    {
        //alert(1);
        //$("#progress").show();
        //alert(2);
        var imgPath = $(this)[0].value;
        //alert('imgPath::'+imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        //alert(3);
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") 
        {
            //alert(4);
            if (typeof (FileReader) != "undefined") 
            {  
                //alert(5);
                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    //alert(6);
                    $('#uploadImg').attr('src',e.target.result);
                    //$("#progress").hide();
                    //alert(7);
                }          
                //alert(8);      
                reader.readAsDataURL($(this)[0].files[0]);
                //alert(9);
            } else {
                alert("This browser does not support FileReader.");
            }
        } 
        else 
        {
            alert("Pls select only images");
        }
    });
});

