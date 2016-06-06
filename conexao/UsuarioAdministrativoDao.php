<?php


/**
* Classe de comunição com o banco da entidade UsuárioAdministrativo
*/
include_once 'ConexaoBase.php';
include_once '\entidades\UsuarioAdministrativo.php';

class UsuarioAdministrativoDao extends ConexaoBase
{
	
	/**
	 * $informacao
	 * Variável que contém informações da classe ConexaoBase
	 * @var [type]
	 */
	private $informacao;

	/**
	 * $conexao
	 * Varável que estabelece a conexão com o banco.
	 * @var [PDO]
	 */
	private $conexao;

	/**
	 * $erroNoBanco
	 * Erros que ocorre durante as operações do banco
	 * @var [String]
	 */
	private $erroNoBanco;

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

	/**
	 * Função que insere um usuário adimnistrativo no banco de dados.
	 * @param  [UsuarioAdministrativo] $usuarioAdministrativo [description]
	 */
	function inserir($usuarioAdministrativo){

		$sql = "insert into usuario_administrativo (nome,genero,permissao,email,usuario,senha) values (?,?,?,?,?,?)";

		$stmt = $this->conexao->prepare($sql);

		$stmt->bindParam(1, $usuarioAdministrativo->getNome());
		$stmt->bindParam(2, $usuarioAdministrativo->getGenero());
		$stmt->bindParam(3, $$usuarioAdministrativo->getPermissao());
		$stmt->bindParam(4, $usuarioAdministrativo->getEmail());
		$stmt->bindParam(5, $usuarioAdministrativo->getUsuario());
		$stmt->bindParam(6, $usuarioAdministrativo->getSenha());
			
		$stmt->execute();

		if($stmt->errorCode() != "00000"){
			setErroNobanco("Erro código " . $stmt->errorCode() . ": ");
			setErroNobanco(implode(", ", $stmt->errorInfo()));
			echo getErroNoBanco();
		}else{
			echo "Inserido com sucesso!";
		}

	}

	public getErroNoBanco(){
		return $this->erroNoBanco;
	}

	public setErroNobanco($erroNoBanco){
		$this->erroNoBanco .= $erroNoBanco;
	}
	
}

?>