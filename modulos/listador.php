<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: iconizador.php			/
/				Modulo: Lista los grupos/icons	/
*************************************************
*/
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3
        session_start();
        $_SESSION['client_uid'] = $_POST['uniid'];
        $client_uid = $_POST['uniid'];
		
       
    try {
        
        $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
        $ts3_VirtualServer = TeamSpeak3::factory($connect);
        $ts3_VirtualServer->execute("clientupdate", array("client_nickname" => $NICK_QUERY));
        $client = $ts3_VirtualServer->clientGetByUid($client_uid);
        $userlist = $ts3_VirtualServer->clientList();      
        echo "ID obtenida: ".$client_uid."<br>";
        $proceder = True;
        $conectado = False;
		$_SESSION['client_db'] = $client["client_database_id"];

        echo "Ultimo nombre usado: ".$client["client_nickname"]."<br>";
        echo "Procesando el sistema <br>";
        
            
        if($proceder == True) {
            echo "<form name='formulario' method='POST' action='iconizar.php'>";
            
            $iconosm = 0;
            $grupos_out = array();
            $grupos_in = array();
            
            $server_groups = $ts3_VirtualServer->serverGroupList();
            $servergroups = array();
 
            # En vez de iterar por todos los grupos intenten 
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if($group["sortid"] == $SID_GROUP) {
                    $servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type);
                }
            } 
			$_SESSION['grupos'] = $servergroups;
        
            foreach($servergroups as $group) {      
                
                $miembros = $ts3_VirtualServer->serverGroupClientList($group["id"]);
                $estaengrupo = False;
                foreach($miembros as $m) {
                    if($m["client_unique_identifier"] == $client_uid) { 
                        $estaengrupo = True; 
                    }                                   
                }
                
                if($estaengrupo) {
                    $iconosm = $iconosm + 1;
                    echo '<label><li><img src="./iconos/'.$group['id']. '.png" alt="" />  ';
                    echo '<input type=checkbox name=grupos['.$group["id"].'] id="'.$group["id"].'" value="'. $group["id"] .'"class="icono" checked >'.$group["name"].'</label><br/>';
                } else {
                    echo '<label><li><img src="./iconos/'. $group['id'] . '.png" alt="" />  ';
                    echo '<input type=checkbox name=grupos['.$group["id"].'] id="'. $group["id"] .'" value="'. $group["id"] .'" class="icono"> '.$group["name"].'</label><br/>';
                }           
            }
			echo "<br/><button type='submit' class='btn btn-default'>Guardar</button>";
            //echo "<input type=submit value='Guardar'><br></FORM>";
        } else {
            if($conectado == False) {
            echo "<br><b>ERROR:</b> Debes estar conectado al ts para seguir<br>";
            }
        }
        
    } catch(Exception $e) {
		echo "ERROR: ";
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
        } else if($e->getCode() == 513) { //Codigo de error cuando ya hay una conexion del nombre
                    echo "Alguien esta usando esta UUID en este momento. Intente mas tarde.";
        } else if($e->getCode() == 2568) { //Codigo de error cuando ya hay una conexion del nombre
                    echo "La conexion query no tiene permisos de realizar una de las acciones del script.";
        }
        
    }
        
    //$servergroups[] = array('name' => (string)$group, 'id' => $group->sgid, 'type' => $group->type); 
?>
