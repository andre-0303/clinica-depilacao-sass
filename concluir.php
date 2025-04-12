<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];

  $sql = "UPDATE clientes SET status='Concluido' WHERE id=$id";
  if ($conn->query($sql)) {
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false]);
  }
}
