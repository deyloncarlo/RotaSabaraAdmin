<?php
	/**
	* Classe base de conexão
	*/
	class ConexaoBase
	{

		private $banco = "mysql";
		private $host = "localhost";
		private $nomeBanco = "rota_sabara";
		private $usuario = "root";
		private $senha = "";

		function __construct()
		{

		}

		function getConexao(){
			return $this->conexao;
		}

		function setConexao($conexao){
			$this->conexao = $conexao;
		}

		function getBanco(){
			return $this->banco;
		}

		function setBanco($banco){
			$this->banco = $banco;
		}

		function getHost(){
			return $this->host;
		}

		function setHost($host){
			$this->host = $host;
		}

		function getNomeBanco(){
			return $this->nomeBanco;
		}

		function setNomeBanco($nomeBanco){
			$this->nomeBanco = $nomeBanco;
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