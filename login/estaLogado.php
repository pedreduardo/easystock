<?php

	session_start();
	include_once ('classUsuarioDAO.php');
	$usuario = new UsuarioDAO;

	$retorno = $usuario->estaLogado();
	if($retorno)
	{
		$array = array('retorno'=>true); 
		echo json_encode($array);
	}
	else
	{
		$array = array('retorno'=>false); 
		echo json_encode($array);
	}

?>
                            
                            
                            
                            
                            