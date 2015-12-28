                                                                                                <?php

include_once 'classUsuarioDAO.php';
$usuario = new UsuarioDAO;

$login = $_POST['login'];
$senha = $_POST['senha'];

$usuario->setLogin($login);
$usuario->setSenha($senha);


$usuario->login();

?>

                            
                            
                            