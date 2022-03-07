<?php /**
	 * Este endpoint irá receber um query string com o cargo e o código do candidato,
	 * retornando como JSON os dados do candidato encontrados no banco de dados.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace utils;

 	/**
	 * 
	 * @retval bool
	 *  Retorna se o servidor é local ou de produção.
	 */
	function is_production():bool {
        return $_SERVER['HTTP_HOST'] == 'localhost';
    }

    function get_db_address():string {
        return is_production() ? "172.22.0.3" : "db";
    }

    function get_db_connection() {
        $mysqli = new \mysqli(get_db_address(),"root","example","urnaeletronica");

		if ($mysqli -> connect_errno) {
			throw new \mysqli_sql_exception('Unable to open a connection.');
		};

        return $mysqli;
    }
 ?> 