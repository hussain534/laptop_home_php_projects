<div class="container">
    <?php
        include_once('home_header.php');
    ?>
    <!-- ERROR BLOCK -->    
    <?php
        if(isset($_SESSION["MESSAGE_TYPE"]))
        {
    ?>
    <div class="row error_row">
        <div class="col-sm-12 text-center">
            <?php
                echo '<div class="alert alert-'.$_SESSION["MESSAGE_TYPE"].' alert-dismissible fade in">';
                echo '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo $_SESSION["MESSAGE_TEXT"];
                echo '</div>';
                unset($_SESSION['MESSAGE_TYPE']);
                unset($_SESSION['MESSAGE_TEXT']);
            ?>
        </div>
    </div>
    <?php
        }
    ?>

    <!-- BANNER BLOCK -->
    <div class="row mm-container mm-container-back">
        <div class="col-sm-12 text-center">
            <div class="caption">
                <span class="text1">
                    SKRIMER V2
                </span>
                <br>
                <span class="text4">
                    LA MEJOR SISTEMA ERP QUE PUEDE ENCONTRAR
                </span>
            </div>
        </div>
    </div>

    <!-- INTRODUCTION BLOCK -->
    <div class="row">
        <div class="col-sm-4 text-center mm-container_back1">
            <div class="row">
                <p><em>VENTAS y FACTURACION</em></p>
            </div>
            <div class="row">
                <img src="images/invoice.png" style="width:300px;height:350px">
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-easy">
                        Este módulo tiene completo control sobre las gestiones de mercadeo, abarcando desde la elaboración  de la proforma  hasta la emisión de la factura. Tambien provee funciones para el registro y cancelación de cuentas por pagar y cobrar.
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 text-center mm-container_back1">
            <div class="row">
                <p><em>CONTABILIDAD</em></p>
            </div>
            <div class="row">
                <img src="images/docs.png" style="width:300px;height:350px">
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-easy">
                        Este módulo provee la facilidad de mantener actualizada la información contable relacionada con el negocio,  esta es registrada en esta aplicación o recibida desde los demás módulos
                    </p>
                </div>
            </div>
        </div>

        <div class="col-sm-4 text-center mm-container_back1">
             <div class="row">
                <p><em>INVENTARIOS</em></p>
            </div>
            <div class="row">
                <img src="images/inventory.png" style="width:300px;height:350px">
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-easy">
                        Este módulo brinda el control de  existencias físicas y disponibles en cantidades y costos; dispone del control de lotes y número seriales,  facilitando la ubicación del mismo.. 
                    </p>
                </div>
            </div>
        </div>
    </div>









    <!-- FOOTER BLOCK -->
    <?php
        include_once('footer.php');
    ?>
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

</div>