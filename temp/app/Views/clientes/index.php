<!DOCTYPE html>
<html>
<head>
    <title>Lista de Clientes</title>
</head>
<body>
    <h1>Clientes</h1>
    <a href="/cliente/create">Novo Cliente</a>
    <table border="1">
        <tr><th>Imagem</th><th>Nome</th><th>Email</th><th>Telefone</th><th>Ações</th></tr>
        <?php foreach($clientes as $cliente): ?>
        <tr>
            <td><img src="/uploads/<?= $cliente['imagem'] ?>" width="50"></td>
            <td><?= $cliente['nome'] ?></td>
            <td><?= $cliente['email'] ?></td>
            <td><?= $cliente['telefone'] ?></td>
            <td>
                <a href="/cliente/edit/<?= $cliente['id'] ?>">Editar</a>
                <a href="/cliente/delete/<?= $cliente['id'] ?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
