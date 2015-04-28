<?php
/*
*************************************************
/				Autor: Pedro Arenas (Doc)		/
/				Archivo: config.php				/
*************************************************
*/
include './data/config.php'; //Importamos la configuracion
include './lang/loadlang.php';
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
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="noty/js/packaged/jquery.noty.packaged.min.js"></script>

</head>

<body>
	<br/><br/><br/>
	<div class="container">
		<div class="row">
			<center>
			<div class="panel panel-primary" style="width: 600px;">
				<div class="panel-heading">
					<h3 class="panel-title" style="height: 16px;"><?php echo $lang['i_title'];?></h3>
				</div>
				<div class="panel-body" style="width: 550px;" align=left>
					<?php include './modulos/listador.php'; //Importamos el codigo a usar ?>
				</div>
			</div>
			</center>
		</div>
	</div>
    

<script>
var maxicon = "<?php echo $MAX_ICONS; ?>" ;
var icons = "<?php echo $iconosm; ?>" ;
var msgerror = "<?php echo $lang['f_maxicons']; ?>" ;

$(document).ready(function () {
    //set initial state.

    $('input[type=checkbox]').change(function () {
		var id = $(this).prop('id');
        if ($(this).is(":checked")) {
            if (icons == maxicon) {
                var n = noty({text: msgerror, type: 'error', layout: 'topCenter'});
				//alert("Maximo");
                $(this).prop('checked', false);

            } else {
                icons++;
				<?php 
					//$grupos_in[] = array('id' => echo "id";);
				?>
            }

        } else {
            icons--;
        }
        //$('.txt').val(icons);
    });

});
</script>

</body>

<footer>
<center>
<p class="text-capitalize">Script hecho por <a href="http://twitter.com/MrDoc94">Doc</a> | Mediante la <a href="https://docs.planetteamspeak.com/ts3/php/framework/">TS3API</a> | SourceCode en <a href="https://github.com/Doc94/TS3IconManager">GitHub</a></p>
</center>
</footer>
</html>
