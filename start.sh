#!/bin/bash

DOCKER_ENV_FILE="./docker/.env"
SRC_ENV_FILE="./src/.env"

echo "🚀 Iniciando ambiente Laravel..."

# Verifica se o .env do Docker existe
if [ ! -f "$DOCKER_ENV_FILE" ]; then
  if [ -f "$SRC_ENV_FILE" ]; then
    echo "📄 .env do Docker não encontrado. Criando a partir do src/.env..."
    cp "$SRC_ENV_FILE" "$DOCKER_ENV_FILE"
  else
    echo "❌ Nenhum .env encontrado para criar o ambiente Docker."
    exit 1
  fi
else
  echo "✅ docker/.env já existe. Tudo certo."
fi

# Subir containers com build
echo "🐳 Subindo os containers com docker compose..."
cd docker
docker compose up -d --build
