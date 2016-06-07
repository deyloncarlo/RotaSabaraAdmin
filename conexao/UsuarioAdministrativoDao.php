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
	
	// Na função bindParam das execuções do banco de dados, só é possivel passar variáveis por parâmetro e não funções.
	public $idUsuarioAdministrativo;
	public $nome;
	public $genero;
	public $permissao;
	public $email;
	public $usuario;
	public $senha;

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

	}

	/**
	 * Função que insere um usuário adimnistrativo no banco de dados.
	 * @param  [UsuarioAdministrativo] $usuarioAdministrativo [description]
	 */
	function inserir($usuarioAdministrativo){

		// Setando as variáveis
		$this->nome = $usuarioAdministrativo->getNome();
		$this->genero = $usuarioAdministrativo->getGenero();
		$this->permissao = $usuarioAdministrativo->getPermissao();
		$this->email = $usuarioAdministrativo->getEmail();
		$this->usuario = $usuarioAdministrativo->getUsuario();
		$this->senha = $usuarioAdministrativo->getSenha();

		$sql = "insert into usuario_administrativo (nome,genero,permissao,email,usuario,senha) values (?,?,?,?,?,?)";

		$stmt = $this->conexao->prepare($sql);

		$stmt->bindParam(1, $this->nome);
		$stmt->bindParam(2, $this->genero);
		$stmt->bindParam(3, $this->permissao);
		$stmt->bindParam(4, $this->email);
		$stmt->bindParam(5, $this->usuario);
		$stmt->bindParam(6, $this->senha);
			
		$stmt->execute();

		if($stmt->errorCode() != "00000"){
			$this->setErroNoBanco("Erro código " . $stmt->errorCode() . ": ");
			$this->setErroNoBanco(implode(", ", $stmt->errorInfo()));
			echo $this->getErroNoBanco();
		}else{
			echo "Inserido com sucesso!";
		}

	}

	function getErroNoBanco(){
		return $this->erroNoBanco;
	}

	function setErroNoBanco($erroNoBanco){
		$this->erroNoBanco .= $erroNoBanco;
	}
	
}

?>