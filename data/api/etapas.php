<?php /**
	 * Este endpoint irá retornar as etapas da eleição: os cargos a serem votados, 
     * na ordem em que eles devem ser votados.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api\etapas;

    include $_SERVER['DOCUMENT_ROOT'] . "/php/utils.php";

 	/**
	 * Envia uma query SQL à base de dados para obter as etapas.
	 */
	function get_etapas(): ?array {
        $mysqli = \utils\get_db_connection();

        $etapas = [];
        if($result = $mysqli -> query("SELECT nome AS titulo, qtd_digitos AS numeros FROM cargos ORDER BY ordem_votacao")){
           while($row = $result->fetch_assoc()) 
           { 
              $etapas[] = $row;
           }
        } else {
            throw new \mysqli_sql_exception('Unable to execute SQL query.');
        }

		$mysqli -> close();
		return $etapas;
	}


 	/**
	 * Função principal que será responsável pela funcionalidade deste endpoint.
	 */
	function main(): void{
	  try {
		  header('Content-type: application/json');
		  echo json_encode(['etapas' => get_etapas()]);
	  } catch (\mysqli_sql_exception $e) {
		  http_response_code(500);  // Internal Server Error
		  echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/html/50x.html');
		  throw $e;  // Could not access the database
	  }; 
	}

	main();
 ?> 