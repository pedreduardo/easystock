<?php

	$id = $_POST['id'];
	$url = $_POST['url'];

	$thumb =  substr($url, 39);

	$pieces = explode("/", $thumb);

	$nome_imagem = $pieces[3];

	


	$path = $_SERVER['DOCUMENT_ROOT'] . '/Catalogo/edicao/galeria/' . $id . '/paginas/' . $nome_imagem;
	$path_thumb = $_SERVER['DOCUMENT_ROOT'] . '/Catalogo/edicao/galeria/' . $id . '/thumb/' . $nome_imagem;


	unlink($path);
	unlink($path_thumb);

?>
                            
                            