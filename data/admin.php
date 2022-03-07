<!DOCTYPE html>
<html lang="pt-BR">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <style>
         @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

         body { 
            font-family: 'Roboto', sans-serif;
         }

         .editorDemoTable {
         background-color: #FFF8C9;
         border-spacing: 0;
         }
         .editorDemoTable td{
         border: 1px solid #777;
         margin: 0 !important;
         padding: 2px 3px;
         }
         .editorDemoTable thead {
         background-color: #2E6C80;
         color: #FFF;
         }
         .editorDemoTable thead td {
         font-weight: bold;
         font-size: 13px;
         }
         .imageRight {
         float: right;
         margin: 0 0 5px 20px;
         }
      </style>
   </head>
   <body>
      <h1 style="color: #4485b8;">Administra&ccedil;&atilde;o das Elei&ccedil;&otilde;es 2022 🇧🇷</h1>
      <p></p>
      <p>Informamos que as informa&ccedil;&otilde;es contidas nessa p&aacute;gina s&atilde;o <strong>estritamente sigilosas at&eacute; que os votos sejam validados.</strong> A divulga&ccedil;&atilde;o indevida dos dados aqui contidos implicar&aacute; em <strong>delito grave</strong> contra todo povo brasileiro e as suas institui&ccedil;&otilde;es democr&aacute;ticas.</p>
      <p><strong style="color: #000;"></strong></p>
      <h4>Contagem preliminar de votos</h4>
      <table class="editorDemoTable" style="vertical-align: top; height: 45px;">
         <thead>
            <tr style="height: 23px;">
               <td style="height: 23px; width: 140px;">Candidato</td>
               <td style="height: 23px; width: 50px;">Cargo</td>
               <td style="height: 23px; width: 49px;">Votos</td>
            </tr>
         </thead>
         <tbody>
            
            <?php
               include $_SERVER['DOCUMENT_ROOT'] . "/php/utils.php";
               $mysqli = \utils\get_db_connection();

               if($result = $mysqli -> query("SELECT * FROM candidatos")){
                  while($row = $result->fetch_assoc()) 
                  { 
                     echo '<tr style="height: 22px;">';
                     echo '<td style="min-width: 140px; height: 22px; width: 140px;">'.$row['nome'].'</td>';
                     echo '<td style="height: 22px; width: 50px;">'.$row['cargo'].'</td>';
                     echo '<td style="height: 22px; width: 49px;">'.'0'.'</td>';
                     echo '</tr>';
                  }
               }
               
               
            ?>
         </tbody>
      </table>
      <hr />
      <p><strong>Aten&ccedil;&atilde;o! </strong>Clicando no bot&atilde;o abaixo, a contagem dos votos ser&aacute; zerada. Extrema cautela &eacute; necess&aacute;ria em sua opera&ccedil;&atilde;o.</p>
      <p>&nbsp;<button style="background-color: #4485b8; color: #fff; display: inline-block; padding: 2px 8px; font-weight: bold; border-radius: 5px;">Zerar votos coletados</button> </p>
      <hr />
      <p><em>Qualquer aviso legal nesta p&aacute;gina &eacute; para prop&oacute;sitos de simula&ccedil;&atilde;o e não reflete qualquer tipo de posi&ccedil;&atilde;o legal.<br /></em></p>
   </body>
</html>