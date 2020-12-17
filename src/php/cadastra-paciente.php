<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

// Inicializa e resgata dados de pessoa
$nome = $telefone = $email = "";
if (isset($_POST["nome"])) $nome = $_POST["nome"];
if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
if (isset($_POST["email"])) $email = $_POST["email"];

// Inicializa e resgata endereço
$cep = $logradouro = $bairro = $cidade = $estado = "";
if (isset($_POST["cep"])) $cep = $_POST["cep"];
if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
if (isset($_POST["bairro"])) $bairro = $_POST["bairro"];
if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
if (isset($_POST["estado"])) $estado = $_POST["estado"];

// Inicializa e resgata dados paciente
$peso = $altura = $tipoSanguineo = "";
if (isset($_POST["altura"])) $altura = $_POST["altura"];
if (isset($_POST["peso"])) $peso = $_POST["peso"];
if (isset($_POST["tipoSanguineo"])) $tipoSanguineo = $_POST["tipoSanguineo"];

$nome = htmlspecialchars(trim($nome));
$telefone = htmlspecialchars(trim($telefone));
$email = htmlspecialchars(trim($email));
$cep = htmlspecialchars(trim($cep));
$logradouro = htmlspecialchars(trim($logradouro));
$bairro = htmlspecialchars(trim($bairro));
$cidade = htmlspecialchars(trim($cidade));
$estado = htmlspecialchars(trim($estado));
$altura = htmlspecialchars(trim($altura));
$peso = htmlspecialchars(trim($peso));
$tipoSanguineo = htmlspecialchars(trim($tipoSanguineo));

$sql1 = <<<SQL
  INSERT INTO pessoa (nome, telefone, email, cep, 
                       logradouro, bairro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO paciente
    (altura, peso, tipo_sanguineo, codigo)
  VALUES (?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  // Inserção na tabela pessoa
  // Neste caso utilize prepared statements para prevenir
  // ataques do tipo SQL Injection, pois estamos
  // inseririndo dados fornecidos pelo usuário
  $stmt1 = $pdo->prepare($sql1);
  if (!$stmt1->execute([
    $nome, $telefone, $email, $cep,
    $logradouro, $bairro, $cidade, $estado
  ])) throw new Exception('Falha na primeira inserção');

  // Inserção na tabela paciente
  // Precisamos do id da pessoa cadastrada, que
  // foi gerado automaticamente pelo MySQL
  // na operação acima (campo auto_increment), para
  // prover valor para o campo chave estrangeira
  $idNovaPessoa = $pdo->lastInsertId();
  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $altura, $peso, $tipoSanguineo, $idNovaPessoa
  ])) throw new Exception('Falha na segunda inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: ../");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
