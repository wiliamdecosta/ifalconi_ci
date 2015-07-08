<?php
/**
* Model for manage P_bank_branch Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class P_bank_branch extends Abstract_model {
	
	public $table			= "p_bank_branch";
	public $pkey			= "p_bank_branch_id";
	public $alias			= "bank_branch";

	public $fields 			= array(
								'p_bank_branch_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID P_bank_branch'),
								'code'	                => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Counter Code'),
								'p_bank_id'	            => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Bank'),
								'address'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Address'),
								'loket_no'	            => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Counter Number'),
                                'loket_type'	        => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Counter Type'),
								'max_user'	            => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Max User'),
								'status'	            => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Status'),
							    'p_area_id'	            => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Area'),
								'description'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
								
								'create_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
								'create_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
								'update_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
								'update_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By')
							);

	public $selectClause 	= "bank_branch.p_bank_branch_id, bank_branch.code, bank_branch.p_bank_id, bank_branch.address, 
	                                bank_branch.loket_no, bank_branch.loket_type, bank_branch.max_user, bank_branch.status as branch_status,
	                                bank_branch.p_area_id, bank_branch.description, 
	                                bank_branch.create_date, bank_branch.create_by, bank_branch.update_date, bank_branch.update_by,
	                                bank.code as bank_code, bank_area.code as bank_area_code";
	public $fromClause 		= "p_bank_branch as bank_branch
                                    LEFT JOIN p_bank as bank ON bank_branch.p_bank_id = bank.p_bank_id
                                    LEFT JOIN p_area as bank_area ON bank_branch.p_area_id = bank_area.p_area_id";
	
	public $refs			= array('p_user_loket' => 'p_bank_branch_id');
	
	public $comboDisplay	= array();

	function __construct() {
		parent::__construct();
		$this->db = $this->load->database('ifp_db', TRUE); // <-- Please Modified This : ifp_db,ifb_db,ifc_db
	}

	function validate() {
	    $ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');
	    
		if($this->actionType == 'CREATE') {
			//do something
			$this->record['p_bank_branch_id'] = $this->generate_id('ifp','p_bank_branch','p_bank_branch_id');
			
			$this->record['create_date'] = date('Y-m-d');
            $this->record['create_by'] = $user_name;
            $this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $user_name;
		}else {
			//do something
			$this->record['update_date'] = date('Y-m-d');
            $this->record['update_by'] = $user_name;
		}
		return true;
	}
	
}

/* End of file P_bank_branch.php */
/* Location: ./application/models/P_bank_branch.php */