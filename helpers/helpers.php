<?php 

//echo "helpers";
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach ($errors as $error) {
		$display .='<li class="text-default">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

//security function to print back html entities   
function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

 ?>