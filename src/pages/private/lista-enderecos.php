<?php
  if ($login == null) {
    header('location: ../../index.html');
    exit();
  }

  require "../../php/conexaoMysql.php";
  $pdo = mysqlConnect();
  
  try {
  
    $sql = <<<SQL
    SELECT logradouro, bairro, cidade, estado, cep
    FROM base_enderecos_ajax
    SQL;
  
    // Neste exemplo não é necessário utilizar prepared statements
    // porque não há possibilidade de injeção de SQL, 
    // pois nenhum parâmetro é utilizado na query SQL
    $stmt = $pdo->query($sql);
  } 
  catch (Exception $e) {
    //error_log($e->getMessage(), 3, 'log.php');
    exit('Ocorreu uma falha: ' . $e->getMessage());
  }
?>
<div class="mt-5">
<h3>Endereços registrados</h3>
    <table class="table table-striped">
      <tr>
        <th>CEP</th>
        <th>Logradouro</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Estado</th>
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

        echo <<<HTML
          <tr>
            <td>$cep</td>
            <td>$logradouro</td>
            <td>$bairro</td>
            <td>$cidade</td>
            <td>$estado</td> 
          </tr>      
        HTML;
      }
    ?>
    </table>
</div>
