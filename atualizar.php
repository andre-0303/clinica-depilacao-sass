<?php
include 'conexao.php';

$precos = [
  "Depilação a cera" => 40.00,
  "Depilação a laser" => 70.00,
  "Design de sobrancelha" => 25.00,
  "Depilação bikini" => 30.00
];

$id = $_POST['id'];
$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$servicos = isset($_POST['servicos']) ? $_POST['servicos'] : [];
$servico_texto = implode(", ", $servicos);

// Calcular preço novamente
$preco_total = 0;
foreach ($servicos as $s) {
  if (isset($precos[$s])) {
    $preco_total += $precos[$s];
  }
}

$sql = "UPDATE clientes SET nome='$nome', telefone='$telefone', endereco='$endereco', servico='$servico_texto', preco_total='$preco_total' WHERE id=$id";
$conn->query($sql);
$conn->close();

header("Location: listar.php");
exit();
