                                                                                                                                <?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once 'classUsuarioDAO.php';
	$usuario = new UsuarioDAO;

	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$novasenha = $_POST['novasenha'];

		
	$senha_md5 = md5($senha);
	
	$con = open_con();
	$sql = "SELECT * from cs_usuario WHERE login = '$login' AND senha = '$senha_md5'";
		
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
		if ($row < 1) 
		{
			session_unset();
			$array = array('retorno'=>false); 
			echo json_encode($array);
		}
		else
		{	
			$usuario->setSenha($novasenha);
			$usuario->updateSenha();
			
			$array = array('retorno'=>true); 
			echo json_encode($array);
			
		}
		
	mysqli_close($con);
?>
             
                            
                            
                            
                            