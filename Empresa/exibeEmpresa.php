<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');

	$con = open_con();

	$sql = "SELECT empresa from cs_empresa WHERE id = 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$array = array ('empresa'=>$row['empresa']);
					
	echo json_encode($array);
	
	mysqli_close($con);
	
?>