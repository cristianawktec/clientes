<!DOCTYPE html>
<html>
<head><title>Editar Cliente</title></head>
<body>
<h1>Editar Cliente</h1>
<form action="/cliente/update/<?= $cliente['id'] ?>" method="post" enctype="multipart/form-data">
    Nome: <input type="text" name="nome" value="<?= $cliente['nome'] ?>"><br>
    Email: <input type="email" name="email" value="<?= $cliente['email'] ?>"><br>
    Telefone: <input type="text" name="telefone" value="<?= $cliente['telefone'] ?>"><br>
    Imagem Atual: <img src="/uploads/<?= $cliente['imagem'] ?>" width="50"><br>
    Nova Imagem: <input type="file" name="imagem"><br>
    <button type="submit">Atualizar</button>
</form>
</body>
</html>
