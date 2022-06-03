var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// reglamento table
reglamento_addTip=["",spacer+"This option allows all members of the group to add records to the 'Lineamientos del Bushido' table. A member who adds a record to the table becomes the 'owner' of that record."];

reglamento_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Lineamientos del Bushido' table."];
reglamento_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Lineamientos del Bushido' table."];
reglamento_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Lineamientos del Bushido' table."];
reglamento_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Lineamientos del Bushido' table."];

reglamento_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Lineamientos del Bushido' table."];
reglamento_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Lineamientos del Bushido' table."];
reglamento_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Lineamientos del Bushido' table."];
reglamento_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Lineamientos del Bushido' table, regardless of their owner."];

reglamento_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Lineamientos del Bushido' table."];
reglamento_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Lineamientos del Bushido' table."];
reglamento_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Lineamientos del Bushido' table."];
reglamento_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Lineamientos del Bushido' table."];

// puntos table
puntos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Mi Puntaje' table. A member who adds a record to the table becomes the 'owner' of that record."];

puntos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Mi Puntaje' table."];
puntos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Mi Puntaje' table."];
puntos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Mi Puntaje' table."];
puntos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Mi Puntaje' table."];

puntos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Mi Puntaje' table."];
puntos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Mi Puntaje' table."];
puntos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Mi Puntaje' table."];
puntos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Mi Puntaje' table, regardless of their owner."];

puntos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Mi Puntaje' table."];
puntos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Mi Puntaje' table."];
puntos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Mi Puntaje' table."];
puntos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Mi Puntaje' table."];

// impactos table
impactos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Impactos' table. A member who adds a record to the table becomes the 'owner' of that record."];

impactos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Impactos' table."];
impactos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Impactos' table."];
impactos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Impactos' table."];
impactos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Impactos' table."];

impactos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Impactos' table."];
impactos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Impactos' table."];
impactos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Impactos' table."];
impactos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Impactos' table, regardless of their owner."];

impactos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Impactos' table."];
impactos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Impactos' table."];
impactos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Impactos' table."];
impactos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Impactos' table."];

// persona table
persona_addTip=["",spacer+"This option allows all members of the group to add records to the 'Persona' table. A member who adds a record to the table becomes the 'owner' of that record."];

persona_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Persona' table."];
persona_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Persona' table."];
persona_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Persona' table."];
persona_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Persona' table."];

persona_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Persona' table."];
persona_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Persona' table."];
persona_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Persona' table."];
persona_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Persona' table, regardless of their owner."];

persona_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Persona' table."];
persona_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Persona' table."];
persona_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Persona' table."];
persona_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Persona' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
