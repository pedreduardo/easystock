<?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('classes/classCatalogoDAO.php');
		
	$catalogo = new CatalogoDAO;

	$id = $catalogo->exibeCatalogos();

?>