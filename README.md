
# Laravel - Projeto Acadêmico | Fatec Indaiatuba

Aplicação web desenvolvida como projeto acadêmico na Fatec Indaiatuba, com foco em simular o ciclo completo de desenvolvimento de software com base em demandas reais.

---

## Funcionalidades

- CRUD de **Clientes**, **Produtos** e **Pedidos**
- **Dashboard** com gráficos e indicadores
- **Autenticação de usuários** (Laravel Breeze)

---

## Requisitos

- [Docker](https://www.docker.com/)

---

## Como Rodar o Projeto

```bash
# 1. Clonar o repositório
git clone https://github.com/TamaGab/tamadecor.git
cd tamadecor
````

```bash
# 2. Copiar o .env
cp .env.example .env
````

> **Sem esse passo, o script a seguir não funcionará.**
> É ideal ajustar o conteúdo do `.env` conforme suas configurações locais.

```bash
# 3. Dar permissão ao script e rodá-lo
chmod +x start.sh
./start.sh
```

Este script executa:

* Verificação da existência do arquivo `docker/.env`;
* Caso não exista, copia `src/.env` para `docker/.env`;
* Garante que o container MySQL receba as variáveis corretas;
* Executa `docker compose -f docker/docker-compose.yml up -d --build` para subir os containers. (a flag -f indica o local do ambiente docker no projeto)

---

## Observações para Avaliação

Para registrar um novo usuário, utilize a rota `/register`.

Não há um botão visível que leve a essa rota na interface de login, pois, na proposta do projeto, **o cadastro de usuários seria feito pelo um provedor do serviço**, e não pelo próprio cliente.
Essa escolha foi feita para simular um cenário realista, onde os acessos são gerenciados pela empresa provedora.

---

## Sobre os Containers

Os serviços definidos em `docker-compose.yml` incluem:

* **app**: Laravel com dependências PHP e Node (via `Dockerfile`)
* **mysql**: Banco de dados MySQL
* **nginx**: Servidor web
* **node**: Executa `npm install && npm run dev` automaticamente ao subir

> O objetivo foi tornar o projeto o mais **plug and play** possível, com o mínimo de configuração manual.
> Testado em dois computadores diferentes — funcionou diretamente com o `start.sh`.

---

## Reiniciando o Ambiente

**Não execute novamente o `start.sh` para reiniciar o ambiente**, pois ele usa `--build` e isso pode apagar os dados do banco.

Em vez disso, use:

```bash
#1. Derrubar os containers
docker compose -f docker/docker-compose.yml down

#2. Subir os containers
docker compose -f docker/docker-compose.yml up -d
```

**Alternativa:**

```bash
#1. Mudar para o diretório docker
cd docker

#2. Derrubar os containers
docker compose down

#3. Subir os containers
docker compose up -d
```

---

## Estrutura dos Arquivos `.env`

* `src/.env` → Variáveis do App. Usado pelo Laravel
* `docker/.env` → Variáveis do Banco de Dados. Usado pelo container MySQL (definido no `docker-compose.yml`)

---

## Equipe

Desenvolvido por estudantes da Fatec Indaiatuba:

* Gabriel Tamarossi (TamaGab)
* Gustavo Henrique Camargo Felizardo (Scott1Mjc)
* João Pedro Souza Silva (Não participa da matéria Linguagem de Programação)
* Samuel José Santos Ribeiro da Silva (SamukaRibeiro117)


