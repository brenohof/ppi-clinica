<?php
// Importa a função mysqlConnect
require "conexaoMysql.php";
$pdo = mysqlConnect();

$cep = $endereco = $bairro = $cidade = "";
if (isset($_POST["cep"])) $cep = trim($_POST["cep"]);
if (isset($_POST["logradouro"])) $logradouro = trim($_POST["logradouro"]);
if (isset($_POST["bairro"])) $bairro = trim($_POST["bairro"]);
if (isset($_POST["cidade"])) $cidade = trim($_POST["cidade"]);
if (isset($_POST["estado"])) $estado= trim($_POST["estado"]);

$cep = htmlspecialchars($cep);
$logradouro = htmlspecialchars($logradouro);
$bairro = htmlspecialchars($bairro);
$cidade = htmlspecialchars($cidade);
$estado = htmlspecialchars($estado);

$sql = <<<SQL
  INSERT INTO base_enderecos_ajax
    (cep, logradouro, bairro, cidade, estado)
  VALUES (?, ?, ?, ?, ?)
  SQL;

$stmt = $pdo->prepare($sql);
if (!$stmt->execute([
    $cep, $logradouro, $bairro, $cidade, $estado
])) throw new Exception('Falha na inserção');

?>