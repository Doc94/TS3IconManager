<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: index.php				/
*************************************************
*/
include './data/config.php';
include './lang/loadlang.php';
require_once("libraries/TeamSpeak3/TeamSpeak3.php"); //Libreria del FRAMEWORK TS3

	function getClientIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        else if(!empty($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        else if(!empty($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];
        else if(!empty($_SERVER['REMOTE_ADDR']))
            return $_SERVER['REMOTE_ADDR'];
        else
            return false;
    }
	$connect = "serverquery://".$USER_QUERY.":".$PASS_QUERY."@".$HOST_QUERY.":".$PORT_QUERY."/?server_port=".$SERVER_PORT."";
    $ts3 = TeamSpeak3::factory($connect);
    $ts3->execute("clientupdate", array("client_nickname" => $NICK_QUERY));
    $FLAG = false;
    foreach ($ts3->clientList(array('client_type' => '0', 'connection_client_ip' => getClientIp())) as $client) {
        $clientuid = $client->client_unique_identifier;
        $FLAG = true;
        break;
    }
    if (!$FLAG){
        echo "<p><b>".$lang['f_connectts'].".</b></p><br/>";
		header("refresh: 10; url = ./"); 
		die;	
    }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $NAME_TITLE ?> | TS3 Iconos </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>

<body>

<br/><br/><br/>
<div class="container">
	<div class="row">
		<center>
		<div class="panel panel-primary" style="width: 300px;">
			<div class="panel-heading">
				<h3 class="panel-title" style="height: 16px;"><?php echo $lang['i_title'];?></h3>
			</div>
			<div class="panel-body" style="width: 300px;">
				<form role="form" name="formulario"method="POST"action="procesar.php">
					<?php echo $lang['i_inputuid'];?><br/><br/>
					<div class="form-group">
					<label for="uniid">UUID:</label>
					<input type="text" id="uniid" name="uniid" class="form-control" value="<?php echo $clientuid;?>" readonly>
					</div>
					<button type="submit" class="btn btn-default"><?php echo $lang['i_buttonsend'];?></button>
					<br/>

				</form>
			</div>
		</div>
		</center>
	</div>
</div>

</body>

<footer>
<center>
<p class="text-capitalize">Script hecho por <a href="http://twitter.com/MrDoc94">Doc</a> - <?php echo $SCRIPT_VER ?> | Mediante la <a href="https://docs.planetteamspeak.com/ts3/php/framework/">TS3API</a> | SourceCode en <a href="https://github.com/Doc94/TS3IconManager">GitHub</a></p></center>
</footer>
</html>
