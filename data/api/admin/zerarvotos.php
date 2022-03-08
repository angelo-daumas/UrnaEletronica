<?php /**
	 * Este endpoint irá receber um query string com o cargo e o código do candidato,
	 * depois irá realizar a votação nesse candidato usando uma conuslta SQL ao banco.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api\admin\zerarvotos;

	include $_SERVER['DOCUMENT_ROOT'] . "/php/utils.php";

 	/**
	 * Zerar todos os votos no banco de dados.
	 */
	function zerar_votos(): void {
		$mysqli = \utils\get_db_connection();

		if (($mysqli -> query("UPDATE candidatos SET qtd_votos = 0")) === false) {
			$mysqli -> close();
			throw new \mysqli_sql_exception('Unable to execute SQL query.');
		}
        $mysqli -> close();
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
            zerar_votos();
            echo 'Sucesso!';
	  } catch (\mysqli_sql_exception $e) {
            http_response_code(500);  // Internal Server Error
            echo file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/html/50x.html');
            throw $e;  // Could not access the database
	  }; 
	}

	main();
 ?> 