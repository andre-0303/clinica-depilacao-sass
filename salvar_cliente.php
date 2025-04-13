<?php
include 'conexao.php';

// Definindo os serviços e preços
$servicos_disponiveis = [
  "Depilação a cera" => 40.00,
  "Depilação a laser" => 70.00,
  "Design de sobrancelha" => 25.00,
  "Depilação bikini" => 30.00
];

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$servicosSelecionados = $_POST['servicos'] ?? [];

// Concatena os nomes dos serviços
$servicosStr = implode(", ", $servicosSelecionados);

// Calcula o preço total com base nos serviços selecionados
$precoTotal = 0;
foreach ($servicosSelecionados as $servico) {
  if (isset($servicos_disponiveis[$servico])) {
    $precoTotal += $servicos_disponiveis[$servico];
  }
}

// Insere no banco de dados
$stmt = $conn->prepare("INSERT INTO clientes (nome, telefone, endereco, servico, preco_total, status) VALUES (?, ?, ?, ?, ?, 'Pendente')");
$stmt->bind_param("ssssd", $nome, $telefone, $endereco, $servicosStr, $precoTotal);
$stmt->execute();

header("Location: listar.php?sucesso=cadastro");
exit;

?>
