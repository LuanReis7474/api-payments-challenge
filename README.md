# 📊 Sistema de Gestão de Projetos e Gastos
Este projeto é uma plataforma de controle financeiro  para gerenciamento de projetos, desenvolvido como parte do meu portfólio. Ele foi projetado para oferecer uma visão clara da saúde financeira de cada empreendimento, desde o orçamento inicial até o custo final que será repassado ao cliente.

Esta hospedado em: https://sistema-gestao-projetos-ppqz.onrender.com/projetos

![GitHub Workflow Status](https://img.shields.io/github/actions/workflow/status/LuanReis7474/sistema-gestao-projetos/test.yml?branch=main&style=for-the-badge&logo=github&label=Build%20Status)
![Laravel Version](https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php)
![Swagger](https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=swagger&logoColor=black)


## 🚀 Tecnologias Utilizadas

* **Backend:** Laravel 12 (PHP 8.2+)
* **Frontend:** Vite 7, Tailwind CSS 4, AlpineJS
* **Banco de Dados:** PostgreSQL (Produção/Desenvolvimento) e SQLite (Testes em Memória)
* **DevOps & CI/CD:** GitHub Actions (Automação de Testes)
* **Testes** Pest

o sistema possui:

* **Testes de Integração (Feature Tests):** Cobertura de fluxo completo utilizando Pest, garantindo que a comunicação entre Controllers, Models e Banco de Dados esteja íntegra.
* **CI/CD Pipeline:** Teste automatizado do fluxo completo de criação de projeto, fornecedores e gastos.
* **Persistência Baseada em Sessão:** Implementação de lógica para isolamento de dados por `session_id`, permitindo o uso simultâneo por múltiplos usuários sem conflitos de dados.

Para rodar o projeto localmente:
```bash

git clone [https://github.com/LuanReis7474/sistema-gestao-projetos.git](https://github.com/LuanReis7474/sistema-gestao-projetos.git)

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate

php artisan serve
```

para rodar os testes localmente: 

```bash

php artisan test --filter FlowTest
```
🔗 **[Acessar a Documentação Interativa no Swagger](https://app.swaggerhub.com/apis-docs/LuanReisDeCarvalho/managerProject/1.0.0)**

<img width="1219" height="541" alt="image" src="https://github.com/user-attachments/assets/b1587337-a42c-4458-bb34-5cea479c8009" />

<img width="1206" height="334" alt="image" src="https://github.com/user-attachments/assets/d1bce906-52ce-4fde-be26-2dcd3d239488" />

<img width="771" height="424" alt="image" src="https://github.com/user-attachments/assets/edcdd556-e3a6-43ce-8840-f1eacf09f9ee" />

<img width="1215" height="304" alt="image" src="https://github.com/user-attachments/assets/ec6511fe-3001-46e0-b64d-be772609fc71" />

<img width="717" height="642" alt="image" src="https://github.com/user-attachments/assets/40d9cb01-6413-4b77-aa7c-28c6d5c53dbe" />







