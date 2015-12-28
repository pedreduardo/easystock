                                                                                                <?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('classes/classCatalogoDAO.php');
	$catalogo = new CatalogoDAO;
	
	$id = $_POST['id'];
	$url = $_POST['url'];

	$catalogo->deletaPaginas($id, $url);

?>
                            
                            
                            