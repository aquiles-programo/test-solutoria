$(document).ready(function () {
	const indicadoresEconomicos = [
		'uf',
		'ivp',
		'dolar',
		'dolar_intercambio',
		'euro',
		'ipc',
		'utm',
		'imacec',
		'tpm',
		'libra_cobre',
		'tasa_desempleo',
		'bitcoin',
	]
	indicadoresEconomicos.forEach((element) => {
		cargar_grafico(element)
	})
})

async function cargar_grafico(indicador) {
	const canvas = document.getElementById(`canvas-${indicador}`)
	const historicos_indicador = await $.get(
		`https://mindicador.cl/api/${indicador}`
	)
	const ctx = canvas.getContext('2d')
	const myChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: historicos_indicador.serie.map((e) => e.fecha.substr(0, 10)),
			datasets: [
				{
					label: 'Valor',
					data: historicos_indicador.serie.map((e) => e.valor),
          borderWidth: 1,
          backgroundColor: ["rgba(255, 99, 132, 0.2)"]
				},
			],
		},
		options: {
			scales: {
				yAxes: [
					{
						ticks: {
							beginAtZero: true,
							min: Math.min(...historicos_indicador.serie.map((e) => e.valor)),
						},
					},
				],
			},
		},
	})
}
