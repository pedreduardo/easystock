<?php
function open_con()
{
	// Setando as configuracoes de conexao do banco de dados
	$host="cianneto.com";
	$port=3306;
	$socket="";
	$user="cianneto_estoque";
	$password="cianneto123*";
	$dbname="cianneto_estoqueFacil";
	
	// Conectando ao servidor
	$con = mysqli_connect($host, $user, $password);
	mysqli_select_db($con, $dbname) or die ("Não foi possível conectar ao banco de dados.");
	mysqli_query($con, "SET NAMES 'utf8'");
        mysqli_query($con, 'SET character_set_connection=utf8');
        mysqli_query($con, 'SET character_set_client=utf8');
        mysqli_query($con, 'SET character_set_results=utf8');
	
	if (!$con)
	{
		echo "Não foi possível conectar ao banco de dados.";
	};
	
	return $con;
	//$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	//	or die ('Atenção!!! Não foi possivel conectar ao servidor de dados.' . mysqli_connect_error());
	
	// Retornando a conexao
}

/** -----------------------------------------------------------------  
 *  Usado para fechar a conexao
 * @param $con = variavel de conexão;
 * @return void
 ----------------------------------------------------------------- */
function close_con($con)
{
	// Fechando a conexao
	mysqli_close($con);
}

 /** -----------------------------------------------------------------  
 *  Usado para abrir a conexao com o banco de dados, realizando a autenticacao no servidor
 * @return $con (arquivo de conexão)
 ----------------------------------------------------------------- */
function open_con_repor()
{
	// Setando as configuracoes de conexao do banco de dados
	$host="127.0.0.1";
	$port=3306;
	$socket="";
	$user="cianneto_repor";
	$password="UcLBTwf.Ry10";
	$dbname="cianneto_repor";
	
	// Conectando ao servidor
	$con = mysqli_connect($host, $user, $password);
	mysqli_select_db($con, $dbname) or die ("Não foi possível conectar ao banco de dados.");
	mysqli_query($con, "SET NAMES 'utf8'");
        mysqli_query($con, 'SET character_set_connection=utf8');
        mysqli_query($con, 'SET character_set_client=utf8');
        mysqli_query($con, 'SET character_set_results=utf8');
	
	if (!$con)
	{
		echo "Não foi possível conectar ao banco de dados.";
	};
	
	return $con;
	//$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	//	or die ('Atenção!!! Não foi possivel conectar ao servidor de dados.' . mysqli_connect_error());
	
	// Retornando a conexao
}

?>