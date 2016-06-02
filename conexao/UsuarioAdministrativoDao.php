<?php


/**
* Classe de comunição com o banco da entidade UsuárioAdministrativo
*/
include_once 'ConexaoBase.php';
include_once '\entidades\UsuarioAdministrativo.php';

class UsuarioAdministrativoDao extends ConexaoBase
{
	
	private $informacao;
	private $conexao;

	function __construct()
	{
		$informacao = new ConexaoBase();

		try{
				$this->conexao = new PDO($informacao->getBanco() . ":host=" . $informacao->getHost() . ";dbname=" . $informacao->getNomeBanco(), $informacao->getUsuario(), $informacao->getSenha());
				$this->conexao->exec("set names utf8");	
			}
			catch(PDOException $e){
				echo "Errro ao conectar com o banco: " . $e->getMessage();
				exit();
			}
			$informacao = new ConexaoBase();

	}

	function inserir($usuarioAdministrativo){

		$sql = "insert into usuario_administrativo (nome,genero,permissao,email,usuario,senha) values (?,?,?,?,?,?)";

		$nome = $usuarioAdministrativo->getNome();
		$genero = $usuarioAdministrativo->getGenero();
		$permissao = $usuarioAdministrativo->getPermissao();
		$email = $usuarioAdministrativo->getEmail();
		$usuario = $usuarioAdministrativo->getUsuario();
		$senha = $usuarioAdministrativo->getSenha();

		$stmt = $this->conexao->prepare($sql);

		$stmt->bindParam(1, $nome);
		$stmt->bindParam(2, $genero);
		$stmt->bindParam(3, $permissao);
		$stmt->bindParam(4, $email);
		$stmt->bindParam(5, $usuario);
		$stmt->bindParam(6, $senha);
			
		$stmt->execute();

		if($stmt->errorCode() != "00000"){
			$erroNoBanco = "Erro código " . $stmt->errorCode() . ": ";
			$erroNoBanco .= implode(", ", $stmt->errorInfo());
			echo $erroNoBanco;
		}else{
			echo "Inserido com sucesso!";
		}

	}
}






?>