<?php
/**
 * @author Pedro Arenas
 * @author Franco Sanllehi <franco@fsanllehi.me>
 *
 * @license MIT
 */

include './data/config.php';
include './lang/loadlang.php';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
	    <title><?= $NAME_TITLE ?> | TS3 Icons </title>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
			<link rel="stylesheet" href="http://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/sticky-footer-navbar.css">
	</head>
	<body>
		</br></br></br></br></br></br></br></br></br>
    <div class="container">
	    <div class="jumbotron">
				<div class="container text-center">
					<h3 class="panel-title"><?= $lang['i_title'];?></h3>
					<?= $lang['i_inputuid'];?><br/><br/>
					<form role="form" name="formulario" method="POST" action="procesar.php">
					  <div class="form-group">
							<div class="form-inline">
								<center style="width:100%;">
									<input type="text" class="form-control" id="uniid" name="uniid" placeholder="TeamSpeakUID" style="width: 26%;">
								</center>
							</div>
					  </div>
					  <button type="submit" class="btn btn-primary"><?= $lang['i_buttonsend'];?></button>
					</form>
				</div>

              <!--<div class="panel">
                  <div class="panel-heading">
                    <h3 class="panel-title"><?= $lang['i_title'];?></h3>
                  </div>
                  <div class="panel-body">
                      <form role="form" name="formulario" method="POST" action="procesar.php">
                          <?php echo $lang['i_inputuid'];?><br/><br/>
                          <div class="form-group">
                              <label for="uniid">UniID:</label>
                              <input type="text" id="uniid" name="uniid" class="form-control" placeholder="UID">
                          </div>
                          <button type="submit" class="btn btn-default"><?php echo $lang['i_buttonsend'];?></button>
                          <br/>
                      </form>
                  </div>
              </div>-->
          </div>
	    </div>
			<footer class="footer">
	      <div class="container text-center">
	        <span class="text-muted">Created by <a href="https://twitter.com/MrDoc94">Doc</a> & <a href="https://github.com/DmACKGL">Franco Sanllehi</a> | <?= $script_version ?> | Code: <a href="https://github.com/Doc94/TS3IconManager"><i class="fab fa-github"></i></a></span>
	      </div>
	    </footer>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
			<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
	</body>
</html>
