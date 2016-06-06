<?php

/**
* Classe que irá possuir métodos para a tela Cadastro de PontosTuristicos
*/
class UtilCadastroPontoTuristico
{
	
	public static function isAlgumCampoNulo($erroUsuario,$nome,$dataNascimento,$descricao,$resumo,$latitude,$longitude,$vetorTipoRota){
		
		if(empty($nome) == true){
			$erroUsuario .= "Campo de Nome está vazio!";
		}
		if (empty($dataNascimento) == true) {
			$erroUsuario .= "Campo de Data Nascimento está vazio!";
		}
		if (empty($descricao) == true) {
			$erroUsuario .= "Campo Descrição está vazio!";
		}
		if (empty($resumo) ==  true) {
			$erroUsuario .= "Campo Resumo está vazio!";
		}
		if (empty($latitude) == true) {
			$erroUsuario .= "Campo Latitude está vazio!";
		}
		if (empty($longitude) == true) {
			$erroUsuario .= "Campo Longitude está vazio!";
		}
		if(in_array(true,$vetorTipoRota) == false){
			$erroUsuario .= "Selecione uma das Classificações!";
		}

		return $erroUsuario;
	}
}

?>