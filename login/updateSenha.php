                                                                                                <?php

	include_once 'classUsuarioDAO.php';
	$usuario = new UsuarioDAO;

	
	$senha = $_POST['senha'];

	$usuario->setSenha($senha);

	if($usuario->updateSenha())
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
                            
                            
                            