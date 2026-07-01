# Bella Pizza Manager

Sistema web para gerenciamento de uma pizzaria desenvolvido em **PHP** utilizando **arquitetura MVC**, **MySQL**, **PDO**, **Bootstrap**, **CSS personalizado** e **JavaScript**.

O sistema permite gerenciar pizzas e ingredientes por meio de um CRUD completo, além de aplicar regras de negócio, validações e medidas de segurança para garantir a consistência dos dados e proporcionar uma boa experiência ao usuário.

---

# Funcionalidades

## Pizzas

- Listagem de pizzas cadastradas
- Cadastro de novas pizzas
- Edição de pizzas
- Exclusão de pizzas com modal de confirmação
- Associação de múltiplos ingredientes
- Atualização automática do status da pizza conforme a disponibilidade dos ingredientes

## Ingredientes

- Cadastro de novos ingredientes
- Listagem de ingredientes
- Alteração de disponibilidade
- Exclusão de ingredientes
- Bloqueio da exclusão caso o ingrediente esteja associado a alguma pizza

## Interface

- Dashboard administrativo
- Sidebar de navegação
- Topbar com data e horário atualizados dinamicamente
- Layout responsivo
- Modais personalizados
- Cards informativos
- Tabelas estilizadas

---

# Regras de negócio

- Toda pizza deve possuir pelo menos um ingrediente.
- Toda pizza deve possuir nome e preço válidos.
- Não é permitido cadastrar duas pizzas com o mesmo nome.
- Não é permitido cadastrar dois ingredientes com o mesmo nome.
- Ingredientes utilizados por alguma pizza não podem ser excluídos.
- O status da pizza é atualizado automaticamente de acordo com a disponibilidade dos ingredientes cadastrados.
- O preço pode ser informado utilizando vírgula, sendo convertido automaticamente para o formato aceito pelo banco de dados.

---

# Tecnologias utilizadas

- PHP
- Arquitetura MVC
- MySQL
- PDO
- HTML5
- CSS3
- Bootstrap 5
- JavaScript
- phpMyAdmin
- Laragon

## Ambiente de desenvolvimento

- PHP 8.x
- Apache 2.4.66
- MySQL 8.4.3
- Laragon
- phpMyAdmin

---

# Segurança e validações

Durante o desenvolvimento foram implementadas algumas boas práticas visando maior segurança e confiabilidade da aplicação.

## Segurança

- Utilização de **PDO** com **Prepared Statements**, reduzindo riscos de SQL Injection.
- Utilização de **htmlspecialchars()** para reduzir riscos de Cross-Site Scripting (XSS) na exibição de dados.

## Validações

- Campos obrigatórios.
- Impedimento de cadastro de pizzas sem ingredientes.
- Impedimento de cadastro de pizzas sem nome.
- Impedimento de cadastro de pizzas sem preço.
- Impedimento de cadastro de ingredientes sem nome.
- Impedimento de cadastro de pizzas duplicadas.
- Impedimento de cadastro de ingredientes duplicados.
- Impedimento de exclusão de ingredientes que estejam sendo utilizados por alguma pizza.

---

# Estrutura do projeto

```text
config/
controllers/
database/
models/
public/
│── css/
│── img/
│── js/
views/
index.php
README.md
```

---

# Como executar o projeto

## 1. Clonar ou baixar o projeto

Clone este repositório ou faça o download dos arquivos.

## 2. Mover o projeto

Coloque a pasta do projeto dentro da pasta **www** do Laragon.

Exemplo:

```text
C:\laragon\www\projeto-SEMIT
```

## 3. Iniciar o Laragon

Abra o Laragon(v8.6.1) e clique em **Start All** para iniciar:

- Apache 2.4.66
- MySQL 8.4.3

## 4. Instalar o phpMyAdmin (caso necessário)

Caso o phpMyAdmin não esteja instalado no Laragon, faça a instalação pelo próprio programa.

No Laragon, acesse:

```text
Menu → Tools → Quick add → phpMyAdmin
```

Selecione uma versão disponível do phpMyAdmin e conclua a instalação.

Após a instalação, acesse:

```text
http://localhost/phpmyadmin

```

```text
Usuário: root
Senha: (deixe em branco)
```

## 5. Criar o banco de dados

Crie um banco chamado:

```text
pizzaria_mvc
```

## 6. Importar o banco

Selecione o banco **pizzaria_mvc**, clique em **Import**, escolha o arquivo:

```text
database/pizzaria_mvc.sql
```
Em seguida, clique em **import** novamente para importar todas as tabelas e registros do banco de dados.

## 7. Executar a aplicação

Acesse a url.

Abra o navegador e acesse a URL correspondente ao nome da pasta do projeto.

Caso tenha utilizado **git clone**:

```text
http://localhost/projeto-SEMIT/index.php
```

Caso tenha utilizado o **Download ZIP**:

```text
http://localhost/projeto-SEMIT-main/index.php
