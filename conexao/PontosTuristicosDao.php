<?php

/**
* Classe de comunição com o banco
*/
include_once 'ConexaoBase.php';
include_once 'entidades/pontoTuristico.php';

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

	// Na função bindParam das execuções do banco de dados, só é possivel passar variáveis por parâmetro e não funções.
	public $idPontoTuristico;
	public $nome;
	public $dataDeNascimento;
	public $dataInsercaoSistema;
	public $descricao;
	public $resumo;
	public $caminhoDaFotoDestacada;
	public $latitude;
	public $longitude;
	public $isEcologica;
	public $isReligiosa;
	public $isGastronomica;
	public $isPatrimonial;
	public $isTrilha;

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
	 * Função que insere um ponto turístico no banco de dados
	 * @param  [PontoTuristico] $pontoTuristico [description]
	 */
	function inserir($pontoTuristico){

		// Setando as variáveis
		$this->nome = $pontoTuristico->getNome();
		$this->dataDeNascimento = $pontoTuristico->getDataDeNascimento();
		$this->dataInsercaoSistema = $pontoTuristico->getDataInsercaoSistema();
		$this->descricao = $pontoTuristico->getDescricao();
		$this->resumo = $pontoTuristico->getResumo();
		$this->caminhoDaFotoDestacada = $pontoTuristico->getCaminhoDaFotoDestacada();
		$this->latitude = $pontoTuristico->getLatitude();
		$this->longitude = $pontoTuristico->getLongitude();
		$this->isEcologica = $pontoTuristico->getIsEcologica();
		$this->isReligiosa = $pontoTuristico->getIsReligiosa();
		$this->isGastronomica = $pontoTuristico->getIsGastronomica();
		$this->isPatrimonial = $pontoTuristico->getIsPatrimonial();
		$this->isTrilha = $pontoTuristico->getIsTrilha();
		
		$sql = "insert into ponto_turistico (nome,data_nascimento,data_insercao_no_sistema,descricao,resumo,caminho_imagem_destacada,latitude,longitude,isEcologica,isReligiosa,isCulinaria,isPatrimonial,isTrilha) values (?,?,?,?,?,?,?,?,?,?,?,?,?)";

		$stmt = $this->conexao->prepare($sql);

		$stmt->bindParam(1, $this->nome);
		$stmt->bindParam(2, $this->dataInsercaoSistema);
		$stmt->bindParam(3, $this->dataInsercaoSistema);
		$stmt->bindParam(4, $this->descricao);
		$stmt->bindParam(5, $this->resumo);
		$stmt->bindParam(6, $this->caminhoDaFotoDestacada);
		$stmt->bindParam(7, $this->latitude);
		$stmt->bindParam(8, $this->longitude);
		$stmt->bindParam(9, $this->isEcologica);
		$stmt->bindParam(10, $this->isReligiosa);
		$stmt->bindParam(11, $this->isGastronomica);
		$stmt->bindParam(12, $this->isPatrimonial);
		$stmt->bindParam(13, $this->isTrilha);

		$stmt->execute();

		if($stmt->errorCode() != "00000"){
			setErroNobanco("Erro código " . $stmt->errorCode() . ": ");
			setErroNobanco(implode(", ", $stmt->errorInfo()));
			echo getErroNoBanco();
		}
	}

	/**
	 * Função que irá buscar os pontos turísticos do banco ou pelo nome ou pelas suas classificações. Função utilizada pela tela
	 * @return [Array] [retorna um vetor de Pontos Turísticos]
	 */
	function buscar($p_sql){
		$resultSet = $this->conexao->prepare($p_sql);

		$resultadoExecucao = $resultSet->execute();

		$vetorPontosTuristicos = array();

		if($resultadoExecucao == true){
			while( $pontoTuristico = $resultSet->fetch(PDO::FETCH_OBJ) ){
					
				array_push($vetorPontosTuristicos, $pontoTuristico);			
			}

			return $vetorPontosTuristicos;
		}
		else{
			echo "Falha na busca dos pontos turísticos <br>";

			return false;
		}
	}

	function getErroNoBanco(){
		return $this->erroNoBanco;
	}

	function setErroNobanco($erroNoBanco){
		$this->erroNoBanco .= $erroNoBanco;
	}
}

?>