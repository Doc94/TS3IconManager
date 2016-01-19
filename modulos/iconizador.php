<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: iconizador.php			/
/				Modulo: Asignacion de iconos	/
*************************************************
*/
include './lang/loadlang.php';
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3
        session_start();
        $client_uid = $_SESSION['client_uid'];
		$grupos = $_SESSION['grupos'];
		$client_db = $_SESSION['client_db'];
		$codigo = $_SESSION['codigo'];
		$i_code = $_POST["i_code"];
		$numicons = $_SESSION['numiconos'];
       
    try {
        
        $connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
        $ts3_VirtualServer = TeamSpeak3::factory($connect);
        $ts3_VirtualServer->execute("clientupdate", array("client_nickname" => $NICK_QUERY));
        $client = $ts3_VirtualServer->clientGetByUid($client_uid);     
        echo $lang['l_idt'].": ".$client_uid."<br>";
        
		echo $lang['l_lastname'].": ".$client["client_nickname"]."<br>";
        echo $lang['load']."<br/><br/>";
		
        	if(!isset($numicons) || $numicons > $MAX_ICONS) {
				echo "<p><b>".$numicons.".</b></p><br/>";
        		echo "<p><b>".$lang['f_msgovermaxicons'].".</b></p><br/>";
			header("refresh: 10; url = ./"); 
			die;	
        	}
		if(empty($_POST["grupos"])) {
			echo "<p><b>".$lang['f_msgemptysave'].".</b></p><br/>";
			header("refresh: 10; url = ./"); 
			die;
		} else {
			$n_grupos = $_POST["grupos"];
		}
		if($i_code != $codigo) {
			echo "<p>".$lang['f_msgfailcode']."!</p><br/>";
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
			echo "<br><b>".$lang['succes']."</b><br>";
		} catch(Exception $e) {
			if($DEBUG == True) {
				echo "[DEBUG] ".$lang['f_derrortitle']." <br>";
				echo "[DEBUG] ".$lang['f_dmsg'].": ".$e->getMessage()."<br>";
				echo "[DEBUG] ".$lang['f_dcode']." ".$e->getCode()."<br>";
			}
		}
            
        
        
    } catch(Exception $e) {
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
?>
