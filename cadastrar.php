<?php
// Definindo os serviços e preços
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Cliente</title>
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

  <form action="salvar_cliente.php" method="POST" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">Cadastrar Cliente</h2>
    
    <label class="block mb-2">Nome:</label>
    <input type="text" name="nome" required class="w-full border px-3 py-2 mb-4 rounded" />

    <label class="block mb-2">Telefone:</label>
    <input type="text" id="telefone" name="telefone" required class="w-full p-2 border rounded" placeholder="(00) 00000-0000" maxlength="15">

    <label class="block mb-2">Endereço:</label>
    <input type="text" name="endereco" required class="w-full border px-3 py-2 mb-4 rounded" />

    <label class="block mb-2">Serviços:</label>
    <div class="mb-4 space-y-2">
      <?php foreach ($servicos as $nome => $preco): ?>
        <label class="flex items-center gap-2">
          <input type="checkbox" name="servicos[]" value="<?= $nome ?>" class="text-blue-500">
          <?= $nome ?> - <span class="text-gray-600">R$ <?= number_format($preco, 2, ',', '.') ?></span>
        </label>
      <?php endforeach; ?>
    </div>

    <div class="flex justify-between items-center">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full sm:w-auto">Cadastrar</button>
      <a href="index.php" class="text-blue-600 text-center block sm:inline-block mt-4 sm:mt-0">Voltar</a>
    </div>
  </form>

  <script>
  const telefoneInput = document.getElementById('telefone');

  telefoneInput.addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, '').slice(0, 11); // Limita a 11 dígitos
    if (value.length >= 2) {
      value = '(' + value.slice(0, 2) + ') ' + value.slice(2);
    }
    if (value.length >= 10) {
      value = value.slice(0, 10) + '-' + value.slice(10);
    }
    e.target.value = value;
  });
  </script>

</body>
</html>
