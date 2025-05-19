#!/bin/bash

# Caminhos relativos
ENV_FILE=".env"
SRC_ENV_FILE="src/.env"

echo "🚀 Iniciando ambiente Laravel..."

# Verifica se o .env da raiz existe
if [ ! -f "$ENV_FILE" ]; then
  if [ -f "$SRC_ENV_FILE" ]; then
    echo "📄 .env na raiz não encontrado. Copiando de src/.env..."
    cp "$SRC_ENV_FILE" "$ENV_FILE"
  else
    echo "❌ Nenhum .env encontrado em src/.env para copiar."
    echo "Crie o arquivo src/.env ou copie manualmente."
    exit 1
  fi
else
  echo "✅ .env já existe na raiz. Tudo certo."
fi

# Sobe os containers com build
echo "🐳 Subindo os containers com docker compose..."
docker compose up -d --build
