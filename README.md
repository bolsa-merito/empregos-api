# Emprego API

API do projeto de empregos

## Sumário

- [Requisitos](#requisitos)
- [Instalação](#instalação)
- [Configuração do Banco de Dados](#configuração-do-banco-de-dados)
  - [Rodar Migrations](#rodar-migrations)
  - [Rodar Seeders](#rodar-seeders)
- [Rodar o Projeto](#rodar-o-projeto)
- [Uso](#uso)
- [Testes](#testes)
- [Contribuição](#contribuição)
- [Licença](#licença)

## Requisitos

Certifique-se de que você possui os seguintes softwares instalados em seu ambiente:

- PHP (versão recomendada para o seu projeto Laravel, por exemplo, PHP >= 8.2)
- Composer
- Servidor Web (Apache, Nginx ou Laravel Sail/Valet/Laragon)
- Banco de Dados (MySQL)

## Instalação

Siga os passos abaixo para configurar e instalar o projeto em sua máquina local:

1.  **Clone o repositório:**

    ```bash
    git clone https://github.com/seu-usuario/nome-do-projeto.git
    cd nome-do-projeto
    ```

2.  **Instale as dependências do Composer:**

    ```bash
    composer install
    ```

3.  **Copie o arquivo de variáveis de ambiente:**

    ```bash
    cp .env.example .env
    ```

4.  **Gere a chave da aplicação:**

    ```bash
    php artisan key:generate
    ```

5.  **Configure o arquivo `.env`:**
    Abra o arquivo `.env` e configure as credenciais do seu banco de dados, e-mail e outras variáveis de ambiente necessárias.

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_seu_banco_de_dados
    DB_USERNAME=seu_usuario_do_banco_de_dados
    DB_PASSWORD=sua_senha_do_banco_de_dados
    ```

## Configuração do Banco de Dados

### Rodar Migrations

As migrations criam as tabelas no seu banco de dados. Certifique-se de que o banco de dados especificado no arquivo `.env` já existe.

```bash
php artisan migrate
```

Se você precisar recriar o banco de dados do zero (por exemplo, em ambiente de desenvolvimento), pode usar o seguinte comando para reverter todas as migrations e executá-las novamente:

```bash
php artisan migrate:fresh
```

### Rodar Seeders

Os seeders populam o banco de dados com dados de exemplo ou iniciais.

```bash
php artisan db:seed
```

Se você usou `php artisan migrate:fresh` e deseja rodar as migrations e os seeders em um único comando:

```bash
php artisan migrate:fresh --seed
```

## Rodar o Projeto

Você pode rodar o projeto Laravel de algumas maneiras:

-   **Usando o servidor de desenvolvimento embutido do PHP (para desenvolvimento):**

    ```bash
    php artisan serve
    ```

    Este comando iniciará um servidor em `http://127.0.0.1:8000`.

-   **Configurando um servidor web (Apache/Nginx):**
    Configure seu servidor web (Apache ou Nginx) para apontar o `DocumentRoot` ou `root` para o diretório `public` do seu projeto Laravel.

## Uso

*(Esta seção precisa ser preenchida com informações sobre como usar o projeto)*

## Testes

*(Esta seção precisa ser preenchida com informações sobre como rodar os testes do projeto)*

## Contribuição

*(Esta seção precisa ser preenchida com informações sobre como contribuir para o projeto)*

## Licença

*(Esta seção precisa ser preenchida com a licença do projeto)*