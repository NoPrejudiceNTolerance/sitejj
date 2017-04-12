<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Accueil</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/last.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      	<style>
      		#test{text-align: center;
      			padding:250px 0;
      		}
			 
        </style>
	</head>
	<body class="grey lighten-2" onload = "chronoStart(), fonction_update()">
		<?php include($menu); ?>
			<h2>Ticket en cours</h2>
	 <div class="row">
        <div class="col s6 m4 ">
        	<!-- Partie qui permet d'afficher un chrono qui se lance à l'ouverture de la page-->
        <span id="chronotime">0:00:00:00</span>

    	<!-- Affichage du tableau contenant la liste des tickets du même client -->
		<ul class="collection with-header">
        <li class="collection-header blue-grey darken-1 white-text"><h4>Tickets précédents</h4></li>
		<?php foreach($liste_tickets as $ligne): 
			if($ligne['idticket'] != $idticket){?>
			<li class="collection-item"><div><?php echo $ligne['idticket']; ?><a onclick="window.open('http://savu.axelbrouland.fr/index.php/savu/detail_ticket/<?php echo $ligne['idticket']; ?>'); return false;" class="secondary-content"><i class="material-icons">send</i></a></div></li>
		<?php }endforeach; ?>
	 </ul>
		</div>
		
		<!-- Affichage du ticket en cours avec tous les éléments nécessaires -->
	<?php echo validation_errors(); ?>
	<?php echo form_open('savu/gestion_ticket') ?>
        <div class="col s6 m8">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Ticket numéro :<?php echo $idticket; ?></span>

			  </br></br>
	  <h5>Client : <?php echo $monticket[0]['client']; ?><h5>

	  </div>
	  	<div class="row">
	<div class="col s3">
   <label>Statut</label>
  <select name="statut" class="browser-default">
	<?php if(strcmp($monticket[0]['statut'],"en attente")==0){ ?>
		<option value="en cours">En cours</option>
		<option selected value="en attente">En attente</option>
		<option value="resolu">Résolu</option>
	<?php }else if(strcmp($monticket[0]['statut'],"résolu")==0){ ?>
		<option value="en cours">En cours</option>
		<option value="en attente">En attente</option>
		<option selected value="résolu">Résolu</option>
	<?php }else if(strcmp($monticket[0]['statut'],"en cours")==0){ ?>
		<option value="en cours">En cours</option>
		<option value="en attente">En attente</option>
		<option selected value="resolu">Résolu</option>
	<?php }else{?>
		<option selected value="en cours">En cours</option>
		<option value="en attente">En attente</option>
		<option value="resolu">Résolu</option>
	<?php } ?>
  </select>
  </div>
  <div class="col s3">
   <label>Type de produit</label>
  <select name="type" class="browser-default">
   <?php if($monticket[0]['type'] == "inconnu"){?>
		<option selected value="inconnu">Inconnu</option>
		<option value="ordinateur">Ordinateur</option>
		<option value="tv">TV</option>
		<option value="imprimante">Imprimante</option>
		<option value="appareil_photo">Appareil photo</option>
		<option value="autre">Autre</option>
   <?php }else if($monticket[0]['type'] == "ordinateur"){ ?>
		<option value="inconnu">Inconnu</option>
		<option selected value="ordinateur">Ordinateur</option>
		<option value="tv">TV</option>
		<option value="imprimante">Imprimante</option>
		<option value="appareil_photo">Appareil photo</option>
		<option value="autre">Autre</option>
   <?php }else if($monticket[0]['type'] == "tv"){ ?>
		<option value="inconnu">Inconnu</option>
		<option value="ordinateur">Ordinateur</option>
		<option selected value="tv">TV</option>
		<option value="imprimante">Imprimante</option>
		<option value="appareil_photo">Appareil photo</option>
		<option value="autre">Autre</option>
   <?php }else if($monticket[0]['type'] == "imprimante"){ ?>
		<option value="inconnu">Inconnu</option>
		<option value="ordinateur">Ordinateur</option>
		<option value="tv">TV</option>
		<option selected value="imprimante">Imprimante</option>
		<option value="appareil_photo">Appareil photo</option>
		<option value="autre">Autre</option>
   <?php }else if($monticket[0]['type'] == "appareil_photo"){ ?>
		<option value="inconnu">Inconnu</option>
		<option value="ordinateur">Ordinateur</option>
		<option value="tv">TV</option>
		<option value="imprimante">Imprimante</option>
		<option selected value="appareil_photo">Appareil photo</option>
		<option value="autre">Autre</option>
   <?php }else if($monticket[0]['type'] == "autre"){ ?>
		<option value="inconnu">Inconnu</option>
		<option value="ordinateur">Ordinateur</option>
		<option value="tv">TV</option>
		<option value="imprimante">Imprimante</option>
		<option value="appareil_photo">Appareil photo</option>
		<option selected value="autre">Autre</option>
	<?php }?>
  </select>
  </div>
   </div>
   <div class="row">
        <div class="input-field col s6 white-text">
          <input id="produit" type="text" name="produit" value='<?php echo $monticket[0]['produit'];?>' class="validate">
          <label for="produit">Numéro du produit</label>
        </div>
  </div>
 <div class="row">
        <div class="input-field col s6 white-text">
          <input id="email" type="text" name="email" value='<?php echo $client[0]['email'];?>' class="validate">
          <label for="email">Adresse mail</label>
        </div>
  </div>
  <div class="row">
  	 <div class="input-field col s3 white-text">
          <input id="prenom" type="text" name="prenom" value='<?php echo $client[0]['prenom'];?>' class="validate">
          <label for="prenom">Prénom</label>
        </div>
        <div class="input-field col s3 white-text">
          <input id="nom" type="text" name="nom" value="<?php echo $client[0]['nom'];?>" class="validate">
          <label for="nom">Nom</label>
        </div>
  </div>
        <div class="row">
		            <div class="card-content white-text">
					   <h5>Problème :</h5>
          <div class="input-field col s12">
            <textarea id="probleme" name="probleme"  class="materialize-textarea" data-length="500"><?php echo $monticket[0]['probleme']; ?></textarea>
          </div>
        </div>
		</div>
		<div class="card-action">
		    <button class="btn waves-effect waves-light"  type="submit" name="action">Valider</a>
				<i class="material-icons right">send</i>
			</button>
		</div>
	  	</div>
    </div>
      </div>
	 </div>
	     </form>

		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/chrono.js">
		</script>
		<script>
			var sessionId = <?php echo $_SESSION['id']; ?>;
			function fonction_update(){
				// traitement
				setInterval('update()', 15000);
			}
			
			function update(){
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.open("POST", "http://savu.axelbrouland.fr/index.php/savu/update_tempscommunication/" + sessionId);
        		xmlhttp.send();
			}
		</script>
	</body>
</html>
