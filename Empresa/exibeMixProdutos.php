<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	

	$con = open_con();

	$sql = "SELECT mix_produtos from cs_empresa WHERE id = 1";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$array = array ('mixProdutos'=>$row['mix_produtos']);
					
	echo json_encode($array);
	
	mysqli_close($con);
	
?>