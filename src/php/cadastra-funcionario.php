<?php 
	require "conexaoMysql.php";
	$pdo = mysqlConnect();
	
	
	$nome = $email = $telefone = "";
	if (isset($_POST["nome"])) $nome = $_POST["nome"];
	if (isset($_POST["telefone"])) $telefone = $_POST["telefone"];
	if (isset($_POST["email"])) $email = $_POST["email"];
	

	$cep = $logradouro = $bairro = $cidade = $estado = "";
	if (isset($_POST["cep"])) $cep = $_POST["cep"];
	if (isset($_POST["logradouro"])) $logradouro = $_POST["logradouro"];
	if (isset($_POST["bairro"])) $bairro = $_POST["bairro"];
	if (isset($_POST["cidade"])) $cidade = $_POST["cidade"];
	if (isset($_POST["estado"])) $estado = $_POST["estado"];

	$dataIngresso = $salario = $senha = "";
	if (isset($_POST["data-ingresso"])) $dataIngresso = $_POST["data-ingresso"];
	if (isset($_POST["salario"])) $salario = $_POST["salario"];
	if (isset($_POST["senha"])) $senha = $_POST["senha"];

	$especialidade = $crm = "";
	if (isset($_POST["especialidade"])) $especialidade = $_POST["especialidade"];
	if (isset($_POST["crm"])) $crm = $_POST["crm"];

	$nome = htmlspecialchars(trim($nome));
	$telefone = htmlspecialchars(trim($telefone));
	$email = htmlspecialchars(trim($email));

	$cep = htmlspecialchars(trim($cep));
	$logradouro = htmlspecialchars(trim($logradouro));
	$bairro = htmlspecialchars(trim($bairro));
	$cidade = htmlspecialchars(trim($cidade));
	$estado = htmlspecialchars(trim($estado));
	
	$dataIngresso = htmlspecialchars(trim($dataIngresso));
	$salario = htmlspecialchars(trim($salario));
	$senha = htmlspecialchars(trim($senha));
	$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

	$especialidade = htmlspecialchars(trim($especialidade));
	$crm = htmlspecialchars(trim($crm));

	$sql1 = <<<SQL
		INSERT INTO pessoa (nome, telefone, email, cep, 
					logradouro, bairro, cidade, estado)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?)
		SQL;

	$sql2 = <<<SQL
			INSERT INTO funcionario
			(data_contrato, salario, senha_hash, codigo)
			VALUES (?, ?, ?, ?)
			SQL;

	$sql3 = <<<SQL
			INSERT INTO medico
				(especialidade, crm, codigo)
			VALUES (?, ?, ?)
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

  // Inserção na tabela funcionario
  // Precisamos do id da pessoa cadastrada, que
  // foi gerado automaticamente pelo MySQL
  // na operação acima (campo auto_increment), para
  // prover valor para o campo chave estrangeira
  $idNovaPessoa = $pdo->lastInsertId();
  $stmt2 = $pdo->prepare($sql2);
  if (!$stmt2->execute([
    $dataIngresso, $salario, $senha_hash, $idNovaPessoa
  ])) throw new Exception('Falha na segunda inserção');

  //$idNovoFuncionario = $pdo->lastInsertId();
  $stmt3 = $pdo->prepare($sql3);
  if (!$stmt3->execute([
    $especialidade, $crm, $idNovaPessoa
  ])) throw new Exception('Falha na segunda inserção');

  // Efetiva as operações
  $pdo->commit();

  header("location: ../pages/private/index.php");
  exit();
} 
catch (Exception $e) {
  $pdo->rollBack();
  if ($e->errorInfo[1] === 1062)
    exit('Dados duplicados: ' . $e->getMessage());
  else
    exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
?>