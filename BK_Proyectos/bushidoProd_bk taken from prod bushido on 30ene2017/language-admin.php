<?php

	// IMPORTANT:
	// ==========
	// When translating, only translate the strings that are
	// TO THE RIGHT OF the equal sign (=).
	//
	// Do NOT translate the strings between square brackets ([])
	//
	// Also, leave the text between < and > untranslated.
	//
	// =====================================================

	// incHeader.php
	$Translation['membership management'] = "Gestión de Usuarios";
	$Translation['password mismatch'] = "La contraseña no coincide.";
	$Translation['error'] = "Error";
	$Translation['invalid email'] = "Dirección de correo electrónico no válida";
	$Translation['sending mails'] = "El envío de correos puede tomar algún tiempo. No cierre esta página hasta que vea el mensaje 'Listo'.";
	$Translation['complete step 4'] = "Complete el paso 4 seleccionando el miembro al que desea transferir los registros.";
	$Translation['info'] = "Info";
	$Translation['sure move member'] = 'Está seguro de que desea mover el usuario \'<MEMBER>\' y sus datos del grupo \'<OLDGROUP>\' hacia el grupo \'<NEWGROUP>\'?';
	$Translation['sure move data of member'] = 'Está seguro de que desea mover los datos del usuario \'<OLDMEMBER>\' desde el grupo \'<OLDGROUP>\' hacia el miembro \'<NEWMEMBER>\' del grupo \'<NEWGROUP>\'?';
	$Translation['sure move all members'] = 'Está seguro de que desea mover todos los miembros y datos del grupo \'<OLDGROUP>\' hacia el grupo \'<NEWGROUP>\'?';
	$Translation['sure move data of all members'] = 'Está seguro de que desea mover los datos de todos los usuarios del grupo \'<OLDGROUP>\' hacia el usuario \'<MEMBER>\' del grupo \'<NEWGROUP>\'?';
	$Translation['toggle navigation'] = "Navegavilidad";
	$Translation['admin area'] = "Area del Administrador";
	$Translation['groups'] = "Grupos";
	$Translation['view groups'] = "Ver Grupos";
	$Translation['add group'] = "Agregar Grupo";
	$Translation['edit anonymous permissions'] = "Editar permisos anónimos";
	$Translation['members'] = "Usuarios";
	$Translation['view members'] = "Ver Usuarios";
	$Translation['add member'] = "Agregar Usuario";
	$Translation["view members' records"] = "Ver Registros de Usuarios";  
	$Translation["utilities"] = "Herramientas"; 
	$Translation["admin settings"] = "Configuración de administrador"; 
	$Translation["rebuild thumbnails"] = "Rebuild Thumbnails"; 
	$Translation['rebuild fields'] = "Rebuild fields";
	$Translation['import CSV'] = "Importar registros CSV";
	$Translation['batch transfer'] = "Batch Transfer Wizard";
	$Translation['mail all users'] = "Enviar Mail a todos los usuarios";
	$Translation['AppGini forum'] = "Coral Francisco";
	$Translation["user's area"] = 'Area de Usuarios';
	$Translation["sign out"] = "Desconectar";
	$Translation["attention"] = "Atención!";
	$Translation['security risk admin'] = 'Está utilizando el nombre de usuario y la contraseña de administrador predeterminados. Este es un riesgo de seguridad enorme. Cambia al menos la contraseña de administrador de la <a href="pageSettings.php"> Configuración de administrador </a> página <em> inmediatamente </em>. ';

	$Translation['security risk'] = 'Está utilizando la contraseña de administrador predeterminada. Este es un riesgo de seguridad enorme. Cambie la contraseña de administrador de la página <a href="pageSettings.php"> Configuración de administrador </a><em> inmediatamente</em>' ;

	$Translation['plugins'] = 'Complementos';

	//pageAssignOwners.php
	$Translation["assigned table records to group"] = "Asignado <NUMBER> registros de la tabla '<TABLE>' hacia el grupo '<GROUP>'";
	$Translation["assigned table records to group and member"] = "Asignado <NUMBER> registros de la tabla '<TABLE>' hacia el grupo '<GROUP>' , usuario '<MEMBERID>'";
	$Translation['data ownership assign'] = "Asignar propiedad a datos que no tienen propietarios";
	$Translation['records ownership done'] = "Todos los registros de todas las tablas tienen propietarios ahora. <br> Volver a <a href='pageHome.php'> Página principal del administrador </a>.";
	$Translation['select group'] = "Seleccionar Grupo";
	$Translation['data ownership'] = "A veces, es posible que tenga tablas con datos que se introdujeron antes de implementar este sistema de gestión de pertenencias, o que se introdujeron utilizando otras aplicaciones sin tener en cuenta el sistema de propiedad. Actualmente, estos datos no tienen propietarios. Esta página le permite asignar grupos de propietarios y miembros propietarios a estos datos.";
	$Translation["table"] = "Tabla";
	$Translation["records with no owners"] = "Registros sin propietarios";
	$Translation["new owner group"] = "Nuevo propietario de grupo";
	$Translation["new owner member"] = "Usuario Nuevo*";	
	$Translation["cancel"] = "Cancelar";
	$Translation["assign new owners"] = "Asignar nuevo dueño";
	$Translation["please wait"] = "Por favor espere ...";	
	$Translation["if no owner member assigned"] = '* Si no asignas ningún miembro propietario aquí, puedes seguir usando el <a href="pageTransferOwnership.php"> Asistente para la transferencia por lotes </a> para hacerlo más adelante.';
	
	//pageDeleteGroup.php
	$Translation["can not delete group remove members"] = 'No se puede eliminar este grupo. Elimine primero los miembros.';
	$Translation["can not delete group transfer records"] = 'No se puede eliminar este grupo. Por favor, transfiera sus registros de datos a otro grupo primero.';
	
	//pageEditGroup.php
	$Translation["group exists error"] = "Error: El nombre de grupo ya existe. Debe elegir un nombre de grupo único.";
	$Translation["group not found error"] = "Error: ¡Grupo no encontrado!";								 	
	$Translation["edit group"] = "Editar Grupo '<GROUPNAME>'";
	$Translation["add new group"] = "Agregar Nuevo Grupo";
	$Translation["anonymous group attention"] = "¡Atención! Este es el grupo anónimo.";
	$Translation["show tool tips"] = "Mostrar sugerencias de herramientas mientras el ratón se mueve sobre las opciones";
	$Translation["group name"] = "Nombre del Grupo";
	$Translation["readonly group name"] = "El nombre del grupo anónimo es de sólo lectura aquí.";
	$Translation["anonymous group name"] = "Si nombra el grupo '<ANONYMOUSGROUP>', se considerará el grupo anónimo <br> que define los permisos de visitantes invitados que no inician sesión en el sistema.";
	$Translation["description"] = "Descripcion";
	$Translation["allow visitors sign up"] = 'Permitir que los visitantes se inscriban?';
	$Translation["admin add users"] = "No. Sólo el administrador puede agregar usuarios.";
	$Translation["admin approve users"] = "Sí, y el administrador debe aprobarlos.";
	$Translation["automatically approve users"] = "Sí, y aprobarlas automáticamente.";
	$Translation["group table permissions"] = "Permisos de tabla para este grupo";
	$Translation["no"] = "No";
	$Translation["owner"] = "Propietario";
	$Translation["group"] = "Grupo";
	$Translation["all"] = "Todos";
	$Translation["insert"] = "Insertar";
	$Translation["view"] = "Ver";
	$Translation["edit"] = "Editar";
	$Translation["delete"] = "Borrar";
	$Translation["save changes"] = "Guardar Cambios";
	
	//pageEditMember.php
	$Translation["username error"] = "Error: El nombre de usuario ya existe o no es válido. Asegúrese de proporcionar un nombre de usuario que contenga de 4 a 20 caracteres válidos.";
	$Translation["member not found"] = "Error: Miembro no encontrado!";
	$Translation["user has special permissions"] = "Este usuario tiene permisos especiales que anulan sus permisos de grupo.";
	$Translation["user has group permissions"] = 'Este usuario hereda los permisos <a href="pageEditGroup.php?groupID=<GROUPID>"> de su grupo </a>.';
	$Translation["set user special permissions"] = 'Establecer permisos especiales para este usuario';
	$Translation["sure continue"] = "Si ha realizado algún cambio en este miembro y aún no lo ha guardado, se perderá si continúa. Estás seguro de que quieres continuar?";
	$Translation["edit member"] = "Editar Usuario <MEMBERID>" ;
	$Translation["add new member"] = "Agregar nuevo usuario";
	$Translation["anonymous guest member"] = "¡Atención! Este es el miembro anónimo (invitado).";
	$Translation["admin member"] = '¡Atención! Este es el miembro admin. No puede cambiar el nombre de usuario, la contraseña o el correo electrónico de este miembro aquí, pero puede hacerlo en la página <a href="pageSettings.php"> Configuración del administrador </a>.';
	$Translation["member username"] = "Nombre de usuario";
	$Translation["check availability"] = "Consultar disponibilidad";
	$Translation["read only username"] = "El nombre de usuario del miembro invitado es de sólo lectura.";
	$Translation["password"] = "Password";
	$Translation["change password"] = "Escriba una contraseña sólo si desea cambiar la contraseña <br> de este miembro. De lo contrario, deje este campo vacío.";
	$Translation["confirm password"] = "Confirmar contraseña";
	$Translation["email"] = "Email";
	$Translation["approved"] = "Aprobado?";
	$Translation["banned"] = "Baneado?";
	$Translation["comments"] = "Comentario";
	$Translation["back to members"] = "Regresar a usuarios";
	$Translation["member added"] = "Usuario <USERNAME> agregado satisfactoriamente";
	
	//pageEditMemberPermissions.php
	$Translation["member permissions saved"] = "Los permisos de miembro se han guardado correctamente.";
	$Translation["member permissions reset"] = "Los permisos de miembro se han restablecido al mismo que su grupo.";
	$Translation["user table permissions"] = "Permisos de tabla para el usuario <a href='pageEditMember.php?memberID=<MEMBER> 'title =' Ver detalles del Usuario'> <MEMBERID> </a> del grupo <a href='pageEditGroup.php?groupID=<GROUPID> 'title ='Ver detalles y permisos de grupo'><GROUP></a> ";
	$Translation["no member permissions"] = 'Este miembro no tiene actualmente ningún permiso especial. Esta lista muestra los permisos de su grupo.';
	$Translation["reset member permissions"] = "Restablecer permisos de usuario";
	$Translation["remove special permissions"] = 'Esto eliminaría todos los permisos especiales de este usuario y él tendrá los mismos permisos que su grupo. ¿Seguro que quieres hacer eso?';
	
	//pageEditOwnership.php
	$Translation["invalid table"] = "Tabla no válida.";
	$Translation["invalid primary key"] = "Valor de clave principal no válido";
	$Translation["record not found"] = "Registro no encontrado ... si se importó externamente, intente asignar un propietario desde el área de administración.";
	$Translation["invalid username"] = "Nombre de usuario no válido";
	$Translation["record not found error"] = "Error: ¡Registro no encontrado!";
	$Translation["edit Record Ownership"] = "Editar propietario del Registro";
	$Translation["owner group"] = "Grupo Propietario";
	$Translation["view all records by group"] = "Ver todos los registros de este grupo";
	$Translation["owner member"] = "Usuario Propietario";
	$Translation["view all records by member"] = "View all records by this member";
	$Translation["switch record ownership"] = "Si desea cambiar la propiedad de este registro a un miembro de otro grupo, debe cambiar el grupo de propietarios y guardar primero los cambios.";
	$Translation["record created on"] = "Registro creado en";
	$Translation["record modified on"] = "Registro modificado en";
	$Translation["view all records of table"] = "Ver todos los registros de esta tabla";
	$Translation["record data"] = "Grabar Informacion";
	$Translation["print"] = "Imprimir";
	$Translation["could not retrieve field list"] = "No se pudo recuperar la lista de campos de '<TABLENAME>'";
	$Translation["field name"] = "Nombre del campo";
	$Translation["value"] = "Valor";
	
	//pageHome.php
	$Translation["visitor sign up"] = '<a href="../membership_signup.php" target="_blank"> El registro de visitantes </a> está deshabilitado porque no hay grupos en los que los visitantes puedan inscribirse actualmente. Para habilitar la suscripción de visitantes, establezca al menos un grupo para permitir la inscripción de visitantes.';
	$Translation["table data without owner"] = 'Tiene datos en una o más tablas que no tienen propietario. Para asignar un grupo de propietarios para estos datos, <a href="pageAssignOwners.php"> haga clic aquí </a>.';
	$Translation["membership management homepage"] = "Página de Gestión y Administración del Sistema";
	$Translation["newest updates"] = "Nuevas actualizaciones";
	$Translation["view record details"] = "Ver detalles del registro";
	$Translation["newest entries"] = "Entradas más recientes";
	$Translation["available add-ons"] = "Complementos Disponibles";
	$Translation["more info"] = "Más información";
	$Translation["close"] = "Cerrar";
	$Translation["view add-ons"] = "Ver todos los complementos";
	$Translation["top members"] = "Miembros Principales";
	$Translation["edit member details"] = "Editar detalles de los miembros
";
	$Translation["view member records"] = "Ver los registros de datos del usuario";
	$Translation["records"] = "registros";
	$Translation["members stats"] = "Estadísticas de los Usuarios";
	$Translation["total groups"] = "Total de Grupos";
	$Translation["active members"] = "Usuarios Activos";
	$Translation["view active members"] = "Ver Usuarios Activos";
	$Translation["members awaiting approval"] = "Usuarios en espera de aprobación";
	$Translation["view members awaiting approval"] = "Ver usuarios en espera de aprobación";
	$Translation["banned members"] = "Usuarios bloqueados";
	$Translation["view banned members"] = "Ver Usuarios bloqueados";
	$Translation["total members"] = "Total de Usuarios";
	$Translation["view all members"] = "Ver todos los Usuarios";
	$Translation["BigProf tweets"]  = "Tweets por Francisco Coral";
	$Translation["follow BigProf"] = "Seguir a @franc1893";
	$Translation["loading bigprof feed"] = "Cargando @franc1893 feed ...";
	$Translation["remove feed"] = "Eliminar este feed";
	
	//pageMail.php
	$Translation["can not send mail"] = "No puedes enviar correos electrónicos actualmente. La dirección de correo electrónico del remitente configurada no es válida. Por favor <a href='pageSettings.php'> corregir primero </a> e intentarlo de nuevo.";
	$Translation["all groups"] = "Todos los Grupos";
	$Translation["no recipient"] = "No se pudo encontrar el destinatario. Asegúrese de proporcionar un destinatario válido.";
	$Translation["invalid subject line"] = "Línea de asunto no válida.";
	$Translation["no recipient found"] = "No se pudo encontrar ningún destinatario. Asegúrese de proporcionar un destinatario válido.";
	$Translation["mail queue not saved"] = "No se pudo guardar la cola de correo. Asegúrese de que el directorio '<CURRDIR>' puede escribirse (chmod 755 o chmod 777).";
	$Translation["send mail"]  = "Enviar mensaje de correo a un miembro / grupo";
	$Translation["send mail to all members"] = "Usted está enviando un correo electrónico a todos los miembros. Esto podría tomar mucho tiempo y afectar el rendimiento del servidor. Si usted tiene un gran número de miembros, no recomendamos enviar un correo electrónico a todos ellos a la vez.";
	$Translation["from"] = "De";
	$Translation["change setting"] = "Cambiar esta configuración";
	$Translation["to"] = "Para";
	$Translation["subject"] = "Asunto";
	$Translation["message"] = "Mensaje";
	$Translation["send message"] = "Enviar Mensaje";
	
	//pagePrintRecord.php
	$Translation["record details"] = "Gestión de Usuarios -- Detalles del Registro ";
	$Translation['table name'] = "Tabla: <TABLENAME>";
	
	//pageRebuildFields.php
	$Translation['create or update table'] = "Se ha realizado un intento de <ACTION> el campo <i> <FIELD> </ i> en la tabla <i> <TABLE> </ i> ejecutando esta consulta: <pre> <QUERY> </ pre> abajo.";

	$Translation['view or rebuild fields'] = "Ver / Reconstruir campos";
	$Translation['show deviations only'] = "Mostrar sólo desviaciones";
	$Translation['show all fields'] = "Mostrar todos los campos";
	$Translation['compare tables page'] = "Esta página compara las tablas y la estructura / esquema de los campos como se diseñó en con la estructura de la base de datos actual y le permite corregir cualquier desviación.";
	$Translation['field'] = "Campo";
	$Translation['AppGini definition'] = "Definición";
	$Translation['database definition'] = "Definición actual en la base de datos";
	$Translation['table name title'] = "<TABLENAME> tabla";
	$Translation['does not exist'] = "¡No existe!";
	$Translation['create field'] = "Cree el campo ejecutando una consulta ADD COLUMN.";
	$Translation['create it'] = "Crea eso";
	$Translation['fix field'] = "Corrige el campo ejecutando una consulta ALTER COLUMN para que su definición se convierta en la misma que en la aplicación.";
	$Translation['fix it'] = "Arreglar";
	$Translation['field update warning'] = "¡¡PELIGRO!! En algunos casos, esto podría conducir a pérdida de datos, truncamiento o corrupción. Puede ser una mejor idea, a veces, actualizar el campo de la aplicación para que coincida con el de la base de datos. ¿Aún te gustaría continuar?";
	$Translation['no deviations found'] = "No se encontraron desviaciones. Todos los campos OK!";
	$Translation['error fields'] = "Encontrados <CREATENUM> campos no existentes que deben ser creados. <br> Found <UPDATENUM> campos que pueden necesitar ser actualizados.";
	
	//pageRebuildThumbnails.php
	$Translation['rebuild thumbnails'] = "Reconstruir miniaturas";
	$Translation['thumbnails utility'] = "Utilice esta utilidad si tiene uno o más campos de imagen en una tabla que no tienen miniaturas o tienen miniaturas con dimensiones incorrectas.";
	$Translation['rebuild thumbnails of table'] = "Reconstruir miniaturas de la tabla";
	$Translation['rebuild'] = "Reconstruir";
	$Translation['rebuild thumbnails of table_name'] = "Reconstruyendo las miniaturas de la tabla '<i><TABLENAME></i>' ...";
	$Translation['do not close page message'] = "No cierre esta página hasta que aparezca un mensaje de confirmación de que todas las miniaturas han sido creadas.";	
	$Translation['rebuild thumbnails status'] = "Estado: sigue reconstruyendo las miniaturas, por favor espere ...";
	$Translation['building field thumbnails'] =  "Creación de miniaturas para el campo '<i><FIELD></i>' ...";
	$Translation['done'] = "Hecho.";
	$Translation['finished status'] = "Estado: Finalizado. Puede cerrar esta página ahora.";
	
	//pageSender.php
	$Translation['invalid mail queue'] = "Cola de correo no válida.";
	$Translation['sending message failed'] = " -- Sending message to '<EMAIL>': Failed.";
	$Translation['sending message ok'] = " -- Enviando mensaje a '<EMAIL>': Ok.";
	$Translation['done!'] = "Hecho!";
	$Translation['close page'] = "Puede cerrar esta página ahora o buscar otra página.";
	$Translation['mail log'] = "Mail log:";
	
	//pageSettings.php
	$Translation['invalid security token'] = 'Token de seguridad no válido <a href="pageSettings.php"> vuelva a cargar la página </a> e inténtelo de nuevo.';
	$Translation['unique admin username error'] = "El nuevo nombre de usuario de administrador ya lo ha tomado otro miembro. Asegúrese de que el nuevo nombre de usuario de administrador es único.";	
	$Translation['unique anonymous username error'] = 'El nuevo nombre de usuario anónimo ya está tomado por otro miembro. Asegúrese de que el nombre de usuario proporcionado es único.';
	$Translation['unique anonymous group name error'] = 'El nuevo nombre de grupo anónimo ya está en uso por otro grupo. Asegúrese de que el nombre del grupo proporcionado es único.';
	$Translation['admin password mismatch'] = '"Contraseña de administrador" y "Confirmar contraseña" no coinciden.';
	$Translation['invalid sender email'] = '"Correo de remitente" no válido.';
	$Translation['errors occurred'] = "Los siguientes errores ocurrieron:";
	$Translation['go back'] = 'Por favor <a href="pageSettings.php" onclick="history.go(-1); return false;"> vuelve </a> para corregir los errores anteriores y vuelve a intentarlo.';
	$Translation['record updated automatically'] = "Registro actualizado automáticamente el <DATE>";
	$Translation['admin settings saved'] = "Configuración de administrador guardada correctamente.<br>Regresar a <a href=\"pageSettings.php\">Configuración de Administrador</a>.";
	$Translation['admin settings not saved'] = "La configuración de administrador no se guardó correctamente. Razón de fracaso: <ERROR><br>Regresar a <a href=\"pageSettings.php\" onclick=\"history.go(-1); return false;\">Configuración de administrador</a>.";
	$Translation['show tool tips'] = 'Mostrar sugerencias de herramientas mientras el ratón se mueve sobre las opciones';
	$Translation['admin username'] = "Username del Administrador";
	$Translation['admin password'] = "Password del Administrador";
	$Translation['change admin password'] = "Escriba una contraseña sólo si desea cambiar la contraseña de administrador.";
	$Translation['sender email'] = "Correo electrónico del remitente";
	$Translation['sender name and email'] = "El nombre del remitente y el correo electrónico se utilizan en el campo 'Para' al enviar";
	$Translation['email messages'] = "Mensajes de correo electrónico a grupos o miembros.";
	$Translation['admin notifications'] = "Notificaciones de administrador";
	$Translation['no email notifications'] = "No hay notificaciones por correo electrónico a admin.";
	$Translation['member waiting approval'] = "Notificar a admin sólo cuando un nuevo miembro está esperando la aprobación.";
	$Translation['new sign-ups'] = "Notificar a admin para todas las nuevas inscripciones.";
	$Translation['sender name'] = "Nombre del remitente";
	$Translation['members custom field 1'] = "Campo personalizado de usuarios 1";
	$Translation['members custom field 2'] = "Campo personalizado de usuarios 2";
	$Translation['members custom field 3'] = "Campo personalizado de usuarios 3";
	$Translation['members custom field 4'] = "Campo personalizado de usuarios 4";
	$Translation['member approval email subject'] = "Asunto del correo electrónico <br > de aprobación del usuario";
	$Translation['member approval email subject control'] = "Cuando el administrador aprueba un miembro, el miembro es notificado por<br> correo electrónico que está aprobado. Puede controlar el asunto del correo electrónico de <br>aprobación en esta casilla y el contenido en el cuadro siguiente.";
	$Translation['member approval email message'] = "Mensaje de correo electrónico <br>de aprobación del miembro";
	$Translation['MySQL date'] = "MySQL date<br>formatting string";
	$Translation['MySQL reference'] = 'Ir a <a href="http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date-format" target="_blank">the MySQL reference</a> para todos los posibles formatos.';
	$Translation['PHP short date'] = "PHP short date<br>formatting string";
	$Translation['PHP manual'] = 'Please refer to <a href="http://www.php.net/manual/en/function.date.php" target="_blank">the PHP manual</a> for possible formats.'; 
	$Translation['PHP long date'] = "PHP long date<br>formatting string";
	$Translation['groups per page'] = "Grupos por página";
	$Translation['members per page'] = "Usuarios por página";
	$Translation['records per page'] = "Registros por página";
	$Translation['default sign-up mode'] = "Modo de registro predeterminado <br>para los nuevos grupos";
	$Translation['no sign-up allowed'] = "No se permite la inscripción. Sólo el administrador puede agregar miembros.";
	$Translation['admin approve members'] = "Se permite la inscripción, pero el administrador debe aprobar los miembros.";
	$Translation['automatically approve members'] = "Se permite la suscripción y aprueba automáticamente los miembros.";
	$Translation['anonymous group'] = "Nombre del grupo <br>anónimo";
	$Translation['anonymous user name'] = "Nombre del usuario <br>anónimo";
	$Translation['hide twitter feed'] = "Ocultar feed de Twitter<br>en la página principal de administración?";
	$Translation['twitter feed'] = "Nuestro feed de Twitter le ayuda a mantenerse informado de nuestras últimas noticias, recursos útiles, nuevas versiones y muchos otros consejos útiles.";
	
	//pageTransferOwnership.php
	$Translation['invalid source member'] = "Se ha seleccionado un usuario de origen no válido.";
	$Translation['invalid destination member'] = "Se ha seleccionado un miembro de destino no válido.";
	$Translation['moving member'] = "Moving member '<MEMBERID>' and his data from group '<SOURCEGROUP>' to group '<DESTINATIONGROUP>' ...";
	$Translation['data records transferred'] = "Member '<MEMBERID>' now belongs to group '<NEWGROUP>'. Data records transferred: <DATARECORDS>.";
	$Translation['moving data'] = "Moving data of member '<SOURCEMEMBER>' from group '<SOURCEGROUP>' to member S'<DESTINATIONMEMBER>' from group '<DESTINATIONGROUP>' ...";
	$Translation['member records status'] = "Member '<SOURCEMEMBER>' of group '<SOURCEGROUP>' had <DATABEFORE> data records. <TRANSFERSTATUS> to member '<DESTINATIONMEMBER>' of group '<DESTINATIONGROUP>'.";
	$Translation['moving all group members'] = "Moving all members and data of group '<SOURCEGROUP>' to group '<DESTINATIONGROUP>' ...";
	$Translation['failed transferring group members'] = "Operation failed. No members were transferred from group '<SOURCEGROUP>' to '<DESTINATIONGROUP>'.";
	$Translation['group members transferred'] = "All members of group '<SOURCEGROUP>' now belong to '<DESTINATIONGROUP>'. ";
	$Translation['failed transfer data records'] = "However, data records failed to transfer.";
	$Translation['data records were transferred'] = "<DATABEFORE> data records were transferred.";
	$Translation['moving group data to member'] = "Moving data of all members of group '<SOURCEGROUP>' to member '<DESTINATIONMEMBER>' from group '<DESTINATIONGROUP>' ...";
	$Translation['moving group data to member status'] = "<NUMBER> record(s) were transferred from group '<SOURCEGROUP>' to member '<DESTINATIONMEMBER>' of group '<DESTINATIONGROUP>'";
	$Translation['status'] = "STATUS:";
	$Translation['batch transfer link'] = 'To repeat the same batch transfer again later you can <a href= "pageTransferOwnership.php?sourceGroupID=<SOURCEGROUP>&amp;sourceMemberID=<SOURCEMEMBER>&amp;destinationGroupID=<DESTINATIONGROUP>&amp;destinationMemberID=<DESTINATIONMEMBER>&amp;moveMembers=<MOVEMEMBERS>">bookmark or copy this link</a>.';
	$Translation['ownership batch transfer'] = "Transferencia por lotes de propiedad";
	$Translation['step 1'] = "PASO 1:";
	$Translation['batch transfer wizard'] = "El asistente de transferencia por lotes le permite transferir registros de datos de uno o todos los miembros de un grupo (el <i> grupo de origen </i>) a un miembro de otro grupo (el <i> miembro de destino </i> I> grupo de destino </i>)";
	$Translation['source group'] = "Grupo de origen";
	$Translation['update'] = "Actualizar";
	$Translation['next step'] = "Próximo paso";
	$Translation['group statistics'] = "Este grupo tiene <MEMBERS> miembros y <RECORDS> registros de datos.";
	$Translation['step 2'] = "PASO 2:";
	$Translation['source member message'] = "El miembro fuente podría ser un miembro o todos los miembros del grupo de origen.";
	$Translation['source member'] = "Usuario de la Fuente";
	$Translation['all group members'] = "Todos los usuarios de '<GROUPNAME>'";
	$Translation['member statistics'] = "Este usuario tiene <RECORDS> registros de datos.";
	$Translation['step 3'] = "PASO 3:";
	$Translation['destination group message'] = "El grupo de destino podría ser igual o diferente del grupo de origen. A continuación se enumeran los grupos que tienen miembros.";
	$Translation['destination group'] = "Grupo de destino";
	$Translation['step 4'] = "	PASO 4:";
	$Translation['destination member message'] = "El miembro de destino será el nuevo propietario de los registros de datos del miembro de origen.";
	$Translation['destination member'] = "Miembro de destino";
	$Translation['begin transfer'] = "Comienza la transferencia";	
	$Translation['move records'] = "Puede mover registros del miembro de origen a un miembro del grupo de destino o mover el miembro de origen junto con sus registros de datos al grupo de destino.";
	$Translation['move data records to member'] = "Mover registros de datos a este miembro:";
	$Translation['move source member to group'] = "Mueva el miembro de origen y todos sus registros de datos al grupo '<GROUPNAME>'.";
	
	//pageUploadCSV.php
	$Translation['file not found error'] = "Error: No se encontró el archivo '<FILENAME>'.";
	$Translation['preview and confirm CSV data'] = "Previsualice los datos CSV y confirme para importarlos ...";
	$Translation['display csv file rows'] = "Visualización de las primeras 10 filas del archivo CSV ...";
	$Translation['change CSV settings'] = 'Cambiar la configuración de CSV';
	$Translation['import CSV data'] = 'Confirmar e importar datos CSV &gt;';
	$Translation['apply CSV settings'] = 'Aplicar configuración de CSV';
	$Translation['importing CSV data'] = 'Importar datos CSV ...';
	$Translation['start at estimated record'] = "Comenzando en el registro <RECORDNUMBER> de <RECORDS> total de registros estimados ...";
	$Translation['table backed up'] = "Tabla '<TABLE>' copiado como '<TABLENAME>'.";
	$Translation['table backup not done'] = "La tabla '<TABLE>' está vacía, por lo que no se realizó ninguna copia de seguridad.";
	$Translation['importing batch'] = 'Importación de lote <BATCH> de <BATCHNUM>: ';
	$Translation['ok'] = 'Ok';
	$Translation['records inserted or updated successfully'] = "<RECORDS> registros insertados/actualizados en segundos <SECONDS>.";
	$Translation['mission accomplished'] = "¡Misión cumplida!";
	$Translation['assign a records owner'] = "Asigne un propietario a los registros importados &gt;";
	$Translation['please wait and do not close'] = "Espere y no cierre esta página ...";
	$Translation['hide advanced options'] = "Ocultar opciones avanzadas";
	$Translation['show advanced options'] = "Mostrar opciones avanzadas";
	$Translation['import CSV to database'] = "Importar un archivo CSV a la base de datos";
	$Translation['import CSV to database page'] = "Esta página le permite cargar un archivo CSV (por ejemplo, uno generado desde MS Excel) e importarlo a una de las tablas de la base de datos. Esto hace que sea tan fácil de llenar masivamente la base de datos con datos de otras fuentes en lugar de introducir manualmente cada registro.";
	$Translation['populate table from CSV'] = "Esta es la tabla que desea rellenar con los datos del archivo CSV.";
	$Translation['CSV file'] = "Archivo CSV";
	$Translation['preview CSV data'] = "Vista previa de informacion en CSV &gt;";
	$Translation['no table name provided'] = "Ningún nombre de tabla proporcionado.";
	$Translation['can not open CSV'] = "No se puede abrir el archivo csv '<FILENAME>'.";
	$Translation['empty CSV file'] = "El archivo csv '<FILENAME>' está vacío.";		
	$Translation['no CSV file data'] = "El archivo csv '<FILENAME>' no tiene datos que leer." ;
	$Translation['field separator'] = "Separador de campos";
	$Translation['default comma'] = "El valor predeterminado es coma (,)";
	$Translation['field delimiter'] = "Delimitador de campo";
	$Translation['default double-quote'] = 'El valor predeterminado es doble cotización (")';
	$Translation['maximum characters per line'] = "Máximo de caracteres por línea";
	$Translation['trouble importing CSV'] = "Si tiene problemas para importar el archivo CSV, intente aumentar este valor.";
	$Translation['ignore lines number'] = "Número de líneas a ignorar";
	$Translation['skip lines number'] = "Cambie este valor si desea omitir un número específico de líneas en el archivo CSV.";
	$Translation['first line field names'] = "La primera línea del archivo contiene nombres de campo";
	$Translation['field names must match'] = "Los nombres de campo deben <b>exactamente</b> coincidir con los de la base de datos.";
	$Translation['update table records'] = "Actualizar registros de tabla si sus valores de clave primaria coinciden con los del archivo CSV.";
	$Translation['ignore CSV table records'] = "Si no se selecciona, los registros del archivo CSV que tengan los mismos valores de clave primaria que los de la tabla <b>se ignorarán</b>";
	$Translation['back up the table'] = "Haga una copia de seguridad de la tabla antes de importar datos CSV.";
	
	//pageViewGroups.php
	$Translation['no matching results found'] = "No se han encontrado resultados coincidentes.";
	$Translation['search groups'] = "Buscar Grupos";
	$Translation['find'] = "Buscar";
	$Translation['reset'] = "Resetear";
	$Translation['members count'] = "Cuenta de usuarios";
	$Translation['Edit group'] = "Editar grupo";
	$Translation['confirm delete group'] = "Seguro que quieres eliminar este grupo por completo?";
	$Translation['delete group'] = "Eliminar grupo";
	$Translation['view group records'] = "Ver registros de grupo";
	$Translation['view group members'] = "Ver miembros del grupo";
	$Translation['send message to group'] = "Enviar mensaje al grupo";
	$Translation['previous'] = "Atras";
	$Translation['displaying groups'] = "Mostrando grupos <GROUPNUM1> para <GROUPNUM2> de <GROUPS>";
	$Translation['next'] = "Siguiente";
	$Translation['key'] = "Key:";	
	$Translation['edit group details'] = "Editar detalles y permisos de grupo.";
	$Translation['add member to group'] = "Agregar un nuevo miembro al grupo.";
	$Translation['view data records'] = "Ver todos los registros de datos introducidos por los miembros del grupo.";
	$Translation['list group members'] = "Lista todos los miembros de un grupo.";
	$Translation['send email to all members'] = "Envíe un mensaje de correo electrónico a todos los miembros de un grupo.";
	
	//pageViewMembers.php
	$Translation['search members'] = "Buscar usuarios <SEARCH> en <HTMLSELECT>";
	$Translation['all fields'] = "Todos los campos";
	$Translation['any'] = "Cualquiera";
	$Translation['waiting approval'] = "Esperando Aprobacion";
	$Translation['active'] = "Activado";
	$Translation['Banned'] = "Bloqueado";
	$Translation['username'] = "Username";
	$Translation['sign up date'] = "Fecha de registro";
	$Translation['Status'] = "Status";
	$Translation['Edit member'] = "Editar usuario";	
	$Translation['sure delete user'] = "Seguro que quieres eliminar el usuario \'<USERNAME>\'?";
	$Translation['delete member'] = "Borrar usuario";
	$Translation["approve this member"] = "Aprobar este usuario";
	$Translation["unban this member"] = "Desbloquear este usuario";
	$Translation["ban this member"] = "Bloquear este usuario";
	$Translation["View member records"] = "Ver los registros de los usuarios";
	$Translation["send message to member"] = "Enviar mensaje al usuario
";
	$Translation['displaying members'] = "Mostrando miembros <MEMBERNUM1> a <MEMBERNUM2> de <MEMBERS>";
	$Translation['activate member'] = "Activar miembro nuevo / prohibido.";
	$Translation['ban member'] = "Bloquear (suspender) miembro.";
	$Translation['view entered member records'] = "Ver todos los registros de datos introducidos por el usuario.";
	$Translation['send email to member'] = "Enviar un mensaje de correo electrónico al miembro.";
	
	//pageViewRecords.php
	$Translation['data records'] = "Registros de Datos";
	$Translation['show records'] = "Mostrar registros de";
	$Translation['all tables'] = "Todas las Tablas";
	$Translation['sort records'] = "Ordenar registros por";
	$Translation['date created'] = "Fecha de creación";
	$Translation['date modified'] = "Fecha modificada";
	$Translation['newer first'] = "Más reciente primero";
	$Translation['older first'] = "Más antiguo primero";
	$Translation['created'] = "Creado";
	$Translation['modified'] = "Modificado";
	$Translation['data'] = "Datos";
	$Translation['change record ownership'] = "Cambiar el dueño de este registro";
	$Translation['sure delete record'] = "Está seguro de que desea eliminar este registro?";
	$Translation['delete record'] = "Eliminar este registro";
	$Translation['displaying records'] = "Visualización de registros
 <RECORDNUM1> a <RECORDNUM2> de <RECORDS>";

	/* Added in AppGini 5.51 */
	$Translation['maintenance mode admin notification'] = '¡El modo de mantenimiento está activado! Puede desactivarlo desde la página principal del administrador.';
	$Translation['maintenance mode message'] = 'Mensaje de modo de mantenimiento';
	$Translation['maintenance mode'] = 'Modo de Mantenimiento';
	$Translation['OFF'] = 'NO';
	$Translation['ON'] = 'SI';
	$Translation['enable maintenance mode?'] = '¿Está seguro de que desea habilitar el modo de mantenimiento? Sólo los usuarios admin pueden acceder al sitio en este modo!';
	$Translation['disable maintenance mode?'] = '¿Seguro que desea desactivar el modo de mantenimiento? ¡Todos los usuarios podrán acceder al sitio!';
