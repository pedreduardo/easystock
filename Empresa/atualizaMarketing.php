<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$marketing = $_POST['marketing'];
	
	$con = open_con();

	$sql = "UPDATE cs_empresa SET marketing = '$marketing' WHERE id = 1";
	mysqli_query($con,$sql);
	
	mysqli_close($con);
	
?>