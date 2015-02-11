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
	if (isset($_GET["colid"])) {
		$colid = $_GET["colid"];
		$result = mysql_query("SELECT @row_number:=@row_number+1 AS Nr, RedirectURL, BannerFileName FROM banners, (SELECT @row_number:=0) AS t WHERE ColID = " . $colid . " AND Active = 1 ORDER BY RAND()");          //query
		$banners = array();
		while($res = mysql_fetch_array($result)) {
			$banners[] = $res;
		}
	}

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($banners);
?>