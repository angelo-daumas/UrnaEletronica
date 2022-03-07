<?php /**
	 * Este endpoint irá retornar todos os endpoints disponíveis na forma de um JSON.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api;

 	/**
	 * Função principal que será responsável pela funcionalidade deste endpoint.
	 */
	function main(): void{
        header('Content-type: application/json');
        echo json_encode(['endpoints' => ['index.php', 'candidatos.php', 'etapas.php']]);
	}

	main();
 ?> 