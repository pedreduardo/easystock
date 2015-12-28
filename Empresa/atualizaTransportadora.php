<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$transportadora = $_POST['transportadora'];
	
	$con = open_con();

	$sql = "UPDATE cs_empresa SET transportadora = '$transportadora' WHERE id = 1";
	mysqli_query($con,$sql);
	
	mysqli_close($con);
	
?>