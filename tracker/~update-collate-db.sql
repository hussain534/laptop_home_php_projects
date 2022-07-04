#Find all collation for tables inside ayaan_perftracker db
SELECT * 
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA="ayaan_perftracker"
AND TABLE_TYPE="BASE TABLE";

#Get alter scripts to update collation for all tables inside ayaan_perftracker db
SELECT CONCAT("ALTER TABLE ", TABLE_SCHEMA, '.', TABLE_NAME," COLLATE latin1_spanish_ci;") AS    ExecuteTheString
FROM INFORMATION_SCHEMA.TABLES
WHERE TABLE_SCHEMA="ayaan_perftracker"
AND TABLE_TYPE="BASE TABLE";

#alter scripts to update collation for all tables inside ayaan_perftracker db
ALTER TABLE ayaan_perftracker.c_cliente COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.c_login COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.c_menu COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.c_paralelo COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.c_perfil COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.c_permisos COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.datos COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.datos_dtl COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.login_perfil COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.mappingtipoevaluacionsecion COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.planevaluacion COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.preguntas COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.respuestaevaluacion COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.seccion COLLATE latin1_spanish_ci;
ALTER TABLE ayaan_perftracker.tipoevaluacion COLLATE latin1_spanish_ci;