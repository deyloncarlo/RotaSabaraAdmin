<?php

	/**
	* Classe que irá representar os Pontos Turísticos
	*/
	class PontoTuristico
	{
		private $idPontoTuristico;
		private $nome;
		private $dataDeNascimento;
		private $dataInsercaoSistema;
		private $descricao;
		private $resumo;
		private $caminhoDaFotoDestacada;
		private $latitude;
		private $longitude;
		private $isEcologica;
		private $isReligiosa;
		private $isGastronomica;
		private $isPatrimonial;
		private $isTrilha;


		function __construct($nome, $dataDeNascimento, $dataInsercaoSistema, $descricao, $resumo, $caminhoDaFotoDestacada, $latitude, $longitude, $isEcologica, $isReligiosa, $isGastronomica, $isPatrimonial, $isTrilha)
		{
			$this->nome = $nome;
			$this->dataDeNascimento = $dataDeNascimento;
			$this->dataInsercaoSistema = $dataInsercaoSistema;
			$this->descricao = $descricao;
			$this->resumo = $resumo;
			$this->caminhoDaFotoDestacada = $caminhoDaFotoDestacada;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->isEcologica = $isEcologica;
			$this->isReligiosa = $isReligiosa;
			$this->isGastronomica = $isGastronomica;
			$this->isPatrimonial = $isPatrimonial;
			$this->isTrilha = $isTrilha;
		}

		function getIdPontoTuristico(){
			return $this->idPontoTuristico;
		}

		function setIdPontoTuristico($idPontoTuristico){
			$this->idPontoTuristico = $idPontoTuristico;
		}

		function getNome(){
			return $this->nome;
		}

		function setNome($nome){
			$this->nome = $nome;
		}

		function getDataDeNascimento(){
			return $this->dataDeNascimento;
		}

		function setDataDeNascimento($dataDeNascimento){
			$this->dataDeNascimento = $dataDeNascimento;
		}

		function getDataInsercaoSistema(){
			return $this->dataInsercaoSistema;
		}

		function setDataInsercaoSiste($dataInsercaoSistema){
			$this->dataInsercaoSistema = $dataInsercaoSistema;
		}

		function getDescricao(){
			return $this->descricao;
		}

		function setDescricao($descricao){
			$this->descricao = $descricao;
		}

		function getResumo(){
			return $this->resumo;
		}
		
		function setResumo($resumo){
			$this->resumo = $resumo;
		}		

		function getCaminhoDaFotoDestacada(){
			return $this->caminhoDaFotoDestacada;
		}

		function setCaminhoDaFotoDestacada($caminhoDaFotoDestacada){
			$this->caminhoDaFotoDestacada = $caminhoDaFotoDestacada;
		}

		function getLatitude(){
			return $this->latitude;
		}

		function setLatitude($latitude){
			$this->latitude;
		}

		function getLongitude(){
			return $this->longitude;
		}

		function setLongitude($longitude){
			$this->longitude = $longitude;
		}

		function getIsEcologica(){
			return $this->isEcologica;
		}

		function setIsEcologica($isEcologica){
			$this->isEcologica = $isEcologica;
		}

		function getIsReligiosa(){
			return $this->isReligiosa;
		}

		function setIsReligiosa($isReligiosa){
			$this->isReligiosa = $isReligiosa;
		}

		function getIsGastronomica(){
			return $this->isGastronomica;
		}

		function setIsGastronomica($isGastronomica){
			$this->isGastronomica = $isGastronomica;
		}

		function getIsPatrimonial(){
			return $this->isPatrimonial; 
		}

		function setIsPatrimonial($isPatrimonial){
			$this->isPatrimonial = $isPatrimonial;
		}

		function getIsTrilha(){
			return $this->isTrilha;
		}

		function setIsTrilha($isTrilha){
			$this->isTrilha = $isTrilha; 
		}

	}

?>