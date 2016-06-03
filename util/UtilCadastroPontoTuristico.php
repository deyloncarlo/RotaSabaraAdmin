<?php

/**
* Classe que irá possuir métodos para a tela Cadastro de PontosTuristicos
*/
class UtilCadastroPontoTuristico
{
	
	function __construct(argument)
	{
		
	}

	public function isAlgumCampoNulo($errosUsuario,$nome,$dataNascimento,$descricao,$resumo,$latitude,$longitude,$vetorTipoRota): String{

		if(isset($nome) == false){
			$errosUsuario .= "Campo de Nome está vazio!";
		}
		if (isset($dataNascimento) == false) {
			$errosUsuario .= "Campo de Data Nascimento está vazio!";
		}
		if (isset($descricao)) {
			$errosUsuario .= "Campo Descrição está vazio!";
		}
		if (isset($resumo)) {
			$errosUsuario .= "Campo Resumo está vazio!";
		}
		if (isset($latitude)) {
			$errosUsuario .= "Campo Latitude está vazio!";
		}
		if (isset($longitude)) {
			$errosUsuario .= "Campo Longitude está vazio!";
		}
		if(in_array(1,$vetorTipoRota) == false){
			$errosUsuario .= "Selecione uma das Classificações!";
		}

		return $errosUsuario;
	}
}

?>