<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asterisk extends CI_Controller {

		/**
		 * Index Page for this controller.
		 *
		 * Maps to the following URL
		 * 		http://example.com/index.php/welcome
		 *	- or -
		 * 		http://example.com/index.php/welcome/index
		 *	- or -
		 * Since this controller is set as the default controller in
		 * config/routes.php, it's displayed at http://example.com/
		 *
		 * So any other public methods not prefixed with an underscore will
		 * map to /index.php/welcome/<method_name>
		 * @see https://codeigniter.com/user_guide/general/urls.html
		 */
	 
	 // Constructeur du contrôleur, il charge les différents modèles
	 
	public function __construct()
	{
		parent::__construct();
		$models = array('utilisateur_model', 'ticket_model', 'technicien_model', 'client_model', 'enregistrementconversation_model','produit_model', 'satisfaction_model');
		$this->load->model($models);
	}
	 
	 // Fonction qui charge la vue correspondant à la page d'accueil
	 
	public function index()
	{
		
	}
	
	public function mauvaisNum($numTicket){
		$resultat = $this->ticket_model->ticket_present($numTicket);
		if($resultat == 0){
			$reponse = 2;
		}else{
			$reponse = 1;
		}
		echo $reponse;
	}
	
	public function verifSerie($numSerie){
		$resultat = $this->produit_model->produit_present($numSerie);
		if($resultat == 0){
			$reponse =  2;
		}else{
			$reponse =  1;
		}
		echo $reponse;
	}
	
	public function temps_attente($ticket){
		
		$temps_attente = 0;
		
		$techniciens_indisponibles = $this->technicien_model->get_techniciens_indisponibles();
		
		if($techniciens_indisponibles != array()){
			$nb_techniciens = count($techniciens_indisponibles);
			
			$collection = array();
								
			foreach($techniciens_indisponibles as $unTechnicien){
				$collection[] = array("idtechnicien" => $unTechnicien['idtechnicien'], 'statut' => $unTechnicien['statut'], "tempscommunication" => $unTechnicien['tempscommunication']);
			}
				
			$temps_communication = array();
	 
			foreach ($collection as $unTechnicien){
	    		$temps_communication[] = $unTechnicien['tempscommunication'];
			}
				
			array_multisort($temps_communication, SORT_DESC, $collection);
				
			$temps_communication_moyen = $this->enregistrementconversation_model->get_moyenne_tempscomm()[0]['tempsappel'];
			
			$file_attente = $this->ticket_model->get_ticket_en_cours();
			
			foreach($file_attente as $key => $unTicket){
				if($unTicket['idticket'] == $ticket){
					$place_file_attente = $key+1;
				}
			}
			
			if($place_file_attente%$nb_techniciens == 0){
				$index = 0;
			} else {
				$index = $place_file_attente%$nb_techniciens-1;
			}
			
			$temps_communication_technicien = $this->technicien_model->get_temps_communication($techniciens_indisponibles[$index]['idtechnicien'])[0]['tempscommunication'];
			
			$temps_attente = ((($place_file_attente/$nb_techniciens)*$temps_communication_moyen) - ($temps_communication_technicien));
		}
		
		echo $temps_attente;
	}
	
	public function insertion_ticket($type=" ",$probleme1,$probleme2,$num_serie){
		switch ($probleme1){
			case 1 :
				$probleme1 = "Imprimante non allumée";
				break;
			case 2 :
				$probleme1 = "Problème de cartouche";
				break;
			case 3 :
				$probleme1 = "Papier bloqué";
				break;
			case 4 :
				$probleme1 = "Autre";
				break;
			default :
				$probleme1 = " ";
				break;
		}
		
		switch ($probleme2){
			case 11:
				$probleme2 = "Imprimante branchée";
				break;
			case 12:
				$probleme2 = "Imprimante non branchée";
				break;
			case 21:
				$probleme2 = "Cartouche changée";
				break;
			case 22:
				$probleme2 = "Cartouche non changée";
				break;
			case 31:
				$probleme2 = "Cache démonté";
				break;
			case 32:
				$probleme2 = "Cache non démonté";
				break;
			default:
				$probleme2 = " ";
				break;
		}

		$probleme = $probleme1."-".$probleme2;
		
		$id_client = $this->client_model->get_id_client_recent();
		
		
		if($num_serie == 0){
			$serie = 0;
		} else {
			$serie = $num_serie;
		}
		
		if($type == " "){
			$type_final = "inconnu";
		} else {
			$type_final = $type;
		}
		
		$this->client_model->creation_client();
		
		$ticket = $this->ticket_model->creation_ticket($type_final,$serie,$probleme,$id_client+1);
		$idticket = $this->ticket_model->get_id_ticket_recent();
		
		echo $idticket;
	}
	
	public function reouverture_ticket($ticket){
		
		$probleme = $this->ticket_model->reouverture_ticket($ticket);
		$this->ticket_model->update_probleme($ticket,$probleme[0]['probleme'] . " / reouverture du ticket : ");
	}
	
	public function satisfaction($amabilite,$didactique,$rapidite,$idticket){
		$this->satisfaction_model->insert_satisfaction($amabilite,$didactique,$rapidite,$idticket);
	}
}
?>