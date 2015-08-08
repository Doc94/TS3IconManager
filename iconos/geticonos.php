<?php
 
  try {
	  
	require_once("../libraries/TeamSpeak3/TeamSpeak3.php");
	include '../data/config.php';  
	echo "Conectando al servidor TeamSpeak</br>";
    $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
	$ts3_VirtualServer = TeamSpeak3::factory($connect);
    // Conseguimos array con los grupos
    $server_groups = $ts3_VirtualServer->serverGroupList();
	$servergroups = array();
    foreach($server_groups as $group) {
        if($group->type != 1) { continue; }
        if(in_array($group["sortid"], $SID_GROUP)) {
        $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type, 'icon' => $group->iconDownload() );
        }
    }  
	echo "Iniciando Descarga de iconos...</br>";
    // Iteramos por grupo para guardar a archivo
    foreach($servergroups as $group) {
        // ya estaba descargada la wea xD
        file_put_contents("./icons/" . $group['id'] . ".png", $group['icon']);
        echo "Archivo iconos/icons/" . $group['id'] . ".png" . " Creado para el grupo " . $group['name'] . "<br>";
       
    }
 
  } catch(Exception $e) {
		if($DEBUG == True) {
			//print_r($e);
			echo "[DEBUG] Ha ocurrido un error inesperado <br>";
			echo "[DEBUG] Mensaje de error DEBUG: ".$e->getMessage()."<br>";
			echo "[DEBUG] El codigo de error fue ".$e->getCode()."<br>";
		}
		echo "ERROR: ".$e->getMessage();
		if($e->getCode() == 0) {
			echo "Error desconocido. Metodo invalido";
		} else if($e->getCode() == 10060) { //Codigo de error de error en la conexion
                    echo "No se pudo conectar con el servidor de teamspeak 3";
        } else if($e->getCode() == 512) { //Codigo de error cuando la UUID no es valida
                    echo "La UUID ingresada no es valida o no esta actualmente conectada al ts3";
		} else if($e->getCode() == 520) { //Codigo de error cuando login o pass estan mal
                    echo "Los datos de acceso query no son correctos";
		} else if($e->getCode() == 3329) { //Codigo de error cuando la conexion fue baneada por el tsquery
                    echo "La conexion fue baneada por query. Intenta mas tarde";
		}
		
	}
?>