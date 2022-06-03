$(document).ready(function()
{
    $(".slide-heading-menu").hover(function()
    {
    	//alert('alert');       
        $(this).animate({top: '0%'}, "slow");
        $(this).animate({height: '300px'}, "slow");
        $(this).finish();
        //div.animate({fontSize: '3em'}, "slow");
    },function()
    {
    	//alert('alert');       
        $(this).animate({height: '45px'}, "slow");
        $(this).animate({top: '250px'}, "slow");
        
        //div.animate({fontSize: '3em'}, "slow");
    });

    $("#myTab li:eq(0) a").tab('show');

    var x=window.innerWidth;
    var startPos=0;
    var defaultSize=369;
    var loopval=0;
    var perpage=1;
    //alert("X::"+x);
    if(x>0 && x<=369)
    {
      //alert("mobile"+x);
      perpage=1;
      document.getElementById('mycor').style.width = (defaultSize*perpage)+"px";
    }
    else if(x>369 && x<738)
    {
      //alert("tab::"+x);  
      perpage=2;
      document.getElementById('mycor').style.width = (defaultSize*perpage)+"px";
    }
    else
    {
      //alert("laptop::"+x);
      perpage=3;
      document.getElementById('mycor').style.width = (defaultSize*perpage)+"px";
    }


    setInterval(function()
    {
      
      //document.getElementById("cor_container").style.left = (-1)*(defaultSize*loopval)+"px";
      $("#cor_container").animate({'left':(-1)*(defaultSize*loopval)+"px"},1000)
      
      if(loopval<5)
        loopval=loopval+1;
      else
        loopval=perpage-1;
    }, 3000);
    
});


$(window).scroll(function() 
{
  $(".slideanim").each(function()
  {
    var pos = $(this).offset().top;
    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) 
    {
      $(this).addClass("slide1");
    }
  });

  $(".slideanimfromleft").each(function()
  {
    var pos = $(this).offset().top;
    var winTop = $(window).scrollTop();
    if (pos < winTop + 600) 
    {
      $(this).addClass("slide2");
    }
  });
});

$(document).ready(function()
{ 
    $("#myTab li:eq(0) a").tab('show');
});