<!DOCTYPE html>
<html>
<head><title>Novo Cliente</title></head>
<body>
<h1>Novo Cliente</h1>
<?php if(isset($validation)): ?>
    <?= $validation->listErrors() ?>
<?php endif; ?>
<form action="/cliente/store" method="post" enctype="multipart/form-data">
    Nome: <input type="text" name="nome"><br>
    Email: <input type="email" name="email"><br>
    Telefone: <input type="text" name="telefone"><br>
    Imagem: <input type="file" name="imagem"><br>
    <button type="submit">Salvar</button>
</form>
</body>
</html>
