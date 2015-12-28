                                                                                                <?php

	include_once ('classes/classCatalogoDAO.php');
	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once($_SERVER['DOCUMENT_ROOT'] . '/WideImage/WideImage.php');

	//pegando o id do catálogo a ser inserida a imagem
	$id = $_POST['id'];
	//pegando a imagem cadastrada
	$imagem = $_FILES['imagem'];
	
	$catalogo = new CatalogoDAO;

	//se a imagem não estiver vazia.
	if(!empty($imagem["name"]))
	{

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
				$nome_imagem = time() . "." . $ext[1];
				//--------------------------------------------------------------------
				
				
				
				$caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/paginas/" . $nome_imagem;

				//$caminho_imagem = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/paginas/" . $imagem['name'];
				//--------------------------------------------------------------------
				
				
				
				//--------------------------------------------------------------------
				//String a ser armazenada no banco
				$string_banco = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/paginas/" . $nome_imagem;
				
				//Salva o caminho da página no banco
				$catalogo->atualizaCatalogo($id, 3, $string_banco);
				
				//--------------------------------------------------------------------
				// Faz o upload da imagem para seu respectivo caminho 
				//tmp_name é o nome temporario para manipulação do arquivo.
				move_uploaded_file($imagem['tmp_name'], $caminho_imagem);
				//--------------------------------------------------------------------
				
				
				
				//--------------------------------------------------------------------
				//Redimensionando a imagem para gerar o thumbnail
				
				//Carregando a imagem original
				$imagem = wideImage::load($_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/paginas/" . $nome_imagem);

				//Redimensionando
				$imagem = $imagem->resize(400, 300);
				
				$caminho_thumb = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/thumb/" . $nome_imagem;
				
				//Salvando a thumbnail no caminho especificado
				$imagem->saveToFile($caminho_thumb);
				//--------------------------------------------------------------------
				
				//Salva o caminho do thumbnail no banco
				$catalogo->atualizaCatalogo($id, 4, $caminho_thumb);
				
				
				//--------------------------------------------------------------------
				//Retornando valores
				$array = array('path'=>$caminho_imagem, 'thumb'=>$caminho_thumb); 
				echo json_encode($array);
				//--------------------------------------------------------------------	
					
			}
		}	
	}
?>
                            
                            
                            
                            