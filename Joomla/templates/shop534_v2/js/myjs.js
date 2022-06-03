
$(document).ready(function()
{

    //$(".filter-panel").hide();
    //$(".mostViewedCategory").hide();
    $(".hideme").click(function()
    {
        $(".filter-panel").toggle();
        $(".mostViewedCategory").toggle();
    })

    //$("#uploadImg")


    $('#uploadImg1').click( function() {
        var toggleWidth = $("#uploadImg1").width() > 480 ? "480px" : "650px";
        $('#uploadImg1').animate({ width: toggleWidth});
        
    });




    try
    {
        cartTotal();
    }
    catch(err)
    {

    }
    
    $("#fileToUpload").on('change', function () 
    {
        var imgPath = $(this)[0].value;
        //alert('imgPath::'+imgPath);
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") 
        {
            if (typeof (FileReader) != "undefined") 
            {  

                var reader = new FileReader();
                reader.onload = function (e) 
                {
                    $('#uploadImg').attr('src',e.target.result);
                }                
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support FileReader.");
            }
        } 
        else 
        {
            alert("Pls select only images");
        }
    });

    try
    {
        var country_id = document.getElementById("country-Id").value;
        //alert("country:"+country_id);
        if(country_id)
        {        
            document.getElementById("countryId").value=country_id;
            
        }

        
        var state_id = document.getElementById("state-Id").value;
        //alert("state:"+state_id);
        if(state_id)
        {
            getStates();
            document.getElementById("stateId").value=state_id;
        }
        //alert("X");
        var city_id = document.getElementById("city-Id").value;
        //alert("city:"+city_id);
        if(city_id)
        {
            getCities();
            document.getElementById("cityId").value=city_id;
        }
    }
    catch(err)
    {

    }
    //alert("country:"+country_id);
    
    try
    {

        if(document.getElementById("rn_latitude").value && document.getElementById("rn_longitude").value)
        {
            //alert("1");
              lat = document.getElementById("rn_latitude").value;
              lon = document.getElementById("rn_longitude").value;
              latlon = new google.maps.LatLng(lat, lon)
              //alert("HI-2");
              mapholder = document.getElementById('mapholder')
              mapholder.style.height = '250px';
              mapholder.style.width = '100%';
              //alert("HI-3");
              var myOptions = {
              center:latlon,zoom:14,
              mapTypeId:google.maps.MapTypeId.ROADMAP,
              mapTypeControl:false,
              navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
              }
              //alert("HI-4");
              var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
              var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
        }
        else
        {
            //alert("2");
            if (navigator.geolocation) 
            {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } 
            else 
            { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
    }
    catch(err)
    {

    }

    try
    {
        var category_id = document.getElementById("category-Id").value;
        //alert("category_id:"+category_id);
        if(category_id)
        {        
            document.getElementById("categoryId").value=category_id;
            
        }

        var subcategory_id = document.getElementById("subcategory-Id").value;
        //alert("subcategory_id:"+subcategory_id);
        if(subcategory_id)
        {        
            getSubCategories();
            document.getElementById("subcategoryId").value=subcategory_id;
            
        }
    }
    catch(err)
    {

    }

    

});


/*!function ($) {

    "use strict"; // jshint ;_;


    var Magnify = function (element, options) {
        this.init('magnify', element, options)
    }

    Magnify.prototype = {

        constructor: Magnify

        , init: function (type, element, options) {
            var event = 'mousemove'
                , eventOut = 'mouseleave';

            this.type = type
            this.$element = $(element)
            this.options = this.getOptions(options)
            this.nativeWidth = 0
            this.nativeHeight = 0

            this.$element.wrap('<div class="magnify" \>');
            this.$element.parent('.magnify').append('<div class="magnify-large" \>');
            this.$element.siblings(".magnify-large").css("background","url('" + this.$element.attr("src") + "') no-repeat");

            this.$element.parent('.magnify').on(event + '.' + this.type, $.proxy(this.check, this));
            this.$element.parent('.magnify').on(eventOut + '.' + this.type, $.proxy(this.check, this));
        }

        , getOptions: function (options) {
            options = $.extend({}, $.fn[this.type].defaults, options, this.$element.data())

            if (options.delay && typeof options.delay == 'number') {
                options.delay = {
                    show: options.delay
                    , hide: options.delay
                }
            }

            return options
        }

        , check: function (e) {
            var container = $(e.currentTarget);
            var self = container.children('img');
            var mag = container.children(".magnify-large");

            if(!this.nativeWidth && !this.nativeHeight) {
                var image = new Image();
                image.src = self.attr("src");
                this.nativeWidth = image.width;
                this.nativeHeight = image.height;


            } else {


                var magnifyOffset = container.offset();
                var mx = e.pageX - magnifyOffset.left;
                var my = e.pageY - magnifyOffset.top;
                if (mx < container.width() && my < container.height() && mx > 0 && my > 0) {
                    mag.fadeIn(100);
                } else {
                    mag.fadeOut(100);
                }

                if(mag.is(":visible"))
                {
                    var zoomSize=800;
                    var rx = Math.round(mx/container.width()*zoomSize - mag.width()/2)*-1;
                    var ry = Math.round(my/container.height()*zoomSize - mag.height()/2)*-1;

                    var bgp = rx + "px " + ry + "px";
                    var bgs = zoomSize+"px "+zoomSize+"px";
                    
                    var px = mx - mag.width()/2;
                    var py = my - mag.height()/2;

                    mag.css({left: px, top: py, backgroundPosition: bgp,backgroundSize:zoomSize});
                }
            }

        }
    }


    $.fn.magnify = function ( option ) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('magnify')
                , options = typeof option == 'object' && option
            if (!data) $this.data('tooltip', (data = new Magnify(this, options)))
            if (typeof option == 'string') data[option]()
        })
    }

    $.fn.magnify.Constructor = Magnify

    $.fn.magnify.defaults = {
        delay: 0
    }


    $(window).on('load', function () {
        $('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })
    })

} ( window.jQuery );*/


    function showPosition(position) 
    {
        //alert("HI");
        //alert("Set Location:LAT:"+position.coords.latitude);
        //alert("Set Location:LON:"+position.coords.longitude);
        document.getElementById('rn_latitude').value = position.coords.latitude;
        document.getElementById('rn_longitude').value = position.coords.longitude;
        //alert("HI-1");
        lat = position.coords.latitude;
        lon = position.coords.longitude;
        latlon = new google.maps.LatLng(lat, lon)
        //alert("HI-2");
        mapholder = document.getElementById('mapholder')
        mapholder.style.height = '250px';
        mapholder.style.width = '100%';
        //alert("HI-3");
        var myOptions = {
        center:latlon,zoom:14,
        mapTypeId:google.maps.MapTypeId.ROADMAP,
        mapTypeControl:false,
        navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
        }
        //alert("HI-4");
        var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
        var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
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
        }
    }



    function getStates()
    {
      //alert("COUNTRIES::"+document.getElementById("countryId").value);
      //alert("StateArray::"+document.getElementById("statesarr").value);
      document.getElementById("country-Id").value=document.getElementById("countryId").value;
      var country_arr = document.getElementById("statesarr").value.split('|');
      var ctry_id="";
      var res='<option value="">Select State</option>';
      for(i=0;i<country_arr.length;i++)
      {
        ctry_id = country_arr[i].split(':');
        //alert(ctry_id);
        if(ctry_id[0]==document.getElementById("countryId").value)
        {
          //alert(country_arr[i]);
          var count_value=ctry_id[1].split('~')[0];
          var count_text = ctry_id[1].split('~')[1];
          res=res+'<option value="'+count_value+'">'+count_text+'</option>';
        }
      }
      //alert(res);
      document.getElementById("stateId").innerHTML=res;
    }

    function getCities()
    {
      document.getElementById("state-Id").value=document.getElementById("stateId").value;
      var city_arr = document.getElementById("citiesarr").value.split('|');
      var cty_id="";
      var res='<option value="">Select City</option>';
      for(i=0;i<city_arr.length;i++)
      {
        cty_id = city_arr[i].split(':');
        //alert(ctry_id);
        if(cty_id[0]==document.getElementById("stateId").value)
        {
          //alert(country_arr[i]);
          var city_value=cty_id[1].split('~')[0];
          var city_text = cty_id[1].split('~')[1];
          res=res+'<option value="'+city_value+'">'+city_text+'</option>';
        }
      }
      //alert(res);
      document.getElementById("cityId").innerHTML=res;
    }

    function setCity()
    {
        document.getElementById("city-Id").value=document.getElementById("cityId").value;
        document.getElementById("street").value="";
        document.getElementById('rn_latitude').value = "";
        document.getElementById('rn_longitude').value = "";

    }

    function getSubCategories()
    {
        //alert("CATEGORIES::"+document.getElementById("categoryId").value);
        //alert("SubCategoryArray::"+document.getElementById("subcategoryarr").value);
        document.getElementById("category-Id").value=document.getElementById("categoryId").value;
        var subcategory_arr = document.getElementById("subcategoryarr").value.split('|');
        var ctgry_id="";
        var res='<option value="">Select Sub Category</option>';
        for(i=0;i<subcategory_arr.length;i++)
        {
            ctgry_id = subcategory_arr[i].split(':');
            //alert(ctry_id);
            if(ctgry_id[0]==document.getElementById("categoryId").value)
            {
                //alert(country_arr[i]);
                var cat_value=ctgry_id[1].split('~')[0];
                var cat_text = ctgry_id[1].split('~')[1];
                res=res+'<option value="'+cat_value+'">'+cat_text+'</option>';
            }
        }
        //alert(res);
        document.getElementById("subcategoryId").innerHTML=res;
    }

    function setSubCategory()
    {
        document.getElementById("subcategory-Id").value=document.getElementById("subcategoryId").value;
        document.getElementById("rn_tags").value="";
    }


    function changeRating() 
    {
        document.getElementById("rate").innerHTML = document.getElementById("myRange").value;
        document.getElementById("rate_selected").value = document.getElementById("myRange").value;
    }

    function changeImg(x)
    {
        var imgId = "img"+x;
        //alert(imgId);
        var newInnerHtml=  '<img class="img-responsive img-rounded" style="border-radius: 5px;padding:10px" id="img0" data-toggle="magnify" src='+document.getElementById(imgId).src+' />'; 
                            
        document.getElementById('magid').innerHTML=newInnerHtml;

        /*$('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })*/        
    }

    function changeImgInWindow(x)
    {
        var imgId = "img"+x;
        //alert(imgId);
        var newInnerHtml=  '<img src='+document.getElementById(imgId).src+' id="uploadImg1" class="profileImageInWindow" />'; 
                            /*<img src=<?php echo JURI::root().'media/com_shop/'; ?>images/clients/<?php echo $_GET["clientCode"].'/'.$_GET["clientCode"].'-'.$imageCode; ?>.jpg id="uploadImg" class="profileImageInWindow" />*/
        document.getElementById('magid').innerHTML=newInnerHtml;
        $('#uploadImg1').click( function() {
            var toggleWidth = $("#uploadImg1").width() > 480 ? "480px" : "650px";
            $('#uploadImg1').animate({ width: toggleWidth});
        
        });

        /*$('[data-toggle="magnify"]').each(function () {
            var $mag = $(this);
            $mag.magnify()
        })*/        
    }

    function cartTotal()
    {
        var total=0;
        for(i=1;i<document.getElementById("t0").rows.length;i++)
        {
            if(isNaN(document.getElementById("t0").rows[i].cells[5].childNodes[0].value))
            {
                alert('Please enter a numeric quantity.');
                document.getElementById("t0").rows[i].cells[5].childNodes[0].value=1;
            }   
            document.getElementById("t0").rows[i].cells[6].childNodes[0].value = parseFloat(parseFloat(document.getElementById("t0").rows[i].cells[4].childNodes[0].value)*parseFloat(document.getElementById("t0").rows[i].cells[5].childNodes[0].value)).toFixed(2);          
            //document.getElementById("t0").rows[i].cells[6].childNodes[0].value =(document.getElementById("t0").rows[i].cells[6].childNodes[0].value).toFixed(2);
            total = total+parseFloat(document.getElementById("t0").rows[i].cells[6].childNodes[0].value);
        }

        document.getElementById("total").value='TOTAL : '+total;
        if(total==0)
        {
            /*$("#saveCart").hide();
            $("#confirmCart").hide();
            $("#cancelCart").hide();*/
            $("#manageCartBtns").hide();

        }
        else
        {
            /*$("#saveCart").show();
            $("#confirmCart").show(); 
            $("#cancelCart").show(); */ 
            $("#manageCartBtns").show();
        }
    }

    function validatePrice()
    {
        var price = document.getElementById("price").value;
        var regEx = /^[1-9]\d*((\.\d{0,2})?)$/;
        if(!regEx.test(price))
        {
            alert("Price will be always numeric(like 12.00)")
            return false;
        }
    }





