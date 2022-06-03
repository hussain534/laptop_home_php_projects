<?php
	$databasecon = mysqli_connect('localhost','merakiprod01','merakiprod01','zielus') or die('Error:DB Connect error.');//IP,user,pwd,db
	
  #hutesol db
  #$databasecon = mysqli_connect('localhost','hussain1_shop534','shop534','hussain1_zielus') or die('Error:DB Connect error.');//IP,user,pwd,db
  $PRINT_LOG=false;
	$session_expirry_time=600;//time in seconds
  $payment_max_wait_time=180;//time in seconds
  $pics_location='images/pics/';
  $blogs_location='images/blogs/';
  $gallery_location='images/gallery/';
  $uploadSize=5000000;
  $dtview=1;
  $costo_quito_aeropuerto=12;
  $costo_aeropuerto_quito=6;


$SITEADDRESS='http://ecuahomeshop.com/';
#$SITEADDRESS='http://localhost/joomla/';
$TITLE_OFFERS='OFERTAS';
  $TITLE_VISITORS='VISITAS';
  $TITLE_CONTACT_US='CONTÁCTENOS';
  $TITLE_LOGIN='INGRESAR';
  $TITLE_LOGOUT='CERRAR SESIÓN';
  $TITLE_REGISTER='REGISTRARSE';
  $TITLE_WELCOME='BIENVENIDO';
  $TITLE_SEARCH_TITLE='QUÉ ESTÁS BUSCANDO HOY?';
  $TITLE_SEARCH_OFFER='Nombre del producto o la marca';
  $BUTTON_GO='IR';
  $MSG_SESSION_EXPIRED='Sesion expirado. Ingresa nuevamente usando usuario y clave.';
  $TAB_CONTACT_US='Contáctenos';
  $TAB_YOUR_MSG='Su mensaje';
  $LINK_MOST_VIEWED_PRODUCTS='PRODUCTOS MÁS VISITADOS';
  $LINK_MOST_VIEWED_CATEGORIES='CATEGORÍAS MÁS VISITADAS';
  $LINK_MOST_VIEWED_CLIENTS='PROVEEDORES MÁS VISITADOS';
  $MSG_VIEW_THIS_PRODUCT='Click para ver este producto';
  $MSG_VIEW_PRODUCT_FROM_CATEGORY='Click para ver productos de este categoría';
  $MSG_VIEW_PRODUCT_FROM_CLIENT='Click para ver productos de este proveedor';
  $LINK_HIDE_FILTER='Click para abrir o cerrar la panel de filtros';
  $LINK_HIDE_PANEL='Click to hide this message';
  $TITLE_MSG_FIND_UR_PRODUCT_1='Encontraste tu producto-';
  $TITLE_MSG_FIND_UR_PRODUCT_2='.? No!, Notificaremos a su correo cuando esté disponible.';
  $TITLE_MSG_FIND_UR_PRODUCT_3='No estas registrado con nosotros. Ingrese su correo electronico para notifarle';
  $BUTTON_NOTIFY_ME='NOTIFICARME';
  $USER_REFERENCE_DETAILS='USUARIOS/CLIENTES USANDO SU REFERENCE';
  $MSG_SHOWING='MOSTRANDO';
  $LINK_FIRST='PRIMERO';
  $LINK_PREVIOUS='ANTERIOR';
  $LINK_NEXT='SIGUIENTE';
  $LINK_LAST='ÚLTIMO';
  $TAG_PRICE='PRECIO(con iva)';
  $LINK_LAST='ÚLTIMO';
  $TAG_ENABLE='Habilitado';
  $TAG_ENABLE_YES='Si';
  $TAG_ENABLE_NO='No';
  $TAG_IN_STOCK='DISPONIBLE';
  $TAG_DEL_TIME='TIEMPO DE ENTREGA';
  $LINK_VIEW_DETAILS='Ver Detalles';
  $MSG_NO_PRODUCTS='PRODUCTOS NO DISPONIBLES';
  $BUTTON_CLICK_MORE='VER MÁS PRODUCTOS';
  $TAG_ALL_RIGHTS_RESERVED='Todos los derechos reservados';
  $TAG_SUBSCRIBE='REGISTRE SU CORREO PARA RECIBIR OFERTAS Y DESCUENTOS';
  $BUTTON_SUBSCRIBE='SUSCRIBIRSE';
  $LINK_TERMS_OF_USE='TÉRMINOS DE USO';
  $TAG_DESCRIPTION='Descripción';
  $TAG_NAME='Nombre';
  $TAG_IN_STK='Disponible';
  $TAG_DELIVERY_TIME='Tiempo de Entrega';
  $TAG_CLIENT='Proveedor';
  $TAG_COMMISION='Comisión';
  $TAG_ID_PRODUCT='ID de Producto';
  $TAG_ID_CLIENT='ID de Proveedor';
  $TAG_ID='ID';
  $TAG_CATEGORY='Categoría';
  $TAG_SUB_CATEGORY='Sub Categoría';
  $TAG_TAGS='Palabras claves';
  $TAG_PHONE='Teléfono';
  $TAG_MOBILE='Móvil';
  $TAB_WEBSITE='Sitio Web';
  $TAB_FACEBOOK_LINK='Facebook';
  $TAB_TOLLFREE='Número Gratuito';
  $TAB_SHOW_PRICE='Mostrar Precio';
  $TAB_OFFER_DETAILS='Detalles de oferta';
  $TAB_OFFER_VALID_FROM='Oferta desde';
  $TAB_OFFER_VALID_UPTO='Oferta hasta';
  $TAB_COUNTRY='País';
  $TAB_STATE='Provincia';
  $TAB_CITY='Ciudad';
  $TAB_ADDRESS='Dirección';
  $TAB_LATITUDE='Latitud';
  $TAB_LONGITUDE='Longitud';
  $TAB_COMMENTS='Comentarios';
  $TAB_USER='Nombre de usuario';
  $TAB_USER_NAME='Nombre y Apellido';
  $TAB_REF_USER_NAME='Nombre del usuario que te recomendó este sitio';
  $TAB_REF_USER_NAME2='Reference usuario';
  $TAB_PASSWORD='Clave';
  $TAB_CONFIRM_PASSWORD='Confirmar la clave';
  //$TAB_EMAIL='Correo electrónico';
  $TAB_EMAIL='E-mail';
  $TAB_CONTACT_NUMBER='Nro. de contacto';
  $TAB_PASSWORD='Clave';
  $TAB_NEW_PASSWORD='Nueva Clave';
  $LINK_FORGOT_PASSWORD='OLVIDÓ SU CONTRASEÑA';
  $WHY_SHOULD_REGISTER='PORQUÉ ME REGISTRARÍA?';
  $I_SHOULD_REGISTER='ME REGISTRO PARA:';
  $GAIN_CREDIT_POINTS='GANAR PUNTOS POR MIS COMPRAS';
  $POST_COMMENTS='PUBLICAR COMENTARIOS';
  $PURCHASE_ONLINE='COMPRAR EN LÍNEA';
  $REGISTER_AS_USER='Registrarse como usuario o cliente';
  $REGISTER_AS_CLIENT='Registrarse como proveedor o distribuidor';
  $CHECK_READ_TERMS='He leído los términos de uso';
  $READ_TERMS='NUESTROS TÉRMINOS DE USO?';
  $TAB_HOME='INICIO';
  $TAB_MY_PROFILE='MI PERFIL';
  $CHECKOUT='FINALIZAR COMPRA';
  $ORDERS='MIS ÓRDENES';
  $ORDER_DETAILS='DETALLE DE ÓRDENES';
  $TAB_ORDER_HISTORY='HISTORIAL DE COMPRAS';
  $TAB_ORDER_OF_HISTORY='HISTORIAL DE ÓRDENES';
  $ORDER_NUMBER='ORDEN #';
  $ORDER_DATE='FECHA';
  $ORDER_RECIEVED='RECIBIDO';
  $ORDER_RECIEVED_DATE='FECHA DE ORDEN';
  $ORDER_CONFIRMATION='CONFIRMACIÓN';
  $ORDER_DISPATCH='DESPACHADO';
  $ORDER_DISPATCH_DATE='FECHA DE DESPACHO';
  $ORDER_DELIVERY='ENTREGADO';
  $ACTION='ACCIONES';
  $ORDER_DETAILS='DETALLES DE ORDEN';
  $PRICE_PER_QTY='PRECIO/UNIDAD';
  $QUANTITY='UNIDAD';
  $TOTAL_PRICE='PRECIO TOTAL($)';
  $DELIVERY_ADDRESS='DIRECCIÓN DE ENTREGA';
  $DELIVERY_TO='Nombre';
  $FIRST_STREET='Calle Principal';
  $SECOND_STREET='Intersección';
  $HOUSE_NUMBER='Numeración';
  $REFERENCE='Referencia';
  $NEW_PASSWORD='Clave Nueva';
  $BUTTON_SUBMIT='ENVIAR';
  $TEXT_UPLOAD_SHORT='Upload / Edit';
  $TEXT_UPLOAD='Subir/Editar(Tamaño máximo:500KB, Resolución:400*400)';
  $EDIT_IMAGE_LINK='Editar sus imágenes en:';
  $TAB_RATING='Calificación';
  $PLAN_TYPE='Tipo de plan';
  $APPROVED='Aprobado?';
  $BUTTON_VIEW_PRODUCTS='Ver productos';
  $LINK_CLIENT_PROFILE='PERFIL DE PROVEEDOR';
  $LINK_CLIENT_PRODUCTS='PRODUCTOS';
  $LINK_MY_ORDERS='MIS ÓRDENES';
  $BUTTON_ADD_IMAGES='Agregar Imágenes';
  $BUTTON_ADD_NEW_PRODUCT='Agregar nuevo producto';
  $TAB_CREATED_ON='Creado en:';
  $TAB_CREATED_BY='Creado por:';
  $TAB_MODIFIED_ON='Modificado en:';
  $TAB_MODIFIED_BY='Modificado por:';
  $BUTTON_ADD_TO_CART='COMPRAR';
  $BUTTON_SAVE_ORDER='GUARDAR';
  $BUTTON_CONFIRM_ORDER='CONFIRMAR';
  $BUTTON_CANCEL_ORDER='CANCELAR';
  $TAB_CONFIRMATION='Confirmación';
  $RADIO_PENDING='Pendiente';
  $RADIO_CONFIRMED='Confirmado';
  $TAB_DISPATCH='Despacho';
  $RADIO_DISPATCHED='Despachado';
  $TAB_DELIVERY='Entrega';
  $RADIO_DELIVERED='Entregado';
  $LANG_ENGLISH='Inglés';
  $LANG_SPANISH='Español';
  $WRITE_COMMENTS='Escribir su comentarios';
  $BUTTON_SUBMIT_COMMENTS='ENVIAR SU COMENTARIOS';
  $TAG_COMMENTS='COMENTARIOS';
  $CANCEL_YOUR_ORDER='Cancelar su orden';
  $MODIFY_YOUR_ORDER='Modificar su orden';




  $MESSAGE_CHECK_TERMS_OF_USE='Marcar la condición - Ha leído nuestros términos de uso?';//Tick the check box if you read our terms of use!!
  $MESSAGE_INVALID_ACCESS="Clave o contraseña inválidas o está tratando de acceder a la página directamente. Ingresa con tu clave y contraseña aquí.<a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> $TITLE_LOGIN</a>";//Invalid credentials or you are accessing this page directly. Try with correct login details.<a href='index.php?view=shop&amp;layout=login'><span class='glyphicon glyphicon-log-in'></span> LOGIN</a>
  $MESSAGE_SUCCESSFULLY_LOGOUT="Sesión finalizada exitosamente. Gracias por utilizar ECUAHOMESHOP";//You have successfully logout.Thanks for using our portal.

  $MESSAGE_PRODUCT_UPD_OK="Detalles de usuario actualizados existosamente.";//New Product details uploaded successfully
  $MESSAGE_FILE_IS_NOT_IMG="Archivo no es un imagen.";//File is not an image
  $MESSAGE_FILES_ALLOWED="Solo imágenes de tipo - JPG, JPEG, PNG y GIF permitidos.";//Sorry, only JPG, JPEG, PNG & GIF files are allowed
  $MESSAGE_FILE_TOO_LARGE="Imagen demasiado pesada.";//Sorry, your file is too large
  $MESSAGE_ERROR_FILE_UPLOAD="Error al subir imagen.";//Sorry, your file was not uploaded
  $MESSAGE_PRODUCT_IMG_UPLOAD_OK="Imagen y detalles de perfil actualizados exitosamente.";//The profile image and data has been uploaded successfully
  $MESSAGE_PRODUCT_DATA_UPD_OK="Detalles de perfil actualizados exitosamente.";//The data has been updated successfully
  $MESSAGE_PRODUCT_DATA_UPD_ERR="Error en la actualizacion de datos.Contáctate con servicio al cliente.";//Error in uploading Data. Please contact our administrator
  $MESSAGE_NO_CLIENT_DTLS_FOUND="Detalles del proveedor no encontrados.Completar el perfil del proveedor para proceder.<a href='index.php?view=shop&amp;layout=clientprofile'>$LINK_CLIENT_PROFILE</a>";//No client details found. Please Complete client profile first to add products.<a href='index.php?view=shop&amp;layout=clientprofile'>CLIENT PROFILE</a>
  $MESSAGE_OFFER_DTLS_EMPTY_MSG="Ingresa detalles de la Oferta, fechas(válida desde y hasta) correctamente";//Please enter Offer Details, Offer Start From and Offer Ends On dates correctly
  $MESSAGE_OFFER_DT_MISMATCH="Campo - Fecha hasta -  debe ser siempre mayor que la campo - Fecha desde.";//Offer start from date should be always greater than Offer Ends on date
  $MESSAGE_STK_QTY="Campo - Disponible - siempre debe ser menor que 99999.";//STOCK QTY: Please enter only number value not > 99999
  $MESSAGE_DELIVERY_TIME="Campo -Tiempo de entrega - siempre debe ser menor que 99";//DELIVERY TIME: Please enter only number value not > 99

  $MESSAHE_OFFER_UPD_OK="Detalles de la oferta actualizados existosamente";//Offer Details Updated successfully.
  $MESSAGE_OFFER_INSERTED_OK="Detalles de la oferta registrados existosamente.";//Offer Details Inserted successfully

  $MESSAGE_PRODUCT_ADDED_TO_CART_OK="Producto exitosamente agregado a su coche de compras";//Product successfully added to cart
  $MESSAGE_PRODUCT_ADDED_TO_CART_ERR="Error al agregar producto a su coche de compras.";//Error while adding product to cart.Please contact our call center

  $MESSAGE_CART_SAVED_OK="Coche de compras guardado exitosamente";//Your Cart has been saved successfully
  $MESSAGE_CART_SAVED_ERR="Error al actualizar coche de compras.";//Error while saving your cart. Please try later

  $MESSAGE_STATUS_UPD_OK="Estados actualizados exitosamente";//All status updated successfully
  $MESSAGE_STATUS_UPD_ERR="Error al actualización de estados.";//Status updation failed.Please try later

  //$MESSAGE_ORDER_CANCEL_OK="Your order ".$_GET['orderId']." canceled successfully";
  $MESSAGE_ORDER_CANCEL_OK_1="Orden ";//Your order 
  $MESSAGE_ORDER_CANCEL_OK_2=" cancelada exitosamente.";// canceled successfully
  //$MESSAGE_ORDER_CANCEL_ERR="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
  $MESSAGE_ORDER_CANCEL_ERR_1="Error al cancelar orden ";//Error while canceling your order 
  $MESSAGE_ORDER_CANCEL_ERR_2="Contáctate con servicio al cliente.";//.Please contact our call center
  $MESSAGE_CLIENT_DTLS_UPD_OK='Datos del proveedor actualizados exitosamente';//Client Details updated successfully

  $MESSAGE_EMAIL_FORMAT_ERR="Ingresar correo electrónico válido";//Please enter valid e-mail address

  $MESSAGE_REGISTRATION_OK="Felicitaciones! Datos registrados existosamente en nuestro sistema.";//Congratulations! Your details registered successfully
  $MESSAGE_REGISTRATION_ERR="Error al registrar datos.Intenta nuevamente o contáctate con servicio al cliente.";//Error registering your details. Try again later
  $MESSAGE_USER_EXISTS="Usuario ya existente.Ingresar otro usuario.";//User Already exists.Use other user id
  $MESSAGE_USER_REF_NO_EXISTS="Usuario reference ya no existente.Ingresar detalles correctamente.";//User Already exists.Use other user id
  $MESSAGE_PWD_MISMATCH="Campo - Clave - y campo - Confirmar la clave - no coninciden.Ingresar claves corectamente.";//Passwords mismatch. Please fill correct details
  $MESSAGE_ERROR_LOGIN="Error al procesar login. Intenta nuevamente o contáctate con servicio al cliente.";//Error in login. Try again later
  $MESSAGE_INVALID_USER="Usuario Inválido";//Invalid User

  $MESSAGE_COMMENTS_UPD_OK='Comentario actualizado existosamente';//Comments updated successfully
  $MESSAGE_COMMENTS_UPD_ERR='Error al actualizar comentario.';//Error while updating comments. Please try later

  $MESSAGE_RATING_UPD_OK='Calificación actualizada existosamente';//Ratings updated successfully
  $MESSAGE_RATING_UPD_ERR='Error al actualizar calificación.';//Error while updating ratings. Please try later

  $MESSAGE_PRODUCT_REMOVED_OK="Producto exitosamente eliminado desde coche de compras";//Product removed from cart successfully
  $MESSAGE_PRODUCT_REMOVED_ERR="Error al eliminar producto desde coche de compras.";//Error while removing product from cart.Please contact our call center


  $MESSAGE_NOTIFY_PRODUCT_AVAILABILITY='Gracias. Le notificaremos si encontramos su producto.';//Thanks. We will notify you when the product is available.
  $MESSAGE_NOTIFY_PRODUCT_AVAILABILITY_ERR='Error al registrar datos para notificar.';//Error while registering the details to notify. Please try later
  $MESSAGE_MSG_SENT_OK="<div class='alert alert-success shopAlert'>Mensaje enviado exitosamente.</div>";//<div class='alert alert-success shopAlert'>Your Message sent successfully.</div>
  $MESSAGE_MSG_SENT_ERR="<div class='alert alert-danger shopAlert'>Error al enviar el mensaje.Intenta nuevamente o contáctate con servicio al cliente.</div>";//<div class='alert alert-danger shopAlert'>Message sending Failed. Please try Again</div>




  $STRING_PWD_CHANGE_REQ="SOLICITUD DE CAMBIO DE CLAVE";//PASSWORD CHANGE REQUEST
  $STRING_WELCOME="Hola ";//Hello 
  $STRING_YOUR_NEW_PWD="Tu nueva clave es:";//Your new password is 
  $STRING_NOTE="NOTA: Si no solicitaste cambio de clave, contáctate inmediatamente con servicio al cliente.\n";//NOTE: If you didnot requested for password change, please contact to our customer care
  #$STRING_FROM_EMAIL="From: info@ecuahomeshop.com";
  $STRING_FROM_EMAIL='From: ECUAHOMESHOP <info@ecuahomeshop.com>';
  $STRING_PWD_SENT_OK="Nueva clave enviada a tu correo electrónico registrado en nuestro sistema.";//New password has been sent to your registered email id. Please check your mail
  $STRING_PWD_SENT_ERR="Error al enviar correo electrónico. Intenta nuevamente o contáctate con servicio al cliente.";//Password sending failed. Please Try again later
  $STRING_USER_NOT_EXIST="Usuario no existente.Ingresar usuario correcto.";//User not exists. Please enter correct User


  $STRING_NEW_REGISTRATION_REQ="BIENVENIDO A ECUAHOMESHOP. DISFRUTA UN NUEVO MUNDO DE COMPRAS!!";//PASSWORD CHANGE REQUEST
  $STRING_NEW_REG_STR_01="Gracias por registrarte con EcuaHomeShop(http://www.ecuahomeshop.com)";
  $STRING_NEW_REG_STR_02="Sus detalles de login son:";
  $STRING_NEW_REG_STR_03="Nombre Usuario:";
  $STRING_NEW_REG_STR_04="Clave:";
  $STRING_NEW_REG_STR_05="FELICES COMPRAS!!";
  $STRING_NEW_REG_NOTE="NOTA: Si no registraste este usuario, contáctate inmediatamente con servicio al cliente.\n";

  $STRING_NEW_ORDER_REQ="SOLICITUD DE NUEVA ORDEN ";//NEW ORDER REQUEST - 
  //$STRING_NEW_ORDER_RECD_OK="Your order :".$_SESSION['Order_id']." recieved successfully\n\n";
  $STRING_NEW_ORDER_RECD_OK_1="Nueva orden : ";//New order :
  $STRING_NEW_ORDER_RECD_OK_2=" recibida para procesar. Le llamaremos al nro de contacto para confirmar su orden.\n\n"; //recieved for processing. We will call your contact number to confirm the order.
  $STRING_NOTE2="NOTA: Si no realizaste esta compra,contáctate con servicio al cliente.\n";//NOTE: If you didnot placed this order, please contact to our customer care
  //$STRING_ORDER_CONFIRMED_MAIL="Your order is confirmed.Your Order ID is:".$_SESSION['Order_id'].". Please keep this order number safe with you. We will call you shortly to confirm the order and start delivery.";
  $STRING_ORDER_CONFIRMED_MAIL_1="Orden confirmado. Tu nro de orden es: ";//Your order is confirmed.Your Order ID is:
  $STRING_ORDER_CONFIRMED_MAIL_2=". Mantenga este nro orden para cualquier comunicación. Nro de orden ha sido enviada a su correo electrónico.Le llamaremos pronto para confirmar su orden. Gracias por realizar compras con ECUAHOMESHOP";//. Please keep this order number safe with you. A notification is sent to the email id registered with us.We will call you shortly to confirm the order and start delivery. Thanks for shopping with us.
  $STRING_ORDER_CONFIRMED_ERR="Error al confirmar orden.Intenta nuevamente o contáctate con servicio al cliente.";//Error while confirming your order. Please try later.


  $STRING_ORDER_MODIFY_REQ="SOLICITUD DE MODIFICACION DE ORDEN ";//MODIFY ORDER REQUEST - 
  $STRING_MODIFY_ORDER="Recibimos modificación de orden :";//You modify your order :
  $STRING_NOTE5="NOTA: Si no modificaste está orden,contáctate con servicio al cliente. \n";//NOTE: If you didnot placed or modify this order, please contact to our customer care.
  $MSG_ORDEN_MODIFY_1="Nro de orden: ";//Your order is confirmed.Your Order ID is:
  $MSG_ORDEN_MODIFY_2=" modificada exitosamente. Mantenga este nro orden para cualquier comunicación. Nro de orden ha sido enviada a su correo electrónico.Le llamaremos pronto para confirmar su orden. Gracias por realizar compras con ECUAHOMESHOP.";//. Please keep this order number safe with you. We will call you shortly to confirm the order and start delivery.


  $STRING_ORDER_CANCELLED="SOLICITUD DE CANCELACIÓN DE ORDEN - ";//ORDER CANCELLED - 
  $STRING_CANCELLED_ORDER="Recibimos solicitud de cancelación del orden :";//You cancelled your order :
  $STRING_NOTE3="NOTA: Si no solicitaste cancelación de orden,contáctate con servicio al cliente. \n";//NOTE: If you didnot cancelled this order, please contact to our customer care.
  //$STRING_CANCELLED_ORDER_ERR="Error while canceling your order ".$_GET['orderId'].".Please contact our call center.";
  $STRING_CANCELLED_ORDER_ERR_1="Error al cancelar orden: ";//Error while canceling your order 
  $STRING_CANCELLED_ORDER_ERR_2=".Contáctate con servicio al cliente.";//.Please contact our call center.

  $STRING_SUBSCRIPTION_NOTIFICATION="SOLICITUD DE NUEVA SUSCRIPCIÓN";//SUBSCRIPTION NOTIFICATION
  $STRING_GREET_SUBSCRIBER="Estimado suscriptor\n\n\n";//Dear Subscriber!
  $STRING_SUBSCRIPTION_REGISTERED_OK="Solicitud de suscripción registrada exitosamente.\n\n\n";//Your subsciption request is registered successfully.
  $STRING_NOTE4="NOTA: Si no solicitaste esta suscripción,contáctate con servicio al cliente. \n";//NOTE: If you didnot requested for subscription, please contact to our customer care.

  $STRING_UNSCRIBE_NOTIFICATION="SOLICITUD DE DAR BAJA DEL SUSCRIPCIÓN";//SUBSCRIPTION NOTIFICATION
  $STRING_UNSCRIBE_REGISTERED_OK="Solicitud de dar baja del suscripción registrada exitosamente.";//Your subsciption request is registered successfully.
  $STRING_NOTE_UNSCRIBE="NOTA: Si no solicitaste dar baja el suscripción,contáctate con servicio al cliente. \n";//NOTE: If you didnot requested for subscription, please contact to our customer care.
  $STRING_UNSCRIBE_REGISTERED_ERR="Error al procesar dar de baja su suscripción, contáctate con servicio al cliente.<a href=";
  $STRING_UNSCRIBE_REGISTERED_ERR2="No encunetra ningun suscripción para dar de baja el suscripción.<a href=";


  $ALERT_CONFIRM_DROP_ORDER="Está seguro de borrar este orden?";//Are you sure to drop this order.
  $ALERT_CONFIRM_DELETE_ORDER="Está seguro de borrar este orden?";//Are you sure to delete this order.
  $ALERT_CONFRIM_DELETE_PRODUCT_1="Está seguro de borrar '";//Are you sure to delete '
  $ALERT_CONFRIM_DELETE_PRODUCT_2="' desde coche de compras?";//' from your cart
  //$MESSAGE_SUBSCRIPTION_OK='Your email registered successfully in our database. Thanks for subscribing with Us.<a href='.$pageURL.' class="submit_button">Continue</a>';
  $MESSAGE_SUBSCRIPTION_OK_1='Correo electrónico registrado existosamente en nuestro sistema.Gracias por suscribirse con nosotros.<a href=';//Your email registered successfully in our database. Thanks for subscribing with Us
  $MESSAGE_SUBSCRIPTION_OK_2=' class="submit_button">Continuar</a>';// class="submit_button">Continue</a>
  //$MESSAGE_SUBSCRIPTION_ERR='Error registering your email in our database. Please try again later or contact our customer care.<a href='.$pageURL.' class="submit_button">Continue</a>';
  $MESSAGE_SUBSCRIPTION_ERR_1='Error al registrar correo electrónico en nuestro sistema.Intenta nuevamente o contáctate con servicio al cliente.<a href=';//Error registering your email in our database. Please try again later or contact our customer care.<a href=
  $MESSAGE_SUBSCRIPTION_ERR_2=' class="submit_button">Continuar</a>';// class="submit_button">Continue</a>
  //$MESSAGE_SUBSCRIPTION_EXISTS='Your email is already registered in our database.<a href='.$pageURL.' class="submit_button">Continue</a>';
  $MESSAGE_SUBSCRIPTION_EXISTS_1='Correo electrónico ya existente.<a href=';//Your email is already registered in our database.<a href=
  $MESSAGE_SUBSCRIPTION_EXISTS_2=' class="submit_button">Continuar</a>';// class="submit_button">Continue</a>



?>