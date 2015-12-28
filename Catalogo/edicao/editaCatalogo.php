<?php 
	
	$id = $_POST['id'];
	//---------------------------------------------
	//Copiando toda a informação da pasta referente ao id do catalogo.
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
	//---------------------------------------------

	$origem = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/galeria/" . $id;
	$destino = $_SERVER['DOCUMENT_ROOT'] . "/Catalogo/edicao/galeria/" . $id;
	
	CopiaDir($origem, $destino);


?>