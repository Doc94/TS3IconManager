# TS3IconManager
Manejo de rangos de ts mediande UID
Este pequeño script usa Bootstrap y el Framework de TS3PHP, este script permite poder asignarse rangos (basado en el sort_id de los rangos en ts) en base a una UID 

# Instalacion
Solo debes editar el archivo (data/config.php) para poder usar el script sin ningun problema.

# Sync de iconos
Este script tiene en la carpeta de "iconos" un archivo PHP el cual debes ejecutar periodicamente segun edites uno u otro rango ya que para ahorrar recursos y para evitar un posible "Banned From Query" los iconos no se descargan automaticamente a menos que se ejecute cada cierto tiempo el archivo geticonos.php

# Permisos de la conexion query
A continuacion se lista los permisos que debe tener la cuenta usada en la conexion query
-b_virtualserver_client_list || Para listar usuarios del servidor
-b_virtualserver_servergroup_list || Listar los grupos del servidor
-b_virtualserver_servergroup_client_list || Listar los miembros de dicho grupo
-i_group_member_add_power || Poder para añadir a un miembro
-i_group_member_remove_power || Poder para remover a un miembro

