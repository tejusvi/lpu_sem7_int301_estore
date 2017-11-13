<?php
class QueryResult{
	public $status,$message,$data;
	function __construct(){
		$this->status = false;
		$this->message = "Not set.";
		$this->data = null;
	}
}
?>