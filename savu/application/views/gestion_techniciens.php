<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Gestion des techniciens</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<div class="container white technicien z-depth-2">
			<?php if($techniciens == array()){?>
				<h1>Aucun technicien</h1>
				<a class="waves-effect waves-light btn red" href="http://savu.axelbrouland.fr/index.php/savu/ajouter_technicien">Ajouter un technicien</a>
			<?php } else { ?>
				<h1>Liste des techniciens</h1>
				<a class="waves-effect waves-light btn couleurfonce" href="http://savu.axelbrouland.fr/index.php/savu/ajouter_technicien">Ajouter un technicien</a>
				<div class="row">	
					<table class="bordered highlight">
						<thead> 
							<th>ID</th>
							<th>Nom</th>
							<th>Prénom</th>
							<tr>
						</thead>
						<tbody>
								<?php foreach ($techniciens as $key => $unTechnicien) :?>
									<?php echo "<td>".$unTechnicien['iduser']."</td>"; ?>
									<?php echo "<td>".$unTechnicien['nom']."</td>"; ?>
									<?php echo "<td>".$unTechnicien['prenom']."</td>"; ?>
									<td><a class="btn waves-effect waves-light couleurfonce" href="<?php echo base_url() . "index.php/savu/supprimer_technicien/".$unTechnicien['iduser'];?>"><i class="material-icons">delete</i></a></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			<?php }?>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.js"></script>
		<script type="text/javascript" src="http://savu.axelbrouland.fr/assets/js/materialize.min.js"></script>
	</body>
</html>
