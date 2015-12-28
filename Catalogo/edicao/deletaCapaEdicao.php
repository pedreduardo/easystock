<?php

	$id = $_POST['id'];
	
	$pasta = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/edicao/galeria/" . $id . "/capa/";
		
		$diretorio = dir($pasta);
		while($arquivo = $diretorio->read())
		{
			if(($arquivo != '.')&& (arquivo != '..'))
			{
				unlink($pasta.$arquivo);
			}
		
		}
		$diretorio->close();
		
?>