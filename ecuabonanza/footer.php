<div class="row footer option animated fadeInUp">
    <div class="col-sm-12">
        <!-- <div class="row">
            <div class="col-sm-12">
                <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="ARRIBA">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
            </div>
        </div> -->  
        <div class="row">
            <div class="col-sm-11" data-mh="my-group">
                <div class="row">
                    <div class="col-sm-12 text-center">
                    <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#F5F5F5;font-size: 18px">
                        <span style="color:#f5f5f5;font-size:12px;font-weight:bold;letter-spacing:.1em;font-family: 'Taviraj', serif">BONANZA &copy;2018.</span>
                        <span style="color:#f5f5f5;font-size:12px;font-family: 'Taviraj', serif">&nbsp;&nbsp;&nbsp;TODOS LOS DERECHOS RESERVADOS. </span>
                    <!-- </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-left" style="color:#F5F5F5;font-size: 10px"> -->
                        <span style="color:#f5f5f5;font-size:12px;font-family: 'Taviraj', serif">DESARROLLADO POR -
                            <a href="http://www.merakiminds.com" class="siteDesignedBy" style="color:#dba24b;font-size:16px;text-decoration: none">MERAKI MINDS</a>
                        </span>
                    </div>
                </div>
            </div>
            <!-- <div class="col-sm-1" data-mh="my-group">
                <div class="row">
                    <div class="col-sm-12 text-center" style="color:#F5F5F5;font-size: 24px">
                    SIGUENOS
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <i class="fa fa-facebook-square" style="font-size:40px;color:#FFF"></i> 
                        <i class="fa fa-twitter-square" style="font-size:40px;color:#FFF"></i> 
                        <i class="fa fa-youtube-square" style="font-size:40px;color:#FFF"></i> 
                    </div>
                </div>
            </div> -->
            <div class="col-sm-1" data-mh="my-group">
                <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="ARRIBA">
                    <span class="glyphicon glyphicon-chevron-up"></span>
                </a>
            </div>
        </div>
    </div>
    </div>
<script>
$(document).ready(function(){
  // Initialize Tooltip
  $('[data-toggle="tooltip"]').tooltip(); 
  
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, a[href='#myPage']").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {

      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
})
</script>

</body>
</html>