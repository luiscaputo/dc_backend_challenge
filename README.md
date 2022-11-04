# DC_Challenge

Projecto desenvolvido para teste técnico na DC Tecnologia Brasil, sendo o foco principal a gestão de produtos e vendas.

O projecto esta dividido em duas partes sendo a API no padrão RESTFULL e Json e o FrontEnd em Blade.

Sobre a API, como executar e como foi desenvolvida:

## API

<br/>

## 🚀 Tecnologias & Ferramentas utilizadas

-   **[PHP - 8.1.1](https://www.php.net/)**
-   **[Laravel - 9](https://laravel.com/)**
-   **[Visual Studio Code](https://code.visualstudio.com/)**
-   **[Insomnia](https://insomnia.rest/download)**
-   **[MYSQL](https://www.mysql.com/)**
-   **[Git](https://git-scm.com/downloads)**

<br/>

> ## Princípios aplicados

-   **S**ingle Responsibility Principle (SRP)
-   **O**pen Closed Principle (OCP)
-   **L**iskov Substitution Principle (LSP)
-   **I**nterface Segregation Principle (ISP)
-   **D**ependency Inversion Principle (DIP)
-   Separation of Concerns (SOC)
-   Don't Repeat Yourself (DRY)
-   You Aren't Gonna Need It (YAGNI)
-   Keep It Simple, Silly (KISS)
-   Composition Over Inheritance

> ## Design Patterns

-   Dependency Injection
-   Binding

> ## Metodologias e Designs

-   Clean Architecture
-   Conventional Commits
-   INterfaces- Repositories - Services - controller

    > ## Gerenciador de Pacotes & commands

-   composer
-   Hash
-   Git
-   Artisan

> ## Features do Node

-   API Rest com Laravel
-   Logs de Erro
-   Segurança (Hashing, Encryption e Encoding)
-   CORS
-   Middlewares

> ## Features do Git

-   Alias
-   Branch - Master Unique
-   Tag
-   Merge

> ## Features do Laravel

-   POO
-   Interface
-   TypeAlias
-   Namespace

Recursos disponíveis para acesso via API ou endpoints(URI):

-   **baseURL** - 127.0.0.1:8000/api/
-   **products** - /products
-   **sales** - /sales

| Método   | Descrição                      |
| -------- | ------------------------------ |
| `GET`    | `/products/{id}` e `/products` |
| `POST`   | `/products`                    |
| `PUT`    | `/products/{id}`               |
| `DELETE` | `/products/{id}`               |

| Método   | Descrição                |
| -------- | ------------------------ |
| `GET`    | `/sales/{id}` e `/sales` |
| `POST`   | `/sales`                 |
| `PUT`    | `/sales/{id}`            |
| `DELETE` | `/sales/{id}`            |

um exemplo do funcionamento das rotas.

## Dependencias | Instalando o proejcto

# Normal

1. `php artisan key:generate`
2. `php artisan migrate` - Para rodar as migrations
3. `php artisan serve` - Para rodar a aplicação também

Para rodar a aplicação siga os seguintes passos:
Primeiro: Crie as variáveis de ambiente `.env`, e dentro delas configure as variáveis de ambiente existentes no `.env.example`

## Métodos

Requisições para a API devem seguir os padrões:

| Método   | Descrição                                    |
| -------- | -------------------------------------------- |
| `GET`    | Retorna informações de um ou mais registros. |
| `POST`   | Utilizado para criar um novo registro.       |
| `PUT`    | Utilizado para atualizar um registro.        |
| `DELETE` | Utilizado para remover um registro.          |

## Respostas

| Código | Descrição                                                          |
| ------ | ------------------------------------------------------------------ |
| `200`  | Requisição executada com sucesso (success).                        |
| `201`  | Registro Criado com sucesso.                                       |
| `400`  | Erros de validação ou os campos informados não existem no sistema. |
| `500`  | Erro interno do servidor.                                          |

## Padrão de Retorno dos dados

-   Request (application/json)

    -   Body

        ```
          {
            "success": true/false,
            "data": Object/String
          }
        ```

-   Response 201 (application/json)

    -   Body

        ```
          {
            "success": true,
            "data": [
              {
                "id": "69a9eff3-d4e6-43c1-a38d-a32367f6918b",
                "name": "dGVzdGU="
              }
            ]
          }
        ```

Caso a requisição não conter nenhuma resposta ou falhar o retorno será:

-   Response 400(Aplication/json)

    ```
      {
        "success": false,
        "data": "Invalid User"
      }
    ```

    <hr>

<h4>Desenvolvido por: <strong style="color: #1f6feb; align: center">Luís Afonso Caputo</strong></h4>
