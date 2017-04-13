<?php
class Satisfaction_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function insert_satisfaction($amabilite,$didactique,$rapidite,$idticket){
			$data =array(
				'noteamabilite' => $amabilite,
				'noterapidite' => $rapidite,
				'notedidactique' => $didactique,
				'ticket' => $idticket,
 			);
 			$this->db->set($data);
			$this->db->insert('wxjwqm_savu._satisfaction');
		}
		
		public function get_notes($idticket)
		{
			$data = $this->db->select('noteamabilite')
						 ->select('noterapidite')
						 ->select('notedidactique')
					     ->from('wxjwqm_savu._satisfaction')
					     ->where('ticket', $idticket)
					     ->get()
					     ->result_array();
			return $data;
		}
}