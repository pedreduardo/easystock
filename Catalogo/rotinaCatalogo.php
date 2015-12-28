                                <?php

	include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
	include_once('classes/classCatalogoDAO.php');

	$catalogo = new CatalogoDAO;

	$con = open_con();
	
	$sql = "SELECT * from cs_catalogos WHERE capa IS NULL";
	$result = mysqli_query($con, $sql);

	
		while($r = mysqli_fetch_array($result))
		{
			$catalogo->deletaCatalogo($r['id']);	
			
		}
	

?>
                            