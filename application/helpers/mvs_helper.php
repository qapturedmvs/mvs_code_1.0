<?php

function btnType( $uri, $type = null, $events = null ){
	$html;
	switch( $type ){
		case 'edit':
			$html = '<i class="glyphicon glyphicon-edit"></i>';
			break;
		case 'remove':
			$html = '<i class="glyphicon glyphicon-remove"></i>';
			break;
		case 'add':
			$html = '<i class="glyphicon glyphicon-plus"></i>';
			break;
		default:
			$html = '';
	}
	
	return anchor($uri, $html, $events);
}


function changeObjectKeys( $obj, $keys = null ){
	
	if( $keys ){
		foreach ($obj as $key => $value) {
			$obj[ $keys . $key ] = $obj[ $key ];
			unset( $obj[ $key ] );
		}
	}
	return $obj;
}


function getMessage($type, $message){
	
	$html;
	
	switch($type){
		case 'success':
			$html = '<div class="alert alert-success" role="alert">'.$message.'</div>';
			break;
		case 'info':
			$html = '<div class="alert alert-info" role="alert">'.$message.'</div>';
			break;
		case 'warning':
			$html = '<div class="alert alert-warning" role="alert">'.$message.'</div>';
			break;
		case 'danger':
			$html = '<div class="alert alert-danger" role="alert">'.$message.'</div>';
			break;
		default:
			$html = '';
	}
	
	return $html;
}
