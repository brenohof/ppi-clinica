<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

class RequestResponse
{
  public $success;
  public $message;

  function __construct($success, $message)
  {
    $this->success = $success;
    $this->message = $message;
  }
}

$email = $senha = "";
if (isset($_POST["email"])) $email = trim($_POST["email"]);
if (isset($_POST["senha"])) $senha = $_POST["senha"];

try {
  $sql = <<<SQL
  SELECT senha_hash
  FROM pessoa INNER JOIN funcionario ON pessoa.codigo = funcionario.codigo
  WHERE email = ?
  SQL;

  $stmt = $pdo->prepare($sql);
  $stmt->execute([$email]);
  $row = $stmt->fetch();
  if (!$row) {
    $response = new RequestResponse(false, "Este e-mail não está registrado");
  } else {
    if (!password_verify($senha, $row['senha_hash']))
      $response = new RequestResponse(false, "Senha incorreta.");
    else {
      $response = new RequestResponse(true, "Operação realizada com sucesso");
    }
  }
  echo json_encode($response);
} catch (Exception $e) {
  $response = new RequestResponse(false, $e->getMessage());
  echo json_encode($response);
}
