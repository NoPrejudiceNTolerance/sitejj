<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Accueil</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      	<style>
      		#test{text-align: center;
      			padding:250px 0;
      		}
			 
        </style>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<!-- Affichage du détail du ticket sélectionné préalablement -->
		  <div class="row">
		  	 <div class="col s3"></div>
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Détail du ticket n°<?php echo ($ticket[0]['idticket']); ?></span>
              <div class="card-action">
			  <strong><label>Statut :</label></strong><p>&nbsp;&nbsp;<?php echo ($ticket[0]['statut']); ?></p>
			  <strong><label>Produit :</label></strong><p><?php echo ($ticket[0]['type']); ?></p>
			  <strong><label>Numéro de série :</label></strong><p>&nbsp;&nbsp;<?php echo ($ticket[0]['produit']); ?></p>
			  <strong><label>Adresse email du client :</label></strong><p>&nbsp;&nbsp;<?php echo ($client[0]['email']); ?><p>
			  <strong><label>Prénom du client :</label></strong><p>&nbsp;&nbsp;<?php echo ($client[0]['prenom']); ?></p>
			  <strong><label>Nom du client :</label></strong><p>&nbsp;&nbsp;<?php echo ($client[0]['nom']); ?></p>
			  <strong><label>Problème :</label></strong><p>&nbsp;&nbsp;<?php echo ($ticket[0]['probleme']); ?></p>
            </div>
            </div>
          </div>
        </div>
      </div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
