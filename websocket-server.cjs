const WebSocket = require("ws");
const http = require("http");

// Criar servidor HTTP
const server = http.createServer((req, res) => {
    // CORS headers
    res.setHeader("Access-Control-Allow-Origin", "*");
    res.setHeader("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
    res.setHeader("Access-Control-Allow-Headers", "Content-Type");

    if (req.method === "OPTIONS") {
        res.writeHead(200);
        res.end();
        return;
    }

    if (req.method === "POST" && req.url === "/broadcast") {
        let body = "";
        req.on("data", (chunk) => {
            body += chunk.toString();
        });
        req.on("end", () => {
            try {
                const data = JSON.parse(body);
                console.log("Mensagem recebida via HTTP:", data);

                // Broadcast para todas as conexões WebSocket
                connections.forEach((connection, id) => {
                    if (connection.readyState === WebSocket.OPEN) {
                        connection.send(JSON.stringify(data));
                    }
                });

                res.writeHead(200, { "Content-Type": "application/json" });
                res.end(JSON.stringify({ success: true }));
            } catch (error) {
                console.error("Erro ao processar mensagem HTTP:", error);
                res.writeHead(400, { "Content-Type": "application/json" });
                res.end(JSON.stringify({ error: "Invalid JSON" }));
            }
        });
        return;
    }

    res.writeHead(200, { "Content-Type": "text/plain" });
    res.end("WebSocket server is running");
});

// Criar servidor WebSocket
const wss = new WebSocket.Server({ server });

// Armazenar conexões ativas
const connections = new Map();

wss.on("connection", (ws, req) => {
    console.log("Nova conexão WebSocket estabelecida");

    // Gerar ID único para a conexão
    const connectionId = Date.now().toString();
    connections.set(connectionId, ws);

    ws.on("message", (message) => {
        try {
            const data = JSON.parse(message);
            console.log("Mensagem recebida:", data);

            // Broadcast para todas as conexões
            connections.forEach((connection, id) => {
                if (connection.readyState === WebSocket.OPEN) {
                    connection.send(JSON.stringify(data));
                }
            });
        } catch (error) {
            console.error("Erro ao processar mensagem:", error);
        }
    });

    ws.on("close", () => {
        console.log("Conexão WebSocket fechada");
        connections.delete(connectionId);
    });

    ws.on("error", (error) => {
        console.error("Erro na conexão WebSocket:", error);
        connections.delete(connectionId);
    });
});

// Iniciar servidor na porta 6001
const PORT = 6001;
server.listen(PORT, () => {
    console.log(`📡 Servidor WebSocket rodando na porta ${PORT}`);
    console.log(`📡 WebSocket: ws://localhost:${PORT}`);
    console.log(`📡 HTTP endpoint: http://localhost:${PORT}/broadcast`);
});

// Graceful shutdown
process.on("SIGINT", () => {
    console.log("\nFechando servidor WebSocket...");
    wss.close(() => {
        server.close(() => {
            console.log("Servidor fechado com sucesso");
            process.exit(0);
        });
    });
});
