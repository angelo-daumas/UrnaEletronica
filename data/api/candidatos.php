<?php /**
	 * Este endpoint irá receber um query string com o cargo e o código do candidato,
	 * retornando como JSON os dados do candidato encontrados no banco de dados.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api\candidatos;

	include $_SERVER['DOCUMENT_ROOT'] . "/php/utils.php";

 	/**
	 * @param $cargo
	 *  O cargo para o qual está se candidatando como vice.
	 * @param $codigo
	 *  O código do candidato desse vice.
	 * @retval array
	 *  Dados do vice-candidato com as colunas do banco de dados.
	 */
	function get_vice(string $cargo, int $codigo): ?array {
		$mysqli = \utils\get_db_connection();

		$stmt = $mysqli -> prepare("SELECT nome, partido FROM vices WHERE (cargo, codigo) = (?, ?)");
		$stmt->bind_param('si', $cargo, $codigo);
		if (!$stmt->execute()) {
			$mysqli -> close();
			throw new \mysqli_sql_exception('Unable to execute SQL query.');
		}

		$result = $stmt->get_result();
		# Precisamos ter certeza que apenas um candidato é retornado.
		if ($result -> num_rows == 1) {
			$vice = $result->fetch_assoc();
		} else { 
			$vice = null;
		};

		$mysqli -> close();
		return $vice;
	}

 	/**
	 * @param $cargo
	 *  O cargo para o qual está se candidatando.
	 * @param $codigo
	 *  O código do candidato.
	 * @retval array
	 *  Dados do candidato com as colunas do banco de dados.
	 */
	function get_candidato(string $cargo, int $codigo): ?array {
		$mysqli = \utils\get_db_connection();

		$stmt = $mysqli -> prepare("SELECT * FROM candidatos WHERE (cargo, codigo) = (?, ?)");
		$stmt->bind_param('si', $cargo, $codigo);
		if (!$stmt->execute()) {
			$mysqli -> close();
			throw new \mysqli_sql_exception('Unable to execute SQL query.');
		}

		$result = $stmt->get_result();
		# Precisamos ter certeza que apenas um candidato é retornado.
		if ($result -> num_rows == 1) {
			$candidato = $result->fetch_assoc();
			$candidato['vice'] = get_vice($cargo, $codigo);
		} else { 
			$candidato = null;
		};

		$mysqli -> close();
		return $candidato;
	}


 	/**
	 * Função principal que será responsável pela funcionalidade deste endpoint.
	 */
	function main(): void{
		$query_str =  $_SERVER['QUERY_STRING'];
		parse_str($query_str, $query);
  
	  try {
		  header('Content-type: application/json');
		  echo json_encode(['candidato' => get_candidato($query['cargo'], intval($query['codigo']))]);
	  } catch (\mysqli_sql_exception $e) {
		  http_response_code(500);  // Internal Server Error
		  echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/html/50x.html');
		  throw $e;  // Could not access the database
	  }; 
	}

	main();
 ?> 