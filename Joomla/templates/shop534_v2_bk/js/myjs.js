
$(document).ready(function()
{
	$(".Electronics").hide();
	$(".Watches").hide();
	$(".Shoes").hide();
    $(".Clothes").hide();
    $(".Movies").hide();
    $(".Furnitures").hide();

   /* $("#hideme").attr("height","13px");
    
    $(".hideme").mouseenter(function(){
        $("#hideme").attr("src","images/hidemehover.png");
        $("#hideme").attr("height","18px");
    })

    $(".hideme").mouseleave(function(){
        $("#hideme").attr("src","images/hideme.png");
        $("#hideme").attr("height","13px");
    })*/


    $(".hideme").click(function(){
        $(".Electronics").hide();
        $(".Watches").hide();
        $(".Shoes").hide();
        $(".Clothes").hide();
        $(".Movies").hide();
        $(".Furnitures").hide(); 
 
    })


    $(".elec").click(function()
    {
        $(".Electronics").toggle("fast");
        $(".Watches").hide();
        $(".Shoes").hide();
        $(".Clothes").hide();
        $(".Movies").hide();
        $(".Furnitures").hide();
    });

    $(".watc").click(function()
    {
    	$(".Electronics").hide();
        $(".Watches").toggle("fast");
        $(".Shoes").hide();
        $(".Clothes").hide();
        $(".Movies").hide();
        $(".Furnitures").hide();
    });

    $(".shoe").click(function()
    {
    	$(".Electronics").hide();
        $(".Watches").hide();
        $(".Shoes").toggle("fast");
        $(".Clothes").hide();
        $(".Movies").hide();
        $(".Furnitures").hide();
    });
    $(".clot").click(function()
    {
        $(".Electronics").hide();
        $(".Watches").hide();
        $(".Shoes").hide();
        $(".Clothes").toggle("fast");
        $(".Movies").hide();
        $(".Furnitures").hide();
    });
    $(".movi").click(function()
    {
        $(".Electronics").hide();
        $(".Watches").hide();
        $(".Shoes").hide();
        $(".Clothes").hide();
        $(".Movies").toggle("fast");
        $(".Furnitures").hide();
    });
    $(".furn").click(function()
    {
        $(".Electronics").hide();
        $(".Watches").hide();
        $(".Shoes").hide();
        $(".Clothes").hide();
        $(".Movies").hide();
        $(".Furnitures").toggle("fast");
    });
});