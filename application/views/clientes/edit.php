<!DOCTYPE html>
<html>
<head>
    <title>Editar Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Editar Cliente</h2>

    <form action="<?= site_url('cliente/update/' . $cliente['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?= htmlspecialchars($cliente['nome']) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($cliente['email']) ?>">
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="<?= htmlspecialchars($cliente['telefone']) ?>">
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Imagem:</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
            <?php if (!empty($cliente['imagem'])): ?>
                <img src="<?= base_url('uploads/' . $cliente['imagem']) ?>" width="100" class="mt-2">
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= site_url('cliente') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const telefoneInput = document.getElementById("telefone");

  telefoneInput.addEventListener("input", function (e) {
    let value = e.target.value.replace(/\D/g, ""); // Remove tudo que não for número

    if (value.length > 11) {
      value = value.slice(0, 11); // Limita a 11 dígitos
    }

    // Aplica máscara (99) 99999-9999 ou (99) 9999-9999 conforme o tamanho
    if (value.length <= 10) {
      value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, "($1) $2-$3");
    } else {
      value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, "($1) $2-$3");
    }

    e.target.value = value.trim();
  });
});
</script>
</body>
</html>
