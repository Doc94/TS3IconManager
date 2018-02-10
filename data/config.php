<?php
/**
 * @author Pedro Arenas
 * @author Franco Sanllehi <franco@fsanllehi.me>
 *
 * @license MIT
 */

$script_version = "V1.5";

/* Configuracion de conexion query hacia TS3 */
$HOST_QUERY = "localhost"; //HOST:QUERY_PORT Que usa tu servidor de ts3
$PORT_QUERY = "10011"; //Puerto de query por default es 10011
$USER_QUERY = "serveradmin"; //Usuario de conexion a query
$PASS_QUERY = "hAsdzIXD"; //Clave generada para a conexion query
$SERVER_PORT = "9987"; //Puerto del servidor ts3

/* Configuracion de variables Front-end */
$NAME_TITLE = 'Manager TS3'; //Titulo principal de la web
$IDIOMA = "ES"; // (Options: en, es) Idioma de ejecucion
$SID_GROUP = array(75); //SORT_ID del grupo que sera listado Example array(1,2,3,4,5)
$NICK_QUERY = "AdminSystem"; //Nickname de la conexion query
$MAX_ICONS = 8; //Maximo de iconos seleccionar
$DEBUG = True; //Activa los mensajes de error detallados
