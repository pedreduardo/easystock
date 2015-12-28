<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('classes/classCatalogoDAO.php');
	
	$id = $_POST['id'];
		
	$catalogo = new CatalogoDAO;

	$id = $catalogo->deletaCatalogo($id);

?>