<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: iconizador.php			/
/				Modulo: Asignacion de iconos	/
*************************************************
*/
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3
        session_start();
        $client_uid = $_SESSION['client_uid'];
		$grupos = $_SESSION['grupos'];
		$client_db = $_SESSION['client_db'];
		$codigo = $_SESSION['codigo'];
		$i_code = $_POST["i_code"];
       
    try {
        
        $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
        $ts3_VirtualServer = TeamSpeak3::factory($connect);
        $ts3_VirtualServer->execute("clientupdate", array("client_nickname" => $NICK_QUERY));
        $client = $ts3_VirtualServer->clientGetByUid($client_uid);     
        echo "ID obtenida: ".$client_uid."<br>";
        
		echo "Ultimo nombre usado: ".$client["client_nickname"]."<br>";
        echo "Procesando el sistema <br/><br/>";
		
        
		if(empty($_POST["grupos"])) {
			echo "<p><b>No hay cambios que hacer.</b></p><br/>";
			header("refresh: 10; url = ./"); 
			die;
		} else {
			$n_grupos = $_POST["grupos"];
		}
		if($i_code != $codigo) {
			echo "<p>El codigo ingresado no es correcto!</p><br/>";
			header("refresh: 10; url = ./"); 
			die;
		}
		try {
			foreach($grupos as $group) {			
				$needle = $group['id'];
				$miembros = $ts3_VirtualServer->serverGroupClientList($needle);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $client_uid) { 
                        $estaengrupo = True; 
                    }                                   
                }
				if(in_array($needle,$n_grupos)) {
					if($estaengrupo == False) {
						$ts3_VirtualServer->serverGroupClientAdd($group["id"],$client_db);
					}
				} else {
					if($estaengrupo == True) {
						$ts3_VirtualServer->serverGroupClientDel($group["id"],$client_db);
					}
				}
			}
			header("refresh: 10; url = ./"); 
			echo "<br><b>Iconos Asignados correctamente</b><br>";
		} catch(Exception $e) {
			if($DEBUG == True) {
				echo "[DEBUG] Ha ocurrido un error inesperado <br>";
				echo "[DEBUG] Mensaje de error DEBUG: ".$e->getMessage()."<br>";
				echo "[DEBUG] El codigo de error fue ".$e->getCode()."<br>";
			}
		}
            
        
        
    } catch(Exception $e) {
        if($DEBUG == True) {
            echo "[DEBUG] Ha ocurrido un error inesperado <br>";
            echo "[DEBUG] Mensaje de error DEBUG: ".$e->getMessage()."<br>";
            echo "[DEBUG] El codigo de error fue ".$e->getCode()."<br>";
        }
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