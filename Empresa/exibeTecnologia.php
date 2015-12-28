<?php 

	//include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('C:\Program Files (x86)\EasyPHP-DevServer-14.1VC11\data\localweb\projects\estoqueFacil\settings\config.php');
	

	$con = open_con();

	$sql = "SELECT tecnologia from cs_empresa WHERE id = 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$array = array ('tecnologia'=>$row['tecnologia']);
					
	echo json_encode($array);
	
	mysqli_close($con);
	
?>