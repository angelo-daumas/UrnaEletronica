<?php /**
	 * Este endpoint permite atualizar os arquivos do nosso WebApp usando git.
	 *
	 * @author Ângelo Daumas <angelodaumas@dcc.ufrj.br>
	 */ 
namespace api\admin\gitpull;

 	/**
	 * Função principal que será responsável pela funcionalidade deste endpoint.
	 */
	function main(): void{
        $cmd = 'git reset --hard\ngit pull';
        echo "<pre>".shell_exec($cmd)."</pre>";
	}

	main();
 ?> 