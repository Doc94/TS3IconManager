# TS3IconManager
Management ranges ts by UID
This little script uses Bootstrap and TS3PHP Framework, this script allows to assign ranges (based on sort_id ranges in ts) based on a UID

# Functions

-Assign Icons using UID

-List Of icons according to the SORT_ID

-Confirmation Via code sent by POKE in ts3

-Assigning Clean and saving resources of the connection query

-Record Changes (still not ...)

-System Languages

# Installation
You just have to edit the file (data / config.php) to use the script without any problem.

# Sync icons
This script is in the folder "icons" a PHP file which should run periodically according to editing one or another range as to save resources and to avoid a possible "Banned From Query" icons are not automatically downloaded unless run every so often the geticonos.php file

# Changelog
[V 1.3]

-Fixed File (./icons/geticonos.php) which had an error reading configuration file.

-implemented Language system currently available in Spanish and English (To add a new language using ./lang/es.php basis for creating new languages).

[V 1.2]

-Fixed One warning in ./modulos/iconizar.php which by no change was trying to take a null variable.

-Added Confirmation system via code sent by poke in ts.

-Correcciones Of code.

# Connection permissions for the query
Below the permissions that you must have the account used in the query connection is ready.

-b_virtualserver_client_list || Para listar usuarios del servidor

-b_virtualserver_servergroup_list || Listar los grupos del servidor

-b_virtualserver_servergroup_client_list || Listar los miembros de dicho grupo

-i_group_member_add_power || Poder para añadir a un miembro

-i_group_member_remove_power || Poder para remover a un miembro

-i_client_poke_power || Poder para enviar poke

