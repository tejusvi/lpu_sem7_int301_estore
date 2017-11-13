<?php

require_once('../models/utility.php');
require_once('../models/account.php');

//check if request is ajax
$IsAjax = false;
$request_body = file_get_contents('php://input');
$request_payload = null;
$return_url = null;
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
	$GLOBALS['IsAjax'] = true;
	header('Content-Type: application/json');
	if(isset($GLOBALS['request_body'])&&trim($GLOBALS['request_body'])!==''){
		$GLOBALS['request_payload'] = (array)json_decode($GLOBALS['request_body']);
	}
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && GetValueFromRequest('fn') !== null) {
    ExecuteGetMethod(GetValueFromRequest('fn'));
}else if($_SERVER["REQUEST_METHOD"] == "POST" && GetValueFromRequest('fn') !== null) {
	ExecutePostMethod(GetValueFromRequest('fn'));
}else{
	MethodNotFound();
}

function MethodNotFound($MethodName = null){
	http_response_code(404);
}

function ExecuteGetMethod($fn){
	$qr = null;
	$fn = strtolower(trim($fn));
	switch($fn){
		case 'logout': $qr = GetLogoutUser(); break;
		default: MethodNotFound($fn);
	}
	if(isset($GLOBALS['IsAjax']) && $GLOBALS['IsAjax'] === true){
		echo json_encode($qr);
	}else if(isset($GLOBALS['return_url'])){
		header('location:'.$GLOBALS['return_url']);
	}
}

function ExecutePostMethod($fn){
	$qr = null;
	$fn = strtolower(trim($fn));
	switch($fn){
		case 'createuser': $qr = PostCreateUser(); break;
		case 'loginuser': $qr = PostLoginUser(); break;
		default: MethodNotFound($fn);
	}
	if(isset($GLOBALS['IsAjax']) && $GLOBALS['IsAjax'] === true){
		echo json_encode($qr);
	}else if(isset($GLOBALS['return_url'])){
		header('location:'.$GLOBALS['return_url']);
	}
}

//Local functions
function GetValueFromRequest($field_name){
	$result = null;
	if(isset($_GET[$field_name])){
		$result = $_GET[$field_name];
	}else if(isset($_POST[$field_name])){
		$result = $_POST[$field_name];
	}else if(isset($GLOBALS['request_payload'])&&isset($GLOBALS['request_payload'][$field_name])){
		$result = $GLOBALS['request_payload'][$field_name];
	}
	return $result;
}
//End Local functions

//Start POST Services
function PostCreateUser(){
	$u = new User();
	$u->name = GetValueFromRequest('name');
	$u->email = GetValueFromRequest('email');
	$u->password = GetValueFromRequest('password');
	
	return $u->Create();
}

function PostLoginUser(){
	$u = new User();
	$u->email = GetValueFromRequest('email');
	$u->password = GetValueFromRequest('password');
	
	return $u->Login();
}
//End POST Services

//Start GET Services
function GetLogoutUser(){
	User::Logout();
	$GLOBALS['return_url'] = '../index.php';
}
//End GET Services

?>