<?php

/**
* Classe de comunição com o banco
*/
include_once 'ConexaoBase.php';
include_once 'pontoTuristico.php';
class PontoTuristicoDAO extends ConexaoBase
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

	function __construct(argument)
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
	 * Função que insere um ponto turístico no banco de dados
	 * @param  [PontoTuristico] $pontoTuristico [description]
	 */
	function inserir($pontoTuristico){
		$sql = "insert into ponto_turistico (nome,data_nascimento,data_insercao_no_sistema,descricao,resumo,caminho_imagem_destacada,latitude,longitude,isEcologica,isReligiosa,isCulinaria,isPatrimonial,isTrilha) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$stmt = $this->conexao->prepare($sql);

		$stmt->bindParam(1, $ponto_turistico->getNome());
		$stmt->bindParam(2, $ponto_turistico->getDataDeNascimento());
		$stmt->bindParam(3, $ponto_turistico->getDataInsercaoSistema());
		$stmt->bindParam(4, $ponto_turistico->getDescricao());
		$stmt->bindParam(5, $ponto_turistico->getResumo());
		$stmt->bindParam(6, $ponto_turistico->getCaminhoDaFotoDestacada());
		$stmt->bindParam(7, $ponto_turistico->getLatitude());
		$stmt->bindParam(8, $ponto_turistico->getLongitude());
		$stmt->bindParam(9, $ponto_turistico->getIsEcologica());
		$stmt->bindParam(10, $ponto_turistico->getIsReligiosa());
		$stmt->bindParam(11, $ponto_turistico->getIsCulinaria());
		$stmt->bindParam(12, $ponto_turistico->getIsPatrimonial());
		$stmt->bindParam(13, $ponto_turistico->getIsTrilha());

		$stmt->execute();

		if($stmt->errorCode() != "00000"){
			setErroNobanco("Erro código " . $stmt->errorCode() . ": ");
			setErroNobanco(implode(", ", $stmt->errorInfo()));
			echo getErroNoBanco();
		}else{
			echo "Inserido com sucesso!";
		}
	}

	public altera(){

	}

	public busca(){
		
	}

	public getErroNoBanco(){
		return $this->erroNoBanco;
	}

	public setErroNobanco($erroNoBanco){
		$this->erroNoBanco .= $erroNoBanco;
	}
}

?>