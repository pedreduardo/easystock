<?php 

	include_once('classes/classCatalogoDAO.php');
	
	$catalogo = new CatalogoDAO;
	
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	
	
	$catalogo->atualizaCatalogoDAO($id, 1, $nome);

	
	
	
?>