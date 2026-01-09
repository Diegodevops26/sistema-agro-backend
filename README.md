# 🚜 Sistema Agro - API (Backend)

> API RESTful desenvolvida para gestão de serviços, recursos e agendamentos agrícolas.

## 💻 Sobre o Projeto

O **Sistema Agro** é uma solução para otimizar a logística e operação no campo. Este repositório contém o **Back-end** da aplicação, responsável por toda a regra de negócios, autenticação e gerenciamento de dados.

O sistema permite que administradores cadastrem fazendas, maquinários e serviços, além de gerenciar agendamentos de técnicos para realização de atividades em campo.

---

## 🛠️ Tecnologias Utilizadas

O projeto foi desenvolvido utilizando as seguintes tecnologias:

- **[PHP 8.2+](https://www.php.net/)**
- **[Laravel 11](https://laravel.com/)** - Framework PHP robusto.
- **[MySQL](https://www.mysql.com/)** - Banco de dados relacional.
- **[Laravel Sanctum](https://laravel.com/docs/11.x/sanctum)** - Sistema de autenticação via Tokens (API Tokens).
- **[Postman/Insomnia](https://www.postman.com/)** - Para testes das rotas.

---

## ⚙️ Funcionalidades e Arquitetura

A API segue o padrão MVC e REST, fornecendo os seguintes recursos:

- **🔐 Autenticação Segura:**
  - Registro e Login de usuários.
  - Proteção de rotas via Token Bearer (Sanctum).
  - Controle de Logout.

- **🚜 Gestão de Recursos (Maquinário):**
  - Cadastro de tratores, drones e equipamentos (CRUD completo).
  - Controle de status (Operacional, Manutenção).

- **🏡 Gestão de Propriedades:**
  - Cadastro de fazendas e locais de serviço.
  - Associação com agricultores.

- **🛠️ Catálogo de Serviços:**
  - Definição de tipos de serviços (Plantio, Pulverização, Análise de Solo).
  - Precificação base.

- **📅 Agendamentos Inteligentes:**
  - Vínculo entre Técnico, Serviço, Propriedade e Recursos.
  - Validação de datas e horários.
  - Relacionamento "Muitos para Muitos" entre Agendamentos e Recursos.

---

## 🚀 Como Executar o Projeto

### Pré-requisitos
Antes de começar, você precisa ter instalado em sua máquina:
- [Git](https://git-scm.com)
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone [https://github.com/SEU-USUARIO/sistema-agro-backend.git](https://github.com/SEU-USUARIO/sistema-agro-backend.git)
   cd sistema-agro-backend

   2. **Instale as dependências do PHP**
   ```bash
   composer install

   cp .env.example .env


   📝 Status do Projeto
✅ Backend: Finalizado (Estrutura, Banco de Dados, API REST). 🚧 Frontend: Em desenvolvimento (React + Vite).

Feito com 💜 por Diego (Sistema Agro).

   
