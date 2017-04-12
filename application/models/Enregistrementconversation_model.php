<?php
class Enregistrementconversation_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function nb_tempsattentes()
		{
			$data = $this->db->select('tempsattente')
						 ->from('wxjwqm_savu._enregistrementconversation')
						 ->get()
						 ->num_rows();
			
			return $data;
		}
		
		//Fonction retournant le temps de communication moyen des technicien
		public function get_moyenne_tempscomm(){
			$data = $this->db->select_avg('tempsappel')
						 ->from('wxjwqm_savu._enregistrementconversation')
						 ->get()
						 ->result_array();
			
			return $data;
		}
		
}
?>