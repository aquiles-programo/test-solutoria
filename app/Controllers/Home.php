<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data['indicadores'] = ['uf', 'ivp', 'dolar', 'dolar_intercambio', 'euro', 'ipc', 'utm', 'imacec', 'tpm', 'libra_cobre', 'tasa_desempleo', 'bitcoin'];
		return view('home', $data);
	}

	public function crud()
	{
		$historicoModel = model('App\Models\HistoricoModel');
		$ufModel = model('App\Models\UfModel');

		$registrosUf = $historicoModel->getRegistrosUf();
		$datosUf = $ufModel->getDatosUf();

		return view('administrar_uf', ['registrosUf' => $registrosUf, 'datosUf' => $datosUf]);
	}

	public function actualizarHistoricos()
	{
		$apiUrl = 'https://mindicador.cl/api/' . $_POST['indicador'] . '/2020';

		if (ini_get('allow_url_fopen')) {
			$json = file_get_contents($apiUrl);
		} else {
			//De otra forma utilizamos cURL
			$curl = curl_init($apiUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($curl);
			curl_close($curl);
		}

		$dailyIndicators = json_decode($json);

		$historicoModel = model('App\Models\HistoricoModel');
		$historicoModel->actualizarHistoricos($dailyIndicators);
	}

	public function actualizarRegistro()
	{
		$historicoModel = model('App\Models\HistoricoModel');
		$historicoModel->actualizarRegistro($_POST['idRegistro'], $_POST['valorRegistro'], $_POST['fechaRegistro']);
	}

	public function eliminarRegistro()
	{
		$historicoModel = model('App\Models\HistoricoModel');
		$historicoModel->eliminarRegistro($_POST['idRegistro']);
	}

	public function ingresarRegistro()
	{
		$historicoModel = model('App\Models\HistoricoModel');
		$historicoModel->ingresarRegistro($_POST['valorRegistro'], $_POST['fechaRegistro']);
	}



	//--------------------------------------------------------------------

}
