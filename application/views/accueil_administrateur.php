<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Accueil</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<div class="row">
	        <div class="col s4 m4">
	          <div class="card blue-grey darken-1">
	            <div class="card-content white-text">
	              <span class="card-title">Nombre de tickets résolus : <?php echo $nb_resolus; ?></span>
	            </div>
	          </div>
	        </div>
	        <div class="col s4 m4">
	          <div class="card blue-grey darken-1">
	            <div class="card-content white-text">
	              <span class="card-title">Nombre total de tickets : <?php echo $nb_tickets; ?></span>
	            </div>
	          </div>
	        </div>
	        <div class="col s4 m4">
	          <div class="card blue-grey darken-1">
	            <div class="card-content white-text">
	              <span class="card-title">Temps d'appel moyen : <?php print_r($moyenne); ?></span>
	            </div>
	          </div>
	        </div>
      	</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
