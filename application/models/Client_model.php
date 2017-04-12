<?php
class Client_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function get_liste_clients()
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._client')
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_client($client)
		{
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._client')
					     ->where('idclient', $client)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function set_client($idclient,$email,$prenom,$nom){
			$data = array(
    			'email' => $email,
        		'prenom'  => $prenom,
        		'nom' => $nom,
			);
			$this->db->where('idclient', $idclient);
			$this->db->update('wxjwqm_savu._client', $data);
		}
		
		public function creation_client(){
			$data = array(
				'nom' => null,
				'prenom' => null,
				'email' => null,
			);
			$this->db->insert('wxjwqm_savu._client',$data);	
		}
		
		public function get_id_client_recent(){
			$result = $this->db->select_max('idclient')->get('wxjwqm_savu._client')->result_array();
    		return (int) $result[0]['idclient'];
		}
}
?>