<?php

/**
* Classe que irá representar os Pontos Turísticos
*/
class UsuarioAdministrativo
{
	
	private $idUsuarioAdministrativo;
	private $nome;
	private $genero;
	private $permissao;
	private $email;
	private $usuario;
	private $senha;

	function __construct($nome, $genero, $permissao, $email, $usuario, $senha)
	{
		$this->nome = $nome;
		$this->genero = $genero;
		$this->permissao = $permissao;
		$this->email = $email;
		$this->usuario = $usuario;
		$this->senha = $senha;
	}

	function getIdUsuarioAdministrativo(){
		return $this->idUsuarioAdministrativo;
	}

	function setIdUsuarioAdministrativo($idUsuarioAdministrativo){
		$this->idUsuarioAdministrativo = $idUsuarioAdministrativo;
	}

	function getNome(){
		return $this->nome;
	}

	function setNome($nome){
		$this->nome = $nome;
	}

	function getGenero(){
		return $this->genero;
	}

	function setGenero($genero){
		$this->genero = $genero;
	}

	function getPermissao(){
		return $this->permissao;
	}

	function setPermissao($permissao){
		$this->permissao = $permissao;
	}

	function getEmail(){
		return $this->email;
	}

	function setEmail($email){
		$this->email;
	}

	function getUsuario(){
		return $this->usuario;
	}

	function setUsuario($usuario){
		$this->usuario = $usuario;
	}

	function getSenha(){
		return $this->senha;
	}

	function setSenha($senha){
		$this->senha = $senha;
	}
}

?>