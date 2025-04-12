<?php
include 'conexao.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM clientes WHERE id = $id");
$cliente = $result->fetch_assoc();
$servicosSelecionados = explode(", ", $cliente['servico']);

$servicos = [
  "Depilação a cera" => 40.00,
  "Depilação a laser" => 70.00,
  "Design de sobrancelha" => 25.00,
  "Depilação bikini" => 30.00
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Cliente</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function mascaraTelefone(input) {
      input.value = input.value
        .replace(/\D/g, '')
        .replace(/^(\d{2})(\d)/g, '($1) $2')
        .replace(/(\d{5})(\d{4})$/, '$1-$2');
    }
  </script>
</head>
<body class="bg-gray-100 p-6">
  <form action="atualizar.php" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Editar Cliente</h2>
    <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

    <label class="block mb-2">Nome:</label>
    <input type="text" name="nome" value="<?= $cliente['nome'] ?>" required class="w-full border px-3 py-2 mb-4 rounded" />

    <label class="block mb-2">Telefone:</label>
    <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>" oninput="mascaraTelefone(this)" required class="w-full border px-3 py-2 mb-4 rounded" />

    <label class="block mb-2">Endereço:</label>
    <input type="text" name="endereco" value="<?= $cliente['endereco'] ?>" required class="w-full border px-3 py-2 mb-4 rounded" />

    <label class="block mb-2">Serviços:</label>
    <div class="mb-4 space-y-2">
      <?php foreach ($servicos as $nome => $preco): ?>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="servicos[]" value="<?= $nome ?>" <?= in_array($nome, $servicosSelecionados) ? 'checked' : '' ?>>
          <?= $nome ?> - <span class="text-gray-600">R$ <?= number_format($preco, 2, ',', '.') ?></span>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="flex justify-between">
      <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Atualizar</button>
      <a href="listar.php" class="text-blue-600">Voltar</a>
    </div>
  </form>
</body>
</html>
