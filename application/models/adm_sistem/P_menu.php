<?php
/**
* Model for manage P_menu Data
* @author wiliamdecosta@gmail.com
* @version 07/05/2015 12:14:29
*
*/

class P_menu extends Abstract_model {

	public $table			= "p_menu";
	public $pkey			= "p_menu_id";
	public $alias			= "menu";

	public $fields 			= array(
								'p_menu_id' 		    => array('pkey' => true, 'type' => 'int', 'nullable' => false, 'unique' => true, 'display' => 'ID P_menu'),
								'p_application_id'	    => array('nullable' => false, 'type' => 'int', 'unique' => false, 'display' => 'Module'),
								'code'	                => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Menu Code'),
								'parent_id'	            => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Parent ID'),
								'file_name'	            => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'File Name'),
								'listing_no'	        => array('nullable' => true, 'type' => 'int', 'unique' => false, 'display' => 'Listing No'),
								'is_active'	            => array('nullable' => false, 'type' => 'str', 'unique' => false, 'display' => 'Is Active'),
								'description'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Description'),

								'creation_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Creation Date'),
								'created_by'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Created By'),
								'updated_date'	        => array('nullable' => true, 'type' => 'date', 'unique' => false, 'display' => 'Updated Date'),
								'updated_by'	        => array('nullable' => true, 'type' => 'str', 'unique' => false, 'display' => 'Updated By')
							);

	public $selectClause 	= "menu.p_menu_id, menu.p_application_id, menu.code, menu.parent_id, menu.file_name,  menu.listing_no, menu.is_active, menu.description, to_char(menu.creation_date, 'yyyy-mm-dd') as creation_date,
                                    to_char(menu.updated_date, 'yyyy-mm-dd') as updated_date, menu.created_by, menu.updated_by,
                                    application.code as application_code,
                                    (CASE WHEN menu.is_active = 'N' OR menu.is_active = '' THEN 3
                                    ELSE 4
                                    END) as status
                                    ";
	public $fromClause 		= "p_menu as menu
	                            LEFT JOIN p_application as application ON menu.p_application_id = application.p_application_id";

	public $refs			= array('p_menu' => 'parent_id',
	                                    'role_menu' => 'p_menu_id');

	public $comboDisplay	= array();

	function __construct() {
		parent::__construct();
	}

	function validate() {
	    $ci =& get_instance();
	    $user_name = $ci->session->userdata('user_name');

		if($this->actionType == 'CREATE') {
			//do something
			$this->record['p_menu_id'] = $this->generate_id('ifl','p_menu','p_menu_id');

			$this->record['creation_date'] = date('Y-m-d');
            $this->record['created_by'] = $user_name;
            $this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $user_name;
		}else {
			//do something
			$this->record['updated_date'] = date('Y-m-d');
            $this->record['updated_by'] = $user_name;
		}
		return true;
	}

}

/* End of file P_menu.php */
/* Location: ./menu/models/P_menu.php */