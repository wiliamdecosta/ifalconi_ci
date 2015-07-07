<?php
/**
* Model for manage P_area Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class P_area extends Abstract_model {

	public $table			= "p_area";
	public $pkey			= "p_area_id";
	public $alias			= "area";

	public $fields 			= array(
								'p_area_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID P_area'),
								'code'	                => array('nullable' => false, 'type' => 'str', 'unique' => true, 'display' => 'Area Code'),
								'description'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),
								
								'create_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
								'create_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
								'update_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
								'update_by'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By')
							);

	public $selectClause 	= "area.*";
	public $fromClause 		= "p_area as area";

	public $refs			= array();

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
			$this->record['p_area_id'] = $this->generate_id('ifp','p_area','p_area_id');

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

/* End of file P_area.php */
/* Location: ./application/models/P_area.php */