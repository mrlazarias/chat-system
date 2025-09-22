#!/bin/bash

echo "🚀 Iniciando servidor WebSocket..."
echo "📡 Servidor rodando em: ws://localhost:6001"
echo "💬 Chat em tempo real ativado!"
echo ""
echo "Para parar o servidor, pressione Ctrl+C"
echo ""

node websocket-server.cjs
