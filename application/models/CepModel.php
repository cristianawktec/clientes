<?php

class CepModel extends CI_Model {
	
	public function inserir($dados){
		return $this->db->insert('endereco', $dados);
	}

	public function getAll(){
		return $this->db->get('endereco');
	}

	public function get_byId($cep = null){
		
		if($cep != NULL){
	
			$this->db->where('cep', $cep);
			$this->db->limit(1);
	
			return  $this->db->get('endereco');	
	
		}else{
	
			return FALSE;
		}		
	}	

}