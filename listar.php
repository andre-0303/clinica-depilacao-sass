<?php
include 'conexao.php';

$result = $conn->query("SELECT * FROM clientes");

// Inicializa totalizador
$totalGeral = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lista de Clientes</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-6xl mx-auto">
    <h2 class="text-3xl font-bold mb-6 text-center">Clientes Cadastrados</h2>
    <a href="index.php" class="inline-block mb-4 text-blue-600 hover:underline">← Voltar para Home</a>

    <div class="overflow-x-auto">
      <table class="min-w-full bg-white rounded shadow">
        <thead>
          <tr class="bg-gray-200 text-left">
            <th class="border px-4 py-2">Nome</th>
            <th class="border px-4 py-2">Telefone</th>
            <th class="border px-4 py-2">Endereço</th>
            <th class="border px-4 py-2">Serviços</th>
            <th class="border px-4 py-2">Preço</th>
            <th class="border px-4 py-2">Status</th>
            <th class="border px-4 py-2">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = $result->fetch_assoc()): ?>
            <?php $totalGeral += $row['preco_total']; ?>
            <tr class="hover:bg-gray-50">
              <td class="border px-4 py-2"><?= $row['nome'] ?></td>
              <td class="border px-4 py-2"><?= $row['telefone'] ?></td>
              <td class="border px-4 py-2"><?= $row['endereco'] ?></td>
              <td class="border px-4 py-2"><?= $row['servico'] ?></td>
              <td class="border px-4 py-2">R$ <?= number_format($row['preco_total'], 2, ',', '.') ?></td>
              <td class="border px-4 py-2">
                <span class="<?= $row['status'] === 'Concluído' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' ?>">
                  <?= $row['status'] ?>
                </span>
              </td>
              <td class="border px-4 py-2 space-y-1">
                <a href="editar.php?id=<?= $row['id'] ?>" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white text-sm px-3 py-1 rounded">Editar</a>
                <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="inline-block bg-red-500 hover:bg-red-600 text-white text-sm px-3 py-1 rounded">Excluir</a>
                <?php if ($row['status'] === 'Pendente'): ?>
                    <button onclick="concluirCliente(<?= $row['id'] ?>, this)" class="inline-block bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1 rounded">Concluir</button>
                <?php endif; ?>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
        <tfoot>
          <tr class="bg-gray-100 font-semibold">
            <td colspan="4" class="border px-4 py-2 text-right">Total Geral:</td>
            <td class="border px-4 py-2">R$ <?= number_format($totalGeral, 2, ',', '.') ?></td>
            <td colspan="2" class="border px-4 py-2"></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <script>
  function concluirCliente(id, btn) {
    fetch('concluir.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'id=' + id
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        const row = btn.closest('tr');
        const statusTd = row.querySelector('td:nth-child(6)');
        statusTd.innerHTML = '<span class="text-green-600 font-semibold">Concluído</span>';
        btn.remove();

        // Toast com SweetAlert2
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'success',
          title: 'Cliente marcado como concluído!',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Erro!',
          text: 'Não foi possível atualizar o status.'
        });
      }
    });
  }
  </script>

</body>
</html>
