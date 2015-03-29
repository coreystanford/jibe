<?php

ini_set('display_errors', 0);
error_reporting(0);

set_error_handler("errorHandler");

function errorHandler($errorno, $errormsg, $filename, $linenum, $vars){

	$errortype = array(
	        E_ERROR => "Error",
	        E_WARNING => "Warning",
	        E_NOTICE => "Notice"
	                   );

	$dt = date('Y-m-d H:i:s');

	$error = "Error Report\n";
	$error .= "\tDateTime: " . $dt . "\n";
	$error .= "\tError Number: " . $errorno . "\n";
	$error .= "\tError Type: " . $errortype[$errorno] . "\n";
	$error .= "\tError Message: " . $errormsg . "\n";
	$error .= "\tFile Name: " . $filename . "\n";
	$error .= "\tLine Number: " . $linenum . "\n";
	$error .= "\tFile Name: " . $filename . "\n";
	$error .= "End Error Report\n";

	error_log($error, 3, dirname(__FILE__) . "/logs/errorlog.txt");

}