<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require('conf.php');

$mysql = mysqli_init();
$mysql->real_connect($cfg_db_host, $cfg_db_user, $cfg_db_pass, $cfg_db_name);
if ($mysql->errno) {
	exit();
}
$mysql->set_charset('utf8');

function stmt_bind_assoc (&$stmt, &$out) {
	$data = mysqli_stmt_result_metadata($stmt);
	$fields = array();
	$out = array();

	$fields[0] = $stmt;
	$count = 1;

	while($field = mysqli_fetch_field($data)) {
		$fields[$count] = &$out[$field->name];
		$count++;
	}    
	call_user_func_array('mysqli_stmt_bind_result', $fields);
}
?>
