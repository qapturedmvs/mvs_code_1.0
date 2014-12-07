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

function generateSlug($type){
	
	$prefix = ($type == 'movie') ? 'qm' : 'qa';
	$slug = $prefix.str_shuffle(strtolower(random_string('alpha', 5)).random_string('numeric', 3));
	return $slug;
	
}

function getVars($array){
	$qs = '';
	
	if($array){
		$i = 0;
		$sep = '';
		
		foreach($array as $key => $val){
			$sep = ($i > 0) ? '&' : '?';
			
			$qs .= $sep.$key.'='.$val;
			
			$i++;
		}
		
	}
	
	return $qs;
}

function rate_math($imdb, $tmt, $meta){
	
	$bArr = array(array('ref' => 'imdb', 'rate' => 59.13), array('ref' => 'tmt', 'rate' => 23.64), array('ref' => 'meta', 'rate' => 17.23));
	$rArr = array();
	$base = $bArr[0]->ref; $base_r = $bArr[0]->rate;
	
	if($imdb != '' && $imdb != NULL){
		array_push($rArray, 'imdb');
	}
	if($tmt != '' && $tmt != NULL){
		array_push($rArray, 'tmt');
	}
	if($meta != '' && $meta != NULL){
		array_push($rArray, 'meta');
	}
	
	if(count($rArr) > 0){
		$base = $rArr[0];
		foreach($bArr as $item){
			if($item->ref != $base && !in_array($item->ref, $rArr))
				${$item->ref} = (${$base}-($base_r/100))+($item->rate/100);
		}
	}else{
		
	}
	
	return number_format((($imdb*59.13)+($tmt*23.64)+($meta*17.23))/100, 2, '.', '');
	
}

