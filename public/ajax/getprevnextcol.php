<?php 
  define('AJAX_REQUEST', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
  if(!AJAX_REQUEST) {die();}

  //--------------------------------------------------------------------------
  // Example php script for fetching data from mysql database
  //--------------------------------------------------------------------------
  $host = "127.0.0.1";
  $user = "root";
  $pass = "";

  $databaseName = "CyclingCols";

  //--------------------------------------------------------------------------
  // 1) Connect to mysql database
  //--------------------------------------------------------------------------
  //include 'DB.php';
  $con = mysql_connect($host,$user,$pass);
  $dbs = mysql_select_db($databaseName, $con);
  mysql_query("SET character_set_results=utf8", $con);

  //--------------------------------------------------------------------------
  // 2) Query database for data
  //--------------------------------------------------------------------------
  $cols = array();
  if (isset($_GET["number"])) {
	  $number = $_GET["number"];
	  $result = mysql_query("SELECT ColIDString, Col, Number FROM cols WHERE Number - " . $number . " IN (-1,1)");   //query
	  while($res = mysql_fetch_array($result)) {
		$cols[] = $res;
	  }
  }

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($cols);
?>