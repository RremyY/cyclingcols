<?php 
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
  $result = mysql_query("SELECT RegionID,Region,CountryID,Latitude,Longitude,NrCols,NrSubRegions FROM regions");          //query
  $regions = array();
  while($res = mysql_fetch_array($result)) {
	$regions[] = $res;
  }

  //--------------------------------------------------------------------------
  // 3) echo result as json 
  //--------------------------------------------------------------------------
  echo json_encode($regions);
?>