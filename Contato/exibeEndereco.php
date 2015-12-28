<?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');

	$con = open_con();
	
	$sql =	"SELECT * from cs_endereco where id = 1";
	
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);
	
	$array = array (
					'rua' => $row['rua'],
					'numero' => $row['numero'],
					'bairro' => $row['bairro'],
					'cidade' => $row['cidade'],
					'estado' => $row['estado'],
					'cep' => $row['cep'],
					'telefone' => $row['telefone'],
					'email' => $row['email']
					);
					
	echo json_encode($array);

	mysqli_close($con);
 	
?>