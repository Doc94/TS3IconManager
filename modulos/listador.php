<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: listador.php			/
/				Modulo: Lista los grupos/iconos	/
*************************************************
*/
include './lang/loadlang.php';
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3
        session_start();
        $_SESSION['client_uid'] = $_POST['uniid'];
        $client_uid = $_POST['uniid'];
		
       
    try {
        
        $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
        $ts3_VirtualServer = TeamSpeak3::factory($connect);
        $ts3_VirtualServer->selfUpdate(array('client_nickname'=>$NICK_QUERY));
        $client = $ts3_VirtualServer->clientGetByUid($client_uid);   
        echo $lang['l_idt'].": ".$client_uid."<br>";
        $proceder = True;
        $conectado = False;
		$_SESSION['client_db'] = $client["client_database_id"];
		
		

        if($client["client_nickname"] ==  $NICK_QUERY) {
            echo $lang['l_lastname'].": NO DISPONIBLE<br>";
            $proceder = False;
        } else {
            echo $lang['l_lastname'].": ".$client["client_nickname"]."<br>";
            $conectado = True;
        }
        echo $lang['load']."<br/><br/>";
        
		
		
		
            
        if($proceder == True) {
            echo "<form name='formulario' method='POST' action='iconizar.php'>";
            
            $iconosm = 0;
            
            $server_groups = $ts3_VirtualServer->serverGroupList();
            $servergroups = array();
 
            # En vez de iterar por todos los grupos intenten 
            foreach($server_groups as $group) {
                if($group->type != 1) { continue; }
                if(in_array($group["sortid"], $SID_GROUP)) {
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
                    echo '<li><img src="./iconos/icons/'.$group['id']. '.png" alt="" />  ';
                    echo '<label><input type=checkbox name=grupos['.$group["id"].'] id="'.$group["id"].'" value="'. $group["id"] .'"class="icono" checked >'.$group["name"].'</label><br>';
                } else {
                    echo '<li><img src="./iconos/icons/'. $group['id'] . '.png" alt="" />  ';
                    echo '<label><input type=checkbox name=grupos['.$group["id"].'] id="'. $group["id"] .'" value="'. $group["id"] .'" class="icono"> '.$group["name"].'</label><br>';
                }
                //$_SESSION['numiconos'] = $iconosm;
            }
			$codigo = RandomString();
			$_SESSION['codigo'] = $codigo;
			$mensaje = $lang['l_checkmsg'].": ".$codigo." ";
			$client->poke($mensaje);
			
			echo "<br/><p>".$lang['l_checkalert']."</p>";
			echo "<input type=text name='i_code' placeholder='Codigo'><br/>";
			echo "<br/><button type='submit' class='btn btn-default'>".$lang['l_save']."</button>";
            //echo "<input type=submit value='Guardar'><br></FORM>";
        } else {
            if($conectado == False) {
				header("refresh: 10; url = ./"); 
				echo "<br><b>ERROR:</b> ".$lang['f_connect']."<br>";
            }
        }
        
    } catch(Exception $e) {
		echo "ERROR: ";
        if($DEBUG == True) {
            echo "[DEBUG] ".$lang['f_derrortitle']." <br>";
            echo "[DEBUG] ".$lang['f_dmsg'].": ".$e->getMessage()."<br>";
            echo "[DEBUG] ".$lang['f_dcode']." ".$e->getCode()."<br>";
        }
        if($e->getCode() == 0) {
            echo $lang['f_unk'];
        } else if($e->getCode() == 10060) { //Codigo de error de error en la conexion
                    echo $lang['f_connectts'];
        } else if($e->getCode() == 512) { //Codigo de error cuando la UUID no es valida
                    echo $lang['f_uuid'];
        } else if($e->getCode() == 520) { //Codigo de error cuando login o pass estan mal
                    echo $lang['f_querydata'];
        } else if($e->getCode() == 3329) { //Codigo de error cuando la conexion fue baneada por el tsquery
                    echo $lang['f_banned'];
        } else if($e->getCode() == 513) { //Codigo de error cuando ya hay una conexion del nombre
                    echo $lang['f_twoconnect'];
        } else if($e->getCode() == 2568) { //Codigo de error cuando ya hay una conexion del nombre
                    echo $lang['f_perms'];
        }
        
    }
        
    function RandomString() {
		$an = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ%$#";
		$su = strlen($an) - 1;
    return substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1) .
            substr($an, rand(0, $su), 1);
	}
?>
