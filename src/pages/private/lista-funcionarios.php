<?php
  require "../../php/conexaoMysql.php";
  $pdo = mysqlConnect();
  
  try {
  
    $sql = <<<SQL
    SELECT nome, email, telefone, cep, logradouro, bairro, cidade, estado,
    data_contrato, salario
    FROM pessoa INNER JOIN funcionario ON pessoa.codigo = funcionario.codigo
    SQL;

    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
?>
<div class="mt-5">
<h3>Funcionários registrados</h3>
    <table class="table table-striped">
      <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Data contrato</th>
        <th>Salário</th>
      </tr>
    <?php
       while ($row = $stmt->fetch()) {

        // Limpa os dados produzidos pelo usuário
        // com possibilidade de ataque XSS
        $logradouro = htmlspecialchars($row['logradouro']);
        $bairro = htmlspecialchars($row['bairro']);
        $cidade = htmlspecialchars($row['cidade']);
        $estado = htmlspecialchars($row['estado']);
        $cep = htmlspecialchars($row['cep']);
        $nome = htmlspecialchars($row['nome']);
        $email = htmlspecialchars($row['email']);
        $telefone = htmlspecialchars($row['telefone']);
        $dataContrato = htmlspecialchars($row['data_contrato']);
        $salario = htmlspecialchars($row['salario']);

        echo <<<HTML
          <tr>
            <td>$nome</td>
            <td>$email</td>
            <td>$telefone</td>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$bairro</td>
            <td>$cidade</td>
            <td>$estado</td> 
            <td>$dataContrato</td> 
            <td>$salario</td>
          </tr>      
        HTML;
      }
    ?>
    </table>
</div>
