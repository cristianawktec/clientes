# Sistema de Cadastro de Clientes - PHP MVC

Este projeto consiste em um sistema simples de gerenciamento de clientes, desenvolvido em PHP utilizando o padrão **MVC (Model-View-Controller)** e a biblioteca nativa do **CodeIgniter 3**.

## ✅ Funcionalidades

- Listagem de clientes com visualização de imagem em miniatura
- Cadastro de novo cliente com upload de foto
- Edição de dados do cliente
- Exclusão de clientes
- Validações de formulário (nome, e-mail, telefone)
- Interface responsiva com **Bootstrap 5**

---

## ⚙️ Requisitos

- PHP 7.4+
- MySQL/MariaDB
- Servidor local (XAMPP, MAMP, WAMP ou LAMP)
- Composer (opcional, para organizar dependências)

---

## 🚀 Instalação e Execução

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seuusuario/sistema-clientes.git
   cd sistema-clientes
   ```

2. **Configure o banco de dados:**

   - Crie um banco MySQL com o nome `clientes` (ou outro).
   - Importe o script SQL localizado em: `database/clientes.sql`

3. **Atualize as credenciais no CodeIgniter:**

   - Edite `application/config/database.php` com seu host, usuário e senha.

4. **Garanta que a pasta `uploads/` tenha permissão de escrita:**

   ```bash
   chmod -R 775 uploads/
   ```

5. **Acesse via navegador:**

   ```
   http://localhost/sistema-clientes/index.php/cliente
   ```

---

## 🧪 Validações aplicadas

- Nome: obrigatório, mínimo de 3 caracteres
- E-mail: obrigatório, formato válido (validação via CodeIgniter e HTML5)
- Telefone: obrigatório, 10 ou 11 dígitos (somente números)
- Imagem: `jpeg`, `png`, `jpg`, `gif` (opcional no update)

---

## 📁 Estrutura do Projeto

```
sistema-clientes/
├── application/
│   ├── controllers/       # Cliente.php
│   ├── models/            # ClienteModel.php
│   ├── views/             # create.php, index.php, edit.php
├── uploads/               # Imagens enviadas pelos clientes
├── database/              # Script SQL para importar
├── system/                # Core do CodeIgniter
```

---

## 🧠 Observações

- Projeto construído 100% com PHP nativo e CodeIgniter 3.
- Utiliza MVC real e separação de responsabilidades.
- Ideal para avaliação de desenvolvedor backend full stack.

---

## ✍️ Autor

Desenvolvido por **Cristian Marques** — [https://essentia.consultoriawk.com/clientes/](https://essentia.consultoriawk.com/clientes/)
