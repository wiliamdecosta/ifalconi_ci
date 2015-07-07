<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = '192.168.1.101';
$db['default']['username'] = 'ifl';
$db['default']['password'] = 'ifl123';
$db['default']['port']     = 5444;
$db['default']['database'] = 'ifl_db';
$db['default']['dbdriver'] = 'postgre';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$db['ifc_db']['hostname'] = '192.168.1.101';
$db['ifc_db']['username'] = 'ifc';
$db['ifc_db']['password'] = 'ifc123';
$db['ifc_db']['port']     = 5444;
$db['ifc_db']['database'] = 'ifc_db';
$db['ifc_db']['dbdriver'] = 'postgre';
$db['ifc_db']['dbprefix'] = '';
$db['ifc_db']['pconnect'] = TRUE;
$db['ifc_db']['db_debug'] = TRUE;
$db['ifc_db']['cache_on'] = FALSE;
$db['ifc_db']['cachedir'] = '';
$db['ifc_db']['char_set'] = 'utf8';
$db['ifc_db']['dbcollat'] = 'utf8_general_ci';
$db['ifc_db']['swap_pre'] = '';
$db['ifc_db']['autoinit'] = TRUE;
$db['ifc_db']['stricton'] = FALSE;


$db['ifb_db']['hostname'] = '192.168.1.101';
$db['ifb_db']['username'] = 'ifb';
$db['ifb_db']['password'] = 'ifb123';
$db['ifb_db']['port']     = 5444;
$db['ifb_db']['database'] = 'ifb_db';
$db['ifb_db']['dbdriver'] = 'postgre';
$db['ifb_db']['dbprefix'] = '';
$db['ifb_db']['pconnect'] = TRUE;
$db['ifb_db']['db_debug'] = TRUE;
$db['ifb_db']['cache_on'] = FALSE;
$db['ifb_db']['cachedir'] = '';
$db['ifb_db']['char_set'] = 'utf8';
$db['ifb_db']['dbcollat'] = 'utf8_general_ci';
$db['ifb_db']['swap_pre'] = '';
$db['ifb_db']['autoinit'] = TRUE;
$db['ifb_db']['stricton'] = FALSE;


$db['ifp_db']['hostname'] = '192.168.1.101';
$db['ifp_db']['username'] = 'ifp';
$db['ifp_db']['password'] = 'ifp123';
$db['ifp_db']['port']     = 5444;
$db['ifp_db']['database'] = 'ifp_db';
$db['ifp_db']['dbdriver'] = 'postgre';
$db['ifp_db']['dbprefix'] = '';
$db['ifp_db']['pconnect'] = TRUE;
$db['ifp_db']['db_debug'] = TRUE;
$db['ifp_db']['cache_on'] = FALSE;
$db['ifp_db']['cachedir'] = '';
$db['ifp_db']['char_set'] = 'utf8';
$db['ifp_db']['dbcollat'] = 'utf8_general_ci';
$db['ifp_db']['swap_pre'] = '';
$db['ifp_db']['autoinit'] = TRUE;
$db['ifp_db']['stricton'] = FALSE;


$db['ifl_db']['hostname'] = '192.168.1.101';
$db['ifl_db']['username'] = 'ifl';
$db['ifl_db']['password'] = 'ifl123';
$db['ifl_db']['port']     = 5444;
$db['ifl_db']['database'] = 'ifl_db';
$db['ifl_db']['dbdriver'] = 'postgre';
$db['ifl_db']['dbprefix'] = '';
$db['ifl_db']['pconnect'] = TRUE;
$db['ifl_db']['db_debug'] = TRUE;
$db['ifl_db']['cache_on'] = FALSE;
$db['ifl_db']['cachedir'] = '';
$db['ifl_db']['char_set'] = 'utf8';
$db['ifl_db']['dbcollat'] = 'utf8_general_ci';
$db['ifl_db']['swap_pre'] = '';
$db['ifl_db']['autoinit'] = TRUE;
$db['ifl_db']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */