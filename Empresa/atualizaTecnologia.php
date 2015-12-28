<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$tecnologia = $_POST['tecnologia'];
	
	$con = open_con();

	$sql = "UPDATE cs_empresa SET tecnologia = '$tecnologia' WHERE id = 1";
	mysqli_query($con,$sql);
	
	mysqli_close($con);
	
?>