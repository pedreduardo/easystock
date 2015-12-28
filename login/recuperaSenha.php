<?php

	$temp = substr(md5(microtime()),1,rand(8,12)); 

	$email = 'suporte@grupoamev.com.br';
	$assunto = 'Recuperação de senha';
	$mensagem = "Você está recebendo este email pois esqueceu sua senha de acesso aos serviços da Estoque Fácil.
		     Enviamos a você uma nova senha de acesso, podendo ser modficiada ao entrar no sistema,
		     solicitando o serviço de modificação de senhas.
		     
		     Sua nova senha é: " . $temp . ".
		     
		     Maiores dúvidas, entre em contato com a Cianneto. (suporte@cianneto.com)";

	ini_set("sendmail_from", $email);
	
	$header = "From: " . $email;
	
	mail("suporte@grupoamev.com.br",$assunto, $mensagem,  $header);
	
	$array = array('senha'=>$temp); 
	echo json_encode($array);
	
?>
             
                            
                            
                            
                            