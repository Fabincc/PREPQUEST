const express = require('express');
const app = express();
app.use(express.json());

// Dados simulados (idealmente, use um banco de dados)
let empresas = [];
let candidatos = [];

// Rota para registrar uma empresa
app.post('/empresa', (req, res) => {
    const { nome, treinamentos } = req.body;
    empresas.push({ nome, treinamentos });
    res.send("Empresa registrada com sucesso!");
});

// Rota para listar empresas e treinamentos
app.get('/empresas', (req, res) => {
    res.json(empresas);
});

// Rota para candidatos se inscreverem em cursos
app.post('/candidato', (req, res) => {
    const { nome, curso } = req.body;
    candidatos.push({ nome, curso });
    res.send("Candidato registrado com sucesso!");
});

// Rota para empresas verem candidatos aptos
app.get('/candidatos/:curso', (req, res) => {
    const curso = req.params.curso;
    const candidatosAptos = candidatos.filter(c => c.curso === curso);
    res.json(candidatosAptos);
});

app.listen(3000, () => {
    console.log('Servidor rodando na porta 3000');
});
