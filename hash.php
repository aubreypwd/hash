<?php

include "meekrodb.2.2.class.php";

DB::$user = 'wp';
DB::$password = 'wp';
DB::$dbName = 'hash_dev';

session_start();

if( isset($_GET['action']) ){
	ajax_handler($_GET['action']);
}

function the_nick_classes($nick){
	if(the_nick() == $nick){
		echo " nicksame";
	}
}

function ajax_handler($action){

	if($action=='post_message'){
		$record = array(
			'nick' => $_GET['nick'],
			'message' => h_sanitize_message(
				$_GET['message']
			),
			'hash' => $_GET['hash'],
			'time' => time(),
		);

		DB::insert('messages', $record);
		$record_id = DB::insertId();
		global $record_id;
		include "hash-table.php";

	}elseif($action=='update_table'){
		include "hash-table.php";
	}
}

function the_nick($how=NULL){
	if( isset( $_GET['nick'] ) ){
		if($how=='echo'){
			echo $_GET['nick'];
		}else{
			return $_GET['nick'];
		}
	}else{
		return false;
	}
}

function h_hash($how){
	if( isset($_GET['hash']) ){
		if($how=='echo'){
			echo $_GET['hash'];
		}else{
			return $_GET['hash'];
		}
	}
}

function h_supplied_nick(){
	if( isset($_GET['nick']) ){
		return true;
	}else{
		return false;
	}
}

function h_supplied_hash(){
	if( isset($_GET['hash']) ){
		if($_GET['hash']) return true;
		else return false;
	}
}

function h_sanitize_message($message){
	$message = strip_tags($message);
	return $message;
}

?>