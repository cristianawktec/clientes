# Sistema de Cadastro de Clientes (PHP 7.4 + CodeIgniter 4)

## Instalação

1. Instale Apache, PHP 7.4 e MySQL (LAMP/XAMPP/MAMP).
2. Clone o projeto e configure `.env` com o acesso ao banco.
3. Crie o banco e execute a migration:
   ```bash
   php spark migrate
   ```
4. Acesse via navegador: `http://localhost/cliente-app/public/cliente`

## Funcionalidades
- Cadastro com imagem e validação
- Listagem com miniaturas
- Edição e exclusão de registros
