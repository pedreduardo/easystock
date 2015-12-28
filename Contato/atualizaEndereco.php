<?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$cep = $_POST['cep'];
	$telefone = $_POST['telefone'];
	$email = $_POST['email'];
	
	$con = open_con();
	
	$sql =	"UPDATE cs_endereco SET
			rua = '$rua',
			numero = '$numero',
			bairro = '$bairro',
			cidade = '$cidade',
			estado = '$estado',
			cep = '$cep',
			telefone = '$telefone',
			email = '$email'
			WHERE id = 1";
			
	mysqli_query($con,$sql);
	mysqli_close($con);
 	
?>