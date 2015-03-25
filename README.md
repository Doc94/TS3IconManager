# TS3IconManager
Manejo de rangos de ts mediande UID
Este pequeño script usa Bootstrap y el Framework de TS3PHP, este script permite poder asignarse rangos (basado en el sort_id de los rangos en ts) en base a una UID 

# Funciones

-Asignar iconos usando UID

-Listado de iconos segun el SORT_ID

-Confirmacion via codigo enviado por POKE en ts3

-Asignacion limpia y ahorrando recursos de la conexion query

-Registro de los cambios realizados (Aun No...)

# Instalacion
Solo debes editar el archivo (data/config.php) para poder usar el script sin ningun problema.

# Sync de iconos
Este script tiene en la carpeta de "iconos" un archivo PHP el cual debes ejecutar periodicamente segun edites uno u otro rango ya que para ahorrar recursos y para evitar un posible "Banned From Query" los iconos no se descargan automaticamente a menos que se ejecute cada cierto tiempo el archivo geticonos.php

# Changelog
[V 1.2]
-Areglado un warning en ./modulos/iconizar.php el cual al no haber cambios intentaba tomar una variable null.

-Añadido sistema de confirmacion via codigo enviado por poke en ts.

-Correcciones ligeras de codigo.

# Permisos de la conexion query
A continuacion se lista los permisos que debe tener la cuenta usada en la conexion query.

-b_virtualserver_client_list || Para listar usuarios del servidor

-b_virtualserver_servergroup_list || Listar los grupos del servidor

-b_virtualserver_servergroup_client_list || Listar los miembros de dicho grupo

-i_group_member_add_power || Poder para añadir a un miembro

-i_group_member_remove_power || Poder para remover a un miembro

-i_client_poke_power || Poder para enviar poke

