<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Novo Cliente</h2>
    <?= form_open_multipart('cliente/store') ?>

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control <?= form_error('nome') ? 'is-invalid' : '' ?>" value="<?= set_value('nome') ?>">
        <?= form_error('nome', '<div class="invalid-feedback">', '</div>') ?>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" class="form-control <?= form_error('email') ? 'is-invalid' : '' ?>" value="<?= set_value('email') ?>">
        <?= form_error('email', '<div class="invalid-feedback">', '</div>') ?>
    </div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input 
        type="text" 
        name="telefone" 
        class="form-control <?= form_error('telefone') ? 'is-invalid' : '' ?>" 
        value="<?= set_value('telefone') ?>" 
        required 
        pattern="[0-9]{10,11}" 
        title="Insira um telefone válido com DDD, apenas números.">
    <?= form_error('telefone', '<div class="invalid-feedback">', '</div>') ?>
</div>


    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem</label>
        <input type="file" name="imagem" class="form-control">
    </div>

    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Salvar</button>
    <a href="<?= site_url('cliente') ?>" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Voltar</a>
    <?= form_close() ?>
</div>
</body>
</html>
