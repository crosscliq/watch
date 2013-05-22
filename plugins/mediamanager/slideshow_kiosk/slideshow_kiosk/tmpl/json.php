<?php 
foreach ($vars->db_files as $key => $item) {
	$string = unserialize($item->file_params);
	$item->file_params = $string;
}
echo json_encode($vars);