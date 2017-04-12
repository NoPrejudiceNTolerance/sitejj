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
      		
      		#lol{
      			color:#60C6AD;
      		}
        </style>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		 <div class="row">
	  			<div class="row col s6 m6">
			    	<div class="">
			        	<div class="card blue-grey darken-1">
			                <div class="card-content white-text">
			              		<span class="card-title">Informations</span>
			            	</div>
			            	<div class="card-action">
			              		<a class="collection-item"><span class="badge" id="lol"><?php echo $nb_tickets; ?></span>Nombre de tickets traités</a>
			        		</div>
			        		<div class="card-action">
			              		<a class="waves-effect waves-light btn couleurclaire " href="http://savu.axelbrouland.fr/index.php/savu/changer_statut">Changer statut</a>
			                	<a class="collection-item col s8"><?php echo $statut; ?></a>
			                </div>
			                <div class="card-action">
			              		<a class="waves-effect waves-light btn couleurclaire " href="http://savu.axelbrouland.fr/index.php/savu/charger_dernier_ticket">Ouvrir ticket</a>
			                	<a class="collection-item col s8">Ouvrir le ticket du client</a>
			                </div>
				         </div>
			    	</div>
			    </div>
			    
			    <div class="row col s6 m6">
			    	<div class="">
			        	<div class="card blue-grey darken-1">
			                <div class="card-content white-text">
			              		<span class="card-title">Moyennes</span>
			            	</div>
			            	<div class="card-action">
			              		<a class="collection-item"><span class="badge" id="lol"><?php echo $moyenne_amabilite; ?></span>Moyenne amabilité</a>
			        		</div>
			        		<div class="card-action">
			              		<a class="collection-item"><span class="badge" id="lol"><?php echo $moyenne_rapidite; ?></span>Moyenne rapidité</a>
			        		</div>
			        		<div class="card-action">
			              		<a class="collection-item"><span class="badge" id="lol"><?php echo $moyenne_didactique; ?></span>Moyenne didactique</a>
			        		</div>
				         </div>
			    	</div>
			    </div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
