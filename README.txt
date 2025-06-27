# Laravel - Projeto Acadêmico | Fatec Indaiatuba

Aplicação web desenvolvida como projeto acadêmico na Fatec Indaiatuba, com foco em simular o ciclo completo de desenvolvimento de software com base em demandas reais.

## FUNCIONALIDADES

* CRUD de Clientes, Produtos e Pedidos
* Dashboard com gráficos e indicadores
* Autenticação de usuários (Laravel Breeze)

## REQUISITOS

* Docker

## COMO RODAR O PROJETO

1. Clonar o repositório
   git clone https://github.com/TamaGab/tamadecor.git
   cd tamadecor

2. Copiar o .env
   cp .env.example .env

   **Sem esse passo, o script a seguir não funcionará.**
   É ideal ajustar o conteúdo do .env conforme suas configurações locais.

3. Dar permissão ao script e rodá-lo

   chmod +x start.sh
   ./start.sh

   Esse script faz o seguinte:

   * Verifica se o arquivo docker/.env existe;
   * Se não existir, copia src/.env para docker/.env;
   * Isso garante que o container MySQL receba as variáveis corretas;
   * Depois, executa o comando docker compose -f docker/docker-compose.yml up -d --build para subir os containers. (o -f docker/docker-compose.yml é necessário para identificar aonde está as configuraçoes do container)


## SOBRE OS CONTAINERS

Os serviços definidos em docker-compose.yml incluem:

* app: Laravel com dependências php e node via Dockerfile
* mysql: Banco de dados
* nginx: Servidor web 
* node: Executa npm install && npm run dev automaticamente toda vez que subir(não há necessidade de executar depois)

O objetivo foi tornar o projeto o mais "plug and play" possível, com o mínimo de configuração manual.
Esse processo foi testado em dois computadores diferentes, e funcionou diretamente com o script start.sh.


## REINICIANDO O AMBIENTE

Para reiniciar os containers, não execute novamente o script start.sh, pois ele utilizará a flag --build, o que reconstruirá os containers e poderá apagar os dados do banco de dados.

Use apenas:

docker compose -f docker/docker-compose.yml up -d

**ALTERNATIVA**

cd docker
docker compose up -d


## ESTRUTURA DOS ARQUIVOS .ENV

* src/.env → usado pelo Laravel
* docker/.env → usado pelo container do MySQL (definido em docker-compose.yml)


## EQUIPE

Desenvolvido por estudantes da Fatec Indaiatuba:

* Gabriel Tamarossi
* Gustavo Henrique Camargo Felizardo
* João Pedro Souza Silva
* Samuel José Santos Ribeiro da Silva
