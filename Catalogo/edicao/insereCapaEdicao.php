<?php
	
	//pegando o id do catálogo a ser inserida a imagem
	$id = $_POST['id'];
	//pegando a imagem cadastrada
	$imagem = $_FILES['imagem'];
	
	//se a imagem não estiver vazia.
	if(!empty($imagem["name"]))
	{

		//echo "Debug 2.<br>";
		
		//Verificando se o arquivo é uma imagem
		if(getimagesize($imagem['tmp_name'])) 
		//if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $imagem["type"]))
		{
		
			$cont = 0;
			//Se não houve erro nenhum
			if ($cont == 0)
			{
			
				//--------------------------------------------------------------------
				//Pegando a extensão da imagem e guardando na variável $ext
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem['name'], $ext);
				//--------------------------------------------------------------------

				//--------------------------------------------------------------------
				//gerando um nome unico para a imagem
				$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
				//--------------------------------------------------------------------
				
				
				//--------------------------------------------------------------------
				// Caminho de onde ficará a imagem				
				$caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/edicao/galeria/" . $id . "/capa/" . $imagem['name'];
				//--------------------------------------------------------------------
				
				
				//--------------------------------------------------------------------
				//String a ser armazenada no banco
				$string_banco = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/edicao/galeria/" . $id . "/capa/" . $imagem['name'];
				//--------------------------------------------------------------------
				
				move_uploaded_file($imagem['tmp_name'], $caminho_imagem);
				

				$array = array ('path'=>$caminho_imagem); 	
				echo json_encode($array);
					
			}
		}	
	}
	else
	{
		echo "Imagem vazia!";
	}
?>