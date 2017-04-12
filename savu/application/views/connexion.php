<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Connexion</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<div class="container white technicien z-depth-2">
			<div class="row">
				<?php echo form_open('','class="col s12"'); ?>
					<h1>Connexion</h1>
			    	<div class="row">
				        <div class="input-field col s12">
					        <input id="login" type="text" class="validate" name="login" length="50" value="<?php echo set_value('password');?>">
					        <label for="login">Login</label>
					        <?php echo form_error('login'); ?>
				        </div>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s12">
					        <input id="password" type="password" class="validate" name="password" value="<?php echo set_value('password');?>">
					        <label for="password">Password</label>
					        <?php echo form_error('password'); ?>
				        </div>
			      	</div>
			      	<button class="btn waves-effect waves-light couleurfonce"  type="submit" name="action">Se connecter</a>
						<i class="material-icons right">send</i>
					</button>
				</form>
		  	</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
