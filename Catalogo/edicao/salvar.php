                                                                                                                                <?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	
	$id = $_POST['id'];
		//--------------------------------------------------------------------
		//Deletando o diretório do catálogo original
		$pasta = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id;
		
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
		{
			$path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		}
		rmdir($pasta);
		//--------------------------------------------------------------------
		
		
		//--------------------------------------------------------------------		
		//Movendo a pasta temporária para a galeria original
		
		function CopiaDir($DirFont, $DirDest)
		{
	    
		    mkdir($DirDest);
		    if ($dd = opendir($DirFont)) {
		        while (false !== ($Arq = readdir($dd))) {
		            if($Arq != "." && $Arq != ".."){
		                $PathIn = "$DirFont/$Arq";
		                $PathOut = "$DirDest/$Arq";
		                if(is_dir($PathIn)){
		                    CopiaDir($PathIn, $PathOut);
		                }elseif(is_file($PathIn)){
		                    copy($PathIn, $PathOut);
		                }
		            }
		        }
		        closedir($dd);
		    }
		}
			
		
		
		$destino = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id;
		$origem = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/edicao/galeria/" . $id;
		CopiaDir($origem, $destino);
		//--------------------------------------------------------------------
		
		
		//--------------------------------------------------------------------
		//Excluindo os registros do banco de dados para posterior substituição (paginas)
		$con = open_con();
		
		//Deletando todas as páginas do catálogo.
		$sql = "DELETE FROM cs_catalogo_paginas WHERE id_Catalogo = '$id'";
		mysqli_query($con,$sql);
		
		//Deletando todas as thumbnails do catálogo.
		$sql = "DELETE FROM cs_catalogo_pg_thumb WHERE id_Catalogo = '$id'";
		mysqli_query($con,$sql);
		
		
		mysqli_close($con);
		//--------------------------------------------------------------------
		
		//--------------------------------------------------------------------
		//Lendo os arquivos das pastas e movendo a informação para o banco
		
		//--------------------PÁGINAS----------------------
		$path = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/paginas/";
		
		$files = scandir($path);

		foreach($files as $file)
		{
			if($file != '..' && $file != '.')
			{
				$chatuba = $path . $file;
			
				$con = open_con();
				$sql = "INSERT INTO cs_catalogo_paginas (id_Catalogo, pagina) VALUES('$id', '$chatuba')";
		
				mysqli_query($con, $sql);
				mysqli_close($con);
				
			}
		}
		//--------------------//----------------------
		
		
		//--------------------THUMBNAILS----------------------
		$path = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/thumb/";
		
		$files = scandir($path);

		
		foreach($files as $file)
		{
			if($file != '..' && $file != '.')
			{
				$chatuba = $path . $file;
			
				$con = open_con();
				$sql = "INSERT INTO cs_catalogo_pg_thumb (id_Catalogo, thumb) VALUES('$id', '$chatuba')";
				
				mysqli_query($con, $sql);
				mysqli_close($con);
			
			}
		}

		//--------------------//----------------------
		
		
		//--------------------CAPA----------------------
		$path = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id . "/capa/";
		
		if ($handle = opendir($path)) 
		{

			while (false !== ($entry = readdir($handle))) 
			{
			
				if ($entry != "." && $entry != "..") 
				{
					$caminho = $path . $entry;
				
					$con = open_con();
					$sql = "UPDATE cs_catalogos SET capa = '$caminho' WHERE id = '$id'";
					
					mysqli_query($con, $sql);
					mysqli_close($con);	
				}
			}	
			closedir($handle);
		}
		
		//--------------------------------------------------------------------
		//Deletando o diret贸rio do cat谩logo temporário
		$pasta = "galeria/" . $id;
		
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
		{
			$path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		}
		rmdir($pasta);
		
		//rmdir($diretorio);
		//--------------------------------------------------------------------
	
		
		
		

?>
                            
                            
                            
                            