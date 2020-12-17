<?php
  require "../../php/conexaoMysql.php";
  $pdo = mysqlConnect();
  
  try {
  
    $sql = <<<SQL
    SELECT data_agendamento, horario, agenda.nome, agenda.email, agenda.telefone, pessoa.nome as nome_medico
    FROM agenda INNER JOIN pessoa ON agenda.codigo_medico = pessoa.codigo
    SQL;

    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
?>
<div class="mt-5">
<h3>Agendamentos registrados</h3>
    <table class="table table-striped">
      <tr>
        <th>Data agendamento</th>
        <th>Horário</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Médico</th>
      </tr>
    <?php
       while ($row = $stmt->fetch()) {

        // Limpa os dados produzidos pelo usuário
        // com possibilidade de ataque XSS
        $data_agendamento = htmlspecialchars($row['data_agendamento']);
        $horario = htmlspecialchars($row['horario']);
        $nome = htmlspecialchars($row['agenda.nome']);
        $email = htmlspecialchars($row['agenda.email']);
        $telefone = htmlspecialchars($row['agenda.telefone']);
        $medico = htmlspecialchars($row['nome_medico']);

        echo <<<HTML
          <tr>
            <td>$data_agendamento</td>
            <td>$horario</td>
            <td>$nome</td>
            <td>$email</td> 
            <td>$telefone</td> 
            <td>$medico</td> 
          </tr>      
        HTML;
      }
    ?>
    </table>
</div>
