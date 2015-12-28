<?php

	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$tel = $_POST['telefone'];
	$assunto = $_POST['assunto'];
	$mensagem = $_POST['mensagem'];

	ini_set("sendmail_from", $email);
	
	$header = "From: " . $email;
	
	if(mail("oper@operimportadora.com.br",$assunto, $mensagem,  $header))
	{
		echo "Email enviado!";
	}
	
	else
	{
		echo "Falha ao enviar email.";
	}

?>
                            