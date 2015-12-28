<?php
	session_start();
	include_once 'classUsuarioDAO.php';
	$usuario = new UsuarioDAO;

	$usuario->logout();

?>