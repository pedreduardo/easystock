<?php                                                                                                                                                                                                                                                                                                                                                                <?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
class CatalogoDAO
{


	//---------------------------------------------------------------------------------
	//Inserindo um novo catálogo (no caso, em branco) ao banco.
	public function insereCatalogo()
	{
	
		//--------------------------------------------------------------------
		//Inserindo valores nulos no banco
		$con = open_con();		
		$sql = "INSERT INTO cs_catalogos () VALUES ()";
		
		mysqli_query($con,$sql);
		//--------------------------------------------------------------------

		//--------------------------------------------------------------------
		//Selecionando o maior valor (no caso, o que acaou de ser adicionado ao banco).	
		$sql = "SELECT MAX(id) as Maior FROM cs_catalogos";
		
		$result = mysqli_query($con,$sql);
		
		$row = mysqli_fetch_array($result); 
		
		
		$id = $row['Maior'];
		//--------------------------------------------------------------------
	
		mysqli_close($con);
		
		return $id;
		
	}
	//---------------------------------------------------------------------------------


	
	//---------------------------------------------------------------------------------	
	//Atualizando informações no banco (nome, capa e páginas).
	//Opções: 
	//1: Inserir nome
	//2: Inserir capa
	//3: Inserir Página
	public function atualizaCatalogo($id, $op, $dado)
	{
		$con = open_con();

	
		if($op == 1)
		{
			$sql = "UPDATE cs_catalogos SET nome = '$dado' WHERE id = '$id'";
			mysqli_query($con,$sql);
		}
		
		else if($op == 2)
		{
			$sql = "UPDATE cs_catalogos SET capa = '$dado' WHERE id = '$id'";
			mysqli_query($con,$sql);
		}
		
		else if($op == 3)
		{
			$sql = "INSERT INTO cs_catalogo_paginas (id_Catalogo, pagina) VALUES('$id', '$dado')";
			mysqli_query($con,$sql);
		}
		
		else if($op == 4)
		{
			$sql = "INSERT INTO cs_catalogo_pg_thumb (id_Catalogo, thumb) VALUES('$id', '$dado')";
			mysqli_query($con,$sql);
		}
		
		mysqli_close($con);
	}
	//---------------------------------------------------------------------------------



	//---------------------------------------------------------------------------------	
	//Deletando catálogo.
	public function deletaCatalogo($id)
	{
		$con = open_con();
		
		//--------------------------------------------------------------------
		//Deletando o diretório do catálogo
		$pasta = "galeria/" . $id;
		
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS), 	RecursiveIteratorIterator::CHILD_FIRST) as $path)
		{
			$path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		}
		rmdir($pasta);
		
		//rmdir($diretorio);
		//--------------------------------------------------------------------


		//--------------------------------------------------------------------
		//Deletando todas as páginas do catálogo.
		$sql = "DELETE FROM cs_catalogo_paginas WHERE id_Catalogo = '$id'";
		mysqli_query($con,$sql);
		
		//--------------------------------------------------------------------
		//Deletando todas as thumbnails do catálogo.
		$sql = "DELETE FROM cs_catalogo_pg_thumb WHERE id_Catalogo = '$id'";
		mysqli_query($con,$sql);
		
		
		//Deletando o catalogo em si
		$sql = "DELETE FROM cs_catalogos WHERE id = '$id'";
		mysqli_query($con,$sql);
		//--------------------------------------------------------------------
		
		mysqli_close();
		
	}
	//---------------------------------------------------------------------------------

	
	//---------------------------------------------------------------------------------
	//Deletando capa de um catálogo.
	public function deletaCapa($id)
	{
		$con = open_con();

		//Deletando a capa.
		$sql = "UPDATE cs_catalogos SET capa = null where id = '$id'";
		mysqli_query($con,$sql);
		
		mysqli_close();
		
		$pasta = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/capa/";
		
		$diretorio = dir($pasta);
		while($arquivo = $diretorio->read())
		{
			if(($arquivo != '.')&& (arquivo != '..'))
			{
				unlink($pasta.$arquivo);
			}
		
		}
		$diretorio->close();
		
		
	}
	//---------------------------------------------------------------------------------

	
	
	
	
	//---------------------------------------------------------------------------------
	//Deletando Página específica de um catálogo.
	public function deletaPaginas($id, $thumb)
	{
		$con = open_con();

			echo $id . " ";
			echo $url . " ".

		$thumb =  substr($thumb, 39);

		echo " " . "cortado: ". $thumb;

		$pieces = explode("/", $thumb);

		$nome_imagem = $pieces[3];

		echo " nome da imagem: " . $nome_imagem;

		$path = $_SERVER['DOCUMENT_ROOT'] . '/Catalogo/galeria/' . $id . '/paginas/' . $nome_imagem;
		$path_thumb = $_SERVER['DOCUMENT_ROOT'] . '/Catalogo/galeria/' . $id . '/thumb/' . $nome_imagem;

		echo " path: " . $path;
		
		//Deletando a página.
		$sql = "DELETE FROM cs_catalogo_paginas WHERE id_Catalogo = '$id' AND pagina = '$path'";
		mysqli_query($con,$sql);
		
		//Deletando a thumbnail da página.
		$sql = "DELETE FROM cs_catalogo_paginas WHERE id_Catalogo = '$id' AND thumb = '$thumb'";
		mysqli_query($con,$sql);
		
		mysqli_close();

		unlink($path);
		unlink($path_thumb);
		
	}
	//---------------------------------------------------------------------------------

	
	
	
	//---------------------------------------------------------------------------------
	//Exibindo todos os catálogos
	public function exibeCatalogos()
	{
		$con = open_con();
		
		$sql = "SELECT * from cs_catalogos ORDER BY id";
		
		$rows = array();
		$result = mysqli_query($con, $sql);
		$i = 0;
		while($r = mysqli_fetch_array($result))
		{
			$rows[$i][id] = $r['id'];
			$rows[$i][path] = $r['capa'];
			$i++;
		}
		echo json_encode($rows);
		
		mysqli_close($con);
	}
	//---------------------------------------------------------------------------------
	
	
	
	//---------------------------------------------------------------------------------		
	//Exibindo todas as páginas de um catálogo
	public function exibeCapa($id)
	{
		$con = open_con();
		
		$sql = "SELECT capa FROM cs_catalogos WHERE id = '$id'";
		
		$rows = array();
		$result = mysqli_query($con, $sql);
		$i = 0;
		while($r = mysqli_fetch_array($result))
		{
			$rows[$i][path] = $r['capa'];
			$i++;
		}
		echo json_encode($rows);
	
		mysqli_close($con);
	
	}
	//---------------------------------------------------------------------------------
	
	
	
	//---------------------------------------------------------------------------------
	//Exibindo todas as páginas de um catálogo
	public function exibePaginas($id)
	{
		$con = open_con();
		
		$sql = "SELECT pg.id, pg.id_Catalogo, pg.pagina, tb.thumb
			FROM cs_catalogo_paginas pg JOIN cs_catalogo_pg_thumb tb
			ON pg.id_Catalogo = tb.id_Catalogo
			WHERE pg.id_Catalogo = '$id'
			AND RIGHT(pg.pagina,14) = RIGHT(tb.thumb,14)
			ORDER BY pg.id";

		
		$rows = array();
		$result = mysqli_query($con, $sql);
		$i = 0;
		while($r = mysqli_fetch_array($result))
		{
			$rows[$i][id] = $r['id_Catalogo'];
			$rows[$i][path] = $r['pagina'];
			$rows[$i][thumb] = $r['thumb'];
			$i++;
		}
		echo json_encode($rows);
	
		mysqli_close($con);
	
	}
	//---------------------------------------------------------------------------------
	
	
	
	

}
                            
 ?>                           
                            
                            
                            
                            
                            
                            
                            
                            
                            