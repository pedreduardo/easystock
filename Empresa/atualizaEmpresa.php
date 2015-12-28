<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$empresa = $_POST['empresa'];
	
	$con = open_con();

	$sql = "UPDATE cs_empresa SET empresa = '$empresa' WHERE id = 1";
	mysqli_query($con,$sql);
	
	mysqli_close($con);
	
?>