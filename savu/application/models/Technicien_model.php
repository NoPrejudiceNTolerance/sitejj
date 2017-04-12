<?php
class Technicien_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		// Fonction ajoutant un technicien dans la BDD (le numéro de l'utilisateur étant mis en paramètre)
		
		public function ajouter_technicien($idtechnicien){
			$data =array(
				'idtechnicien' => $idtechnicien
 			);
			
			$this->db->set($data);
			return $this->db->insert('wxjwqm_savu._technicien');
		}
		
		// Fonction supprimant un technicien de la BDD (son numéro étant mis en paramètre)
		
		public function supprimer_technicien($idtechnicien)
		{
			$this->db->where('idtechnicien', $idtechnicien);
			return $this->db->delete('wxjwqm_savu._technicien');
		}
		
		public function temps_communication_update($idtechnicien){
			
			$tempscommunication = $this->get_temps_communication($idtechnicien)[0]['tempscommunication'];
			
			$tempscommunication = $tempscommunication + 15;
			
			$data = array(
    			'tempscommunication' => $tempscommunication
			);
			
			$this->db->where('idtechnicien', $idtechnicien);
			$this->db->update('wxjwqm_savu._technicien', $data);
		}
		
		public function temps_communication_zero($idtechnicien){
			$data = array(
    			'tempscommunication' => 0
			);
			
			$this->db->where('idtechnicien', $idtechnicien);
			$this->db->update('wxjwqm_savu._technicien', $data);
		}
		
		public function statut_indisponible($idtechnicien){
			$data = array(
    			'statut' => "indisponible",
			);
			
			$this->db->where('idtechnicien', $idtechnicien);
			$this->db->update('wxjwqm_savu._technicien', $data);
		}
		
		public function statut_disponible($idtechnicien){
			$data = array(
    			'statut' => "disponible",
			);
			
			$this->db->where('idtechnicien', $idtechnicien);
			$this->db->update('wxjwqm_savu._technicien', $data);
		}
		
		public function statut_offline($idtechnicien){
			$data = array(
    			'statut' => "offline",
			);
			
			$this->db->where('idtechnicien', $idtechnicien);
			$this->db->update('wxjwqm_savu._technicien', $data);
		}
		
		public function get_techniciens_indisponibles(){
			$data = $this->db->select('*')
						 ->from('wxjwqm_savu._technicien')
						 ->where('statut', 'indisponible')
						 ->get()
						 ->result_array();
			
			return $data;
			
		}
		
		public function get_statut($id){
			
				$data = $this->db->select('statut')
					     ->from('wxjwqm_savu._technicien')
					     ->where('idtechnicien',$id)
					     ->get()
					     ->result_array();
					     
				return $data;
		}
		
		// Fonction retournant le temps de communication d'un technicien
		
		public function get_temps_communication($idtechnicien){
				$data = $this->db->select('tempscommunication')
					     ->from('wxjwqm_savu._technicien')
					     ->where('idtechnicien',$idtechnicien)
					     ->get()
					     ->result_array();
				return $data;
		}
		
		// Fonction retournant le numéro du technicien étant connecté grâce à son login (mis en paramètre)
		
		public function get_identifiant_technicien($login){
				$data = $this->db->select('*')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('login',$login)
					     ->get()
					     ->result_array();
				return $data;
		}
		
		// Fonction permettant de renvoyé le nombre de ticket traité par tel technicien (celui-ci étant en paramètre)
		
		public function nb_tickets($iduser){
			$data = $this->db->select('idticket')
					     ->from('wxjwqm_savu._ticket')
					     ->where('technicien', $iduser);
			return $data->count_all_results();
		}
		
		// Fonction qui retourne les tickets traité par le technicien
		
		public function get_tickets_technicien($iduser){
			$data = $this->db->select('idticket')
					     ->from('wxjwqm_savu._ticket')
					     ->where('technicien', $iduser)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_satisfaction($ticket){
				$data = $this->db->select('*')
					     ->from('wxjwqm_savu._satisfaction')
					     ->where('ticket', $ticket)
					     ->get()
					     ->result_array();
			return $data;
		}
}
?>