<?php
class Ticket_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		// Fonction permettant de renvoyé la liste des tickets concernant un client spécifique (mis en paramètre)
		
		public function nb_tickets()
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._ticket')
					     ->get()
					     ->num_rows();
			return $data;
		}
		
		
		public function id_tickets()
		{
			$data = $this->db->select('idticket')
					     ->from('wxjwqm_savu._ticket')
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_ticket_by_technicien($idtechnicien){
			$data = $this->db->select('*')
						->from('wxjwqm_savu._ticket')
						->where('technicien',$idtechnicien)
						->get()
						->result_array();
			return $data;
		}
		public function get_liste_ticket_client($client)
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._ticket')
					     ->where('client', $client)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		// Fonction retournant un ticket spécifique grâce à son numéro (mis en paramètre)
		
		public function get_ticket($idticket)
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._ticket')
					     ->where('idticket', $idticket)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_ticket_en_cours()
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._ticket')
					     ->where('statut', "en cours")
					     ->get()
					     ->result_array();
					     
			return $data;
		}
		
		// Fonction permettant la mise à jour du ticket déjà créé dans la BDD et ce par le technicien
		
		public function modif_ticket($idticket,$probleme,$statut,$type,$produit)
		{
			$data = array(
    			'probleme' => $probleme,
        		'statut'  => $statut,
        		'type' => $type,
        		'produit' => $produit,
        	
			);
			$this->db->where('idticket', $idticket);
			$this->db->update('wxjwqm_savu._ticket', $data);
		}
		
		public function nb_tickets_resolus()
		{
			$data = $this->db->select('statut')
						 ->from('wxjwqm_savu._ticket')
						 ->where('statut', "résolu")
						 ->get()
						 ->num_rows();
			return $data;
		}
		
		public function ticket_present($numTicket){
			$data = $this->db->select('idticket')
						 ->from('wxjwqm_savu._ticket')
						 ->where('idticket', $numTicket)
						 ->get()
						 ->num_rows();
			return $data;
		}
		
		public function set_id_technicien($idticket, $idtechnicien){
			$data = array(
    			'technicien' => $idtechnicien,
			);
			$this->db->where('idticket', $idticket);
			$this->db->update('wxjwqm_savu._ticket', $data);
		}
		
		public function creation_ticket($type,$num_serie,$probleme,$client){
			$data =array(
				'type' => $type,
				'produit' => $num_serie,
				'probleme' => $probleme,
				'client' => $client,
				'statut' => 'en cours',
 			);
			$this->db->set($data);
			return $this->db->insert('wxjwqm_savu._ticket');	
		}
		
		public function reouverture_ticket($idticket){
				$data = $this->db->select('probleme')
						 ->from('wxjwqm_savu._ticket')
						 ->where('idticket', $idticket)
						 ->get()
						 ->result_array();
			return $data;	
		}
		
		public function update_probleme($ticket,$probleme){
				$data = array(
    			'probleme' => $probleme,
    			'statut' => "en cours"
			);
			$this->db->where('idticket', $ticket);
			$this->db->update('wxjwqm_savu._ticket', $data);
		}
		
		public function get_technicien($idticket)
		{
			$data = $this->db->select('technicien')
					     ->from('wxjwqm_savu._ticket')
					     ->where('idticket', $idticket)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_id_ticket_recent(){
			$result = $this->db->select_max('idticket')->get('wxjwqm_savu._ticket')->result_array();
    		return $result[0]['idticket'];
		}
		
		public function get_id_ticket_technicien($idtechnicien)
		{
			$data = $this->db->select('idticket')
					     ->from('wxjwqm_savu._ticket')
					     ->where('technicien', $idtechnicien)
					     ->get()
					     ->result_array();
			return $data;
		}

}
?>