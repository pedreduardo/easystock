<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$mixProdutos = $_POST['mixProdutos'];
	
	$con = open_con();

	$sql = "UPDATE cs_empresa SET mix_produtos = '$mixProdutos' WHERE id = 1";
	mysqli_query($con,$sql);
	
	mysqli_close($con);
	
?>