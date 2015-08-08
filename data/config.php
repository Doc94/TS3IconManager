<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: config.php				/
*************************************************
*/
 
/* Configuracion de conexion query hacia TS3 */

$HOST_QUERY = "131.221.33.40"; //HOST:QUERY_PORT Que usa tu servidor de ts3
$PORT_QUERY = "10011"; //Puerto de query por default es 10011
$USER_QUERY = "USERQUERY"; //Usuario de conexion a query
$PASS_QUERY = "CLAVEQUERY"; //Clave generada para a conexion query
$SERVER_PORT = "9977"; //Puerto del servidor ts3


/* Configuracion de variables de uso */

$NAME_TITLE = 'Manager TS3'; //Titulo principal de la web

$IDIOMA = "ES"; // (Options: en, es) Idioma de ejecucion 

$SID_GROUP = array(71,71); //SORT_ID del grupo que sera listado Example array(1,2,3,4,5)

$NICK_QUERY = "AdminSystem"; //Nickname de la conexion query

$MAX_ICONS = 8; //Maximo de iconos seleccionar

$DEBUG = True; //Activa los mensajes de error detallados
