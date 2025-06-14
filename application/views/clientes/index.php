<?php $this->load->helper('url'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Lista de Clientes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4">Clientes</h2>

    <a href="<?= site_url('cliente/create') ?>" class="btn btn-primary mb-3">➕ Novo Cliente</a>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>Imagem</th>
          <th>Nome</th>
          <th>Email</th>
          <th>Telefone</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($clientes)) : ?>
          <?php foreach ($clientes as $c) : ?>
            <tr>
              <td><img src="<?= base_url('uploads/' . $c['imagem']) ?>" width="50" height="50" class="rounded-circle" alt="img"></td>
              <td><?= htmlspecialchars($c['nome']) ?></td>
              <td><?= htmlspecialchars($c['email']) ?></td>
              <td><?= htmlspecialchars($c['telefone']) ?></td>
              <td>
                <a href="<?= site_url('cliente/edit/' . $c['id']) ?>" class="btn btn-sm btn-warning">✏️ Editar</a>
                <a href="<?= site_url('cliente/delete/' . $c['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">🗑️ Excluir</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="5" class="text-center">Nenhum cliente cadastrado.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
