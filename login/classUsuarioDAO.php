                                                                                                                                                                                                                                                                <?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/settings/config.php');
class UsuarioDAO
{

	//----------------------------------------------------------------------------------------------------------------------------
	//Atributos da classe

	private $nomeCompleto_; // Informações do usuário
    private $loginUsuario_; // Nome do usuário para login
    private $senhaUsuario_; // tenta usar criptografia na senha. Se não me engano tem tenta usar aquele "md5" que ja faz isso automatico
    private $dataCriacao_; // data da criação da conta
    private $ultimoLogin_; // Data do ultimo login
	private $DAO_;
	
	//----------------------------------------------------------------------------------------------------------------------------
	//GETS and SETS

	public function getNomeCompleto()
	{
		return $this->nomeCompleto_;
	}
	
	public function setNomeCompleto($nome)
	{
		$this->nomeCompleto_ = $nome;
	}
	
	public function getLogin()
	{
		return $this->loginUsuario_;
	}
	
	public function setLogin($login)
	{
		$this->loginUsuario_ = $login;
	}
	
	public function getSenha()
	{
		return $this->senhaUsuario_;
	}
	
	public function setSenha($senha)
	{
		$this->senhaUsuario_ = $senha;
	}
	
	public function getDataCriacao()
	{
		return $this->dataCriacao_;
	}
	
	public function setDataCriacao($data)
	{
		$this->dataCriacao_ = $data;
	}
	
	public function getUltimoLogin()
	{
		return $this->ultimoLogin_;
	}
	
	public function setUltimoLogin($data)
	{
		$this->ultimoLogin_ =  $data;
	}


	//----------------------------------------------------------------------------------------------------------------------------
	//Métodos da classe

	//--------------------------------------------------------------
	//Verificar se usuário já existe no banco. 
	//Verificação feita ao criar um novo usuário.
	public function usuarioExiste()
	{
		$login = $this->getLogin();
		
		$con = open_con();
		
		$sql = "SELECT * from cs_usuario WHERE login = '$login'";
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
		if ($row > 0) 
		{
			echo "Nome de usuário já em uso.";
			mysqli_close($con);
			return true;
		}
		else
		{
			mysqli_close($con);
			return false;
		}
	}

	//--------------------------------------------------------------
	//Inserindo um novo usuário na tabela cs_usuario
	public function insereUsuario()
	{
	
		if(!$this->usuarioExiste($this->getLogin()))
		{
			$con = open_con();
			
			$senha_md5 = md5($this->getSenha());
			echo $senha_md5 . "<br>";
			$nome = $this->getNomeCompleto();
			$login = $this->getLogin();
			
			
			$sql="INSERT INTO cs_usuario (nomeCompleto, login, senha, dataCriacao)
				 VALUES ('$nome', '$login', '$senha_md5', NOW())";	
				 
			if (!mysqli_query($con,$sql)) 
			{
				die('Error: ' . mysqli_error($con));
			}	
			echo "Inserido com sucesso!";
			
			mysqli_close($con);
		}
	}
	
	//--------------------------------------------------------------
	//LOGIN de usuário
	//Verificar anteriormente se o usuário está logado.
	public function login ()
	{
		$con = open_con();
		
		$login = $this->getLogin();
        $senha = $this->getSenha();
		$senha_md5 = md5($this->getSenha());
		 

		$sql = "SELECT * from cs_usuario WHERE login = '$login' AND senha = '$senha_md5'";
		
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
		if ($row < 1) 
		{
			session_unset();
			$array = array('retorno'=>false); 
			echo json_encode($array);
			
			
		}
		else
		{
			session_start();
			$_SESSION["login"] = $login;
			$_SESSION["senha"] = $senha_md5;
			
			setcookie('usuario', $login, time()+3600); //Cookie válido para até 1h.
			$cookie = $_COOKIE['usuario'];
			
			mysqli_close($con);
			$array = array('retorno'=>true); 
			echo json_encode($array);
		}
	}
	
	//--------------------------------------------------------------
	//Verificando se o usuário está logado.
	public function estaLogado()
	{
		if((isset($_SESSION['login']) && $_SESSION['login'] != '') || (isset($_COOKIE['usuario']) && $_COOKIE['usuario'] != '')) 
		{
			return true;
		} 
		else
		{
			return false;
		}
	}
	
	//--------------------------------------------------------------
	//Logout de usuário
	public function logout()
	{
		if($this->estaLogado())
		{
			$login = $_SESSION['login'];
			
			$con = open_con();
			
			//finalizando sessão
			session_unset();
			
			//finalizando cookies
			if(isset($_COOKIE['usuario'])) 
			{
				unset($_COOKIE['usuario']);
				setcookie('usuario', '', time() - 3600); // empty value and old timestamp
			}
						
			mysqli_close($con);
		}
	}	
	
	//--------------------------------------------------------------
	//Fazendo Update no usuário
	//Verificar anteriormente se o usuário está logado.
	public function updateSenha()
	{
		session_start();
		$con = open_con();
		
		$senha = $this->getSenha();
		
		$senha_md5 = md5($senha);
	
	
			$sql = "UPDATE cs_usuario SET senha = '$senha_md5' WHERE login = 'master'";
			if(mysqli_query($con,$sql))
			{
				return true;
			}
			else
			{
				return false;
			}
			
			mysql_close($con);
			

	
	}
	
	//--------------------------------------------------------------
	//Excluindo um usuário
	//Verificar anteriormente se o usuário está logado.
	public function deletaUsuario()
	{
		if(estaLogado())
		{
			$con = open_con();
			$sql = "DELETE FROM cs_usuario where login = '$login'";
			echo "Deletado com sucesso.";
		}
	}
	
}
?>
                            
                            
                            
                            
                            
                            
                            
                            