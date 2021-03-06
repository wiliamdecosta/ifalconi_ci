<?php
/**
* Model for manage P_bank_branch Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class P_bank extends Abstract_model {

	public $table			= "p_bank";
	public $pkey			= "p_bank_id";
	public $alias			= "bank";

	public $fields 			= array(
								'p_bank_id' 		=> array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID P_bank'),
								'code'	                => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Counter Group Code'),
								'description'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
								
								'create_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
								'create_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
								'update_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
								'update_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By')
							);

	public $selectClause 	= "bank.p_bank_id, bank.code, bank.description, to_char(bank.create_date, 'yyyy-mm-dd') as create_date, 
                                    to_char(bank.update_date, 'yyyy-mm-dd') as update_date, bank.create_by, bank.update_by";
	public $fromClause 		= "p_bank as bank";

	public $refs			= array('p_bank_branch' => 'p_bank_id');

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
			$this->record['p_bank_id'] = $this->generate_id('ifp','p_bank','p_bank_id');

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