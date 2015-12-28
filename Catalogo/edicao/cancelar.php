<?php


		$id = $_POST['id'];

		//--------------------------------------------------------------------
		//Deletando o diretÃ³rio do catÃ¡logo tempor¨¢rio
		$pasta = "galeria/" . $id;
		
		foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pasta, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path)
		{
			$path->isDir() ? rmdir($path->getPathname()) : unlink($path->getPathname());
		}
		rmdir($pasta);
		
		//rmdir($diretorio);
		//--------------------------------------------------------------------





?>