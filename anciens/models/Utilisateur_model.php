<?php

	class Utilisateur_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function get_utilisateurs()
		{
			
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._utilisateur')
					     ->get()
					     ->result_array();
					     
			return $data;
		}
		
		public function supprimer_utilisateur($iduser)
		{
			$this->db->where('iduser', $iduser);
			return $this->db->delete('wxjwqm_savu._utilisateur');
		}
		
		public function get_liste_techniciens()
		{
			
			$data = $this->db->select('*')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('type', "technicien")
					     ->get()
					     ->result_array();
					     
			return $data;
		}
		
		public function get_max_id_technicien()
		{
			
			$data = $this->db->select_max('iduser')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('type', "technicien")
					     ->get()
					     ->result_array();
					     
			return $data;
		}
		
		public function ajouter_utilisateur($login, $password, $nom, $prenom, $type){
			$data =array(
				'login' => $login,
				'password' => $password,
				'nom' => $nom,
				'prenom' => $prenom,
				'type' => $type
 			);
			
			$this->db->set($data);
			return $this->db->insert('wxjwqm_savu._utilisateur');
		}
		
		public function login_in($login)
		{
			$data = $this->db->select('login')
			         ->from('wxjwqm_savu._utilisateur')
			         ->where('login', $login)
			         ->get()
			         ->result_array();
			         
			if ($data != null)
			{
				return true;
			}
			else 
			{
				return false; 
				
			}
		}
		
		public function password_for_login($login)
		{
			$data = $this->db->select('password')
			         ->from('wxjwqm_savu._utilisateur')
			         ->where('login', $login)
			         ->get()
			         ->result_array();
			         
			return $data;
		}
		
		public function get_idutilisateur($login)
		{
			
			$data = $this->db->select('iduser')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('login', $login)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_type($id){
			$data = $this->db->select('type')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('iduser', $id)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		public function get_nomtechnicien($id)
		{
			$data = $this->db->select('nom')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('iduser', $id)
					     ->get()
					     ->result_array();
			return $data;
		}
		
		
		public function get_prenomtechnicien($id)
		{
			$data = $this->db->select('prenom')
					     ->from('wxjwqm_savu._utilisateur')
					     ->where('iduser', $id)
					     ->get()
					     ->result_array();
			return $data;
		}
}
?>
