<?php

    class Endereco
    {

         public $bairro;
          public $cidade;
          public $logradouro;
          public $estado;

          function __construct($bairro, $cidade, $logradouro, $estado)
          {
                $this->bairro = $bairro; 
            $this->cidade = $cidade;
            $this->logradouro = $logradouro;
            $this->estado = $estado;
          }
    }

    require "../../php/conexaoMysql.php";
      $pdo = mysqlConnect();

    $cep = "";
    if (isset ($_GET['cep']))
      $cep = $_GET['cep'];

    $sql = <<<SQL
        SELECT logradouro, bairro, cidade, estado FROM base_enderecos_ajax
        WHERE cep = ?
        SQL;

    try {
        $stmt = $pdo->query($cep);
        $row = $stmt->fetch();
        if (!$row) {
        echo json_encode(new Endereco('', '', '', ''));

    } else {

        $endereco = new Endereco($row['bairro'], $row['cidade'], $row['logradouro'], $row['estado']);
          echo json_encode($endereco);
    }

    } catch (Exception $e) {

    }
?>