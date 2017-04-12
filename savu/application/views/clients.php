<!DOCTYPE html>
<html lang='fr'>
	<head>
		<title>Liste des clients</title>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.min.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/materialize.css">
  		<link type="text/css" rel="stylesheet" href="http://savu.axelbrouland.fr/assets/css/style.css">
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	<body class="grey lighten-2">
		<?php include($menu); ?>
		<div class="container white technicien z-depth-2">
			<?php if($clients == array()){?>
				<h1>Aucun client</h1>
			<?php } else { ?>
				<h1>Liste des clients</h1>
				<div class="row">	
					<table class="bordered highlight">
						<thead> 
							<th>ID</th>
							<th>Nom</th>
							<th>Prénom</th>
							<th>E-mail</th>
							<tr>
						</thead>
						<tbody>
								<?php foreach ($clients as $key => $unClient) :?>
									<?php echo "<td>".$unClient['idclient']."</td>"; ?>
									<?php echo "<td>".$unClient['nom']."</td>"; ?>
									<?php echo "<td>".$unClient['prenom']."</td>"; ?>
									<?php echo "<td>".$unClient['email']."</td>"; ?>
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
