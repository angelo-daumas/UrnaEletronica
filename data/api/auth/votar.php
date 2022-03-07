<?php /**
	 * Este endpoint irá receber um query string com o cargo e o código do candidato,
	 * depois irá realizar a votação nesse candidato usando uma conuslta SQL ao banco.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api\auth\vote;

	include $_SERVER['DOCUMENT_ROOT'] . "/php/utils.php";

 	/**
	 * @param $cargo
	 *  O cargo para o qual está se candidatando.
	 * @param $codigo
	 *  O código do candidato.
	 */
	function votar_em_candidato(string $cargo, int $codigo): void {
		$mysqli = \utils\get_db_connection();

		$stmt = $mysqli -> prepare("UPDATE candidatos SET qtd_votos = qtd_votos + 1 WHERE (cargo, codigo) = (?, ?)");
		$stmt->bind_param('si', $cargo, $codigo);
		if (!$stmt->execute()) {
			$mysqli -> close();
			throw new \mysqli_sql_exception('Unable to execute SQL query.');
		}
	}


 	/**
	 * Função principal que será responsável pela funcionalidade deste endpoint.
	 */
	function main(): void{
		$query_str =  $_SERVER['QUERY_STRING'];
		parse_str($query_str, $query);
  
	  try {
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            votar_em_candidato($query['cargo'], intval($query['codigo']));
            echo 'Sucesso!';
	  } catch (\mysqli_sql_exception $e) {
            http_response_code(500);  // Internal Server Error
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/html/50x.html');
            throw $e;  // Could not access the database
	  }; 
	}

	main();
 ?> 