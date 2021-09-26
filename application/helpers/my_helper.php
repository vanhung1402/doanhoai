<?php

	defined('BASEPATH') OR exit('No direct script access allowed');

	function pr($data){
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		exit();
	}

	function setMessage($type, $msg){
        $CI 			= &get_instance();
        $dataMessage 	= array(
            'type' 	=> $type,
            'msg' 	=> $msg
        );
        $CI->session->set_flashdata('notification', $dataMessage);
	}

	function getMessage() {
        $CI 			= &get_instance();
        return $CI->session->flashdata('notification');
    }

    function handingArrayToMap($rootArray, $column){
    	$mapArray 		= array();

    	foreach ($rootArray as $el) {
    		if (!isset($mapArray[$el["$column"]])) {
    			$mapArray[$el["$column"]] 	= array();
    		}

    		$mapArray[$el["$column"]][] 	= $el;
    	}

    	return $mapArray;
    }

    function handingKeyArray($rootArray, $column){
    	$mapArray 		= array();

    	foreach ($rootArray as $el) {
    		$mapArray[$el["$column"]] 		= $el;
    	}

    	return $mapArray;
    }

    function reload() {
    	exit('<script>window.location.reload()</script>');
    }

?>