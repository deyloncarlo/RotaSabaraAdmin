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

		public getIdPontoTuristico(){
			return $this->idPontoTuristico;
		}

		public setIdPontoTuristico($idPontoTuristico){
			$this->idPontoTuristico = $idPontoTuristico
		}

		public getNome(){
			return $this->nome;
		}

		public setNome($nome){
			$this->nome = $nome;
		}

		public getDataDeNascimento(){
			return $this->dataDeNascimento;
		}

		public setDataDeNascimento($dataDeNascimento){
			$this->dataDeNascimento = $dataDeNascimento;
		}

		public getDataInsercaoSistema(){
			return $this->dataInsercaoSistema;
		}

		public setDataInsercaoSiste($dataInsercaoSistema){
			$this->dataInsercaoSistema = $dataInsercaoSistema;
		}

		public getDescricao(){
			return $this->descricao;
		}

		public setDescricao($descricao){
			$this->descricao = $descricao;
		}

		public getResumo(){
			return $this->resumo;
		}
		
		public setResumo($resumo){
			$this->resumo = $resumo;
		}		

		public getCaminhoDaFotoDestacada(){
			return $this->caminhoDaFotoDestacada;
		}

		public setCaminhoDaFotoDestacada($caminhoDaFotoDestacada){
			$this->caminhoDaFotoDestacada = $caminhoDaFotoDestacada;
		}

		public getLatitude(){
			return $this->latitude;
		}

		public setLatitude($latitude){
			$this->latitude;
		}

		public getLongitude(){
			return $this->longitude;
		}

		public setLongitude($longitude){
			$this->longitude = $longitude;
		}

		public getIsEcologica(){
			return $this->isEcologica;
		}

		public setIsEcologica($isEcologica){
			$this->isEcologica = $isEcologica;
		}

		public getIsReligiosa(){
			return $this->isReligiosa;
		}

		public setIsReligiosa($isReligiosa){
			$this->isReligiosa = $isReligiosa
		}

		public getIsGastronomica(){
			return $this->isGastronomica;
		}

		public setIsGastronomica($isGastronomica){
			$this->isGastronomica = $isGastronomica;
		}

		public getIsPatrimonial(){
			return $this->isPatrimonial; 
		}

		public setIsPatrimonial($isPatrimonial){
			$this->isPatrimonial = $isPatrimonial;
		}

		public getIsTrilha(){
			return $this->isTrilha;
		}

		public setIsTrilha($isTrilha){
			$this->isTrilha = $isTrilha; 
		}

	}

?>