<?php
class Produit_model extends CI_Model {
		
		public function __construct(){
			$this->load->database();
		}
		
		public function produit_present($numProduit){
			$data = $this->db->select('refproduit')
						 ->from('wxjwqm_savu._produit')
						 ->where('refproduit', $numProduit)
						 ->get()
						 ->num_rows();
			return $data;
		}
		
		public function get_nomproduit($idprod)
		{
			
			$data = $this->db->select('nomproduit')
					     ->from('wxjwqm_savu._produit')
					     ->where('refproduit', $idprod)
					     ->get()
					     ->result_array();
			return $data;
		}
		
}
?>