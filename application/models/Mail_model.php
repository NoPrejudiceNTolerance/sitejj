<?php
class Mail_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function envoi_mail($idticket, $email, $prenom, $nom, $nomproduit, $produit, $statut, $id, $nomtechnicien, $prenomtechnicien, $problem)
		{
			require_once(dirname(__FILE__) . '/../../phpmailer/PHPMailerAutoload.php');
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPDebug = 0;
			$mail->SMTPAuth = TRUE;
			$mail->SMTPSecure = "tls";
			$mail->Port     = 587;  
			$mail->Username = "savucactus@gmail.com";
			$mail->Password = "cactus213";
			$mail->Host     = "smtp.gmail.com";
			$mail->Mailer   = "smtp";
			$mail->SetFrom("savucactus@gmail.com", "Savu Cactus");
			//$mail->AddReplyTo("from email", "PHPPot");
			$adresse_mail_client = $email;
			$mail->AddAddress($adresse_mail_client);
			$mail->Subject = "Compte rendu de votre appel";
			$mail->WordWrap   = 80;
			$lien_du_site = "12345";
			$content = "
				<p>Bonjour,<br/>
				   $prenom $nom</p>
				<p>Le ticket numéro : <b>$idticket</b>, que vous venez de déposer au service après vente SAV'U est actuellement : <b>$statut</b>, <br/>
				   Le nom du produit est : <b>$nomproduit</b> et sa référence est : <b>$produit</b><br/>
				   Vous avez été pris en charge par : $nomtechnicien $prenomtechnicien</p>
				<p>Votre problème était le suivant : <br/>
					$problem</p>
				<p>Suite a votre appel, nous vous envoyons le recapitulatif de votre demande. Veuillez cliquer sur ce <a href=http://savu.axelbrouland.fr/".$idticket.".mp3>lien</a>
				   pour retrouver votre recapitulatif.</p>
				<br/>
				<br/>
				<p>Cordialement,<br/>
				<h3>SAV'U</h3>
				Creation de SAV sur mesure<br/>
				savucactus@gmail.com<br/>
				Tel : 01 02 03 04 05 - Mob : 06 12 34 45 78</p>";
			$mail->MsgHTML($content);
			$mail->IsHTML(true);
			if(!$mail->Send()) 
			echo "Problem sending email.";
			else 
			echo "email sent.";	
		}
}
			
?>