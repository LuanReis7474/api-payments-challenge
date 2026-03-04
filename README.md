# 📊 Sistema de Gestão de Projetos e Gastos
Este projeto é uma plataforma de controle financeiro de alta precisão para gerenciamento de projetos e fornecedores. Ele foi projetado para oferecer uma visão clara da saúde financeira de cada empreendimento, desde o orçamento inicial até o custo final que será repassado ao cliente.


![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/LuanReis7474/sistema-gestao-projetos/tests.yml?branch=main&style=for-the-badge&logo=github&label=Build%20Status)
![Laravel Version](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)

Este projeto é um sistema robusto para controle financeiro de projetos, desenvolvido como parte do meu portfólio de **Engenharia de Software**. A aplicação permite gerenciar projetos, fornecedores e gastos de forma isolada por sessão, garantindo a privacidade dos dados de simulação de cada usuário.

## 🚀 Tecnologias Utilizadas

* **Backend:** Laravel 12 (PHP 8.2+)
* **Frontend:** Vite 7, Tailwind CSS 4, AlpineJS
* **Banco de Dados:** PostgreSQL (Produção/Desenvolvimento) e SQLite (Testes em Memória)
* **DevOps & CI/CD:** GitHub Actions (Automação de Testes)
* **Testes** Pest

o sistema possui:

* **Testes de Integração (Feature Tests):** Cobertura de fluxo completo utilizando Pest, garantindo que a comunicação entre Controllers, Models e Banco de Dados esteja íntegra.
* **CI/CD Pipeline:** Teste do fluxo completo de criação de projeto, fornecedores e gastos.
* **Persistência Baseada em Sessão:** Implementação de lógica para isolamento de dados por `session_id`, permitindo o uso simultâneo por múltiplos usuários sem conflitos de dados.

Para rodar os testes localmente:
```bash
php artisan test

git clone [https://github.com/LuanReis7474/sistema-gestao-projetos.git](https://github.com/LuanReis7474/sistema-gestao-projetos.git)

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan serve