<?php
// Check if set
if(isset($_GET["_id"])) 
	$id = $_GET["_id"];
else 
	die('{"status":404},"msg":"Clothes id not selected"');

//Connect
include "../db-connect.php";
$data = array();

// Select mode
$mode = "mysql"; //or "neo4j"
if($mode=="mysql"){
	//select clothes
	$layers = array();
	$query = "SELECT DISTINCT id_clothes2 FROM layers WHERE id_clothes1 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($layers, $row["id_clothes2"]);
		}
	} else {
		die('{"status":404}');
	}
	$query = "SELECT DISTINCT id_clothes1 FROM layers WHERE id_clothes2 = $id";
	$result = mysql_query($query,$db);
	if($result){
		while($row = mysql_fetch_array($result)) {
			array_push($layers, $row["id_clothes1"]);
		}
	} else {
		die('{"status":404}');
	}
	$layers = implode(",",array_unique($layers));
	$query = "SELECT * FROM clothes WHERE id IN ($layers)";
	$result = mysql_query($query,$db);
	if($result) {
		while($row = mysql_fetch_array($result)) {
			array_push($data, array(
				"id" => $row["id"],
				"photo" => $row["photo"],
				"category" => $row["category"]
			));
		}
		//output dalam JSON
		echo json_encode($data);
	} else {
		die('{"status":404}');
	}
}else if($mode=="neo4j"){
	//select clothes
}else{
	die('{"status":412},"msg":"must choose MySQL or Neo4j"');
}
?>