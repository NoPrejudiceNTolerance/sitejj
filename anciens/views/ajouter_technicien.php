<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Ajouter un technicien</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<div class="container white technicien z-depth-4">
			<div class="row">
					<?php echo form_open('','class="col s12"'); ?>
					<h1>Ajouter un technicien</h1>
			    	<div class="row">
				        <div class="input-field col s12">
					        <input id="nom" type="text" class="validate" name="nom" length="20">
					        <label for="nom">Nom* :</label>
				        </div>
				        <?php echo form_error('nom'); ?>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s12">
					        <input id="prenom" type="text" class="validate" name="prenom" length="20">
					        <label for="prenom">Prénom* :</label>
				        </div>
				        <?php echo form_error('prenom'); ?>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s12">
					        <input id="login" type="text" class="validate" name="login" length="50">
					        <label for="login">Login* :</label>
				        </div>
				        <?php echo form_error('login'); ?>
			      	</div>
			      	<div class="row">
				        <div class="input-field col s12">
					        <input id="password" type="text" class="validate" name="password" length="50">
					        <label for="password">Mot de passe* :</label>
				        </div>
				        <?php echo form_error('password'); ?>
			      	</div>
			      	<div class="row">
			      		<div class="input-field col s12">
			      			<p><i>(*) Champs obligatoires</i></p>
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="col s6">
					        <a class="waves-effect waves-light btn couleurfonce" href="http://savu.axelbrouland.fr/index.php/savu/gestion_techniciens">Annuler</a>
				        </div>
				        <div class="col s6">
					        <button class="btn waves-effect waves-light couleurfonce"  type="submit" name="action">Ajouter</a>
								<i class="material-icons left">send</i>
							</button>
				        </div>
			      	</div>
					</form>
			</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
