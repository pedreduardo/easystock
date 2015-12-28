                                <?php 

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('classes/classCatalogoDAO.php');
	
	$catalogo = new CatalogoDAO;

	$id = $catalogo->insereCatalogo();
	$id = (int)$id;
	
	$array = array ('id'=>$id); 
	
	echo json_encode($array);
	//echo $id;
	
	//---------------------------------------------
	//Criação de pastas
	
	//Criando a pasta do catálogo
	$old_umask = umask(0);
	mkdir("galeria/".$id, 0777, true);
	umask($old_umask);
	
	//Criando a pasta do das páginas
	$old_umask = umask(0);
	mkdir("galeria/" . $id . "/paginas", 0777, true);
	umask($old_umask);
	
	//Criando a pasta dos thumbnails das páginas
	$old_umask = umask(0);
	mkdir("galeria/" . $id . "/thumb", 0777, true);
	umask($old_umask);
	
	//Criando a pasta da capa
	$old_umask = umask(0);
	mkdir("galeria/" . $id . "/capa", 0777, true);
	umask($old_umask);
	//---------------------------------------------

?>
                            