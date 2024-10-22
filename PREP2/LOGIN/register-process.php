<?php
// Conexão com o banco de dados
$servername = "localhost"; // Ajuste conforme necessário
$username = "root"; // Ajuste conforme necessário
$password = ""; // Ajuste conforme necessário
$dbname = "seu_banco_de_dados"; // Ajuste conforme necessário

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verifica se o email já está cadastrado
    $checkEmailQuery = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        // Email já cadastrado
        echo "Email já cadastrado. Tente outro.";
    } else {
        // Cria um hash da senha para segurança
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insere os dados no banco de dados
        $insertQuery = "INSERT INTO usuarios (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

        if ($conn->query($insertQuery) === TRUE) {
            echo "Registro realizado com sucesso! Agora você pode fazer login.";
        } else {
            echo "Erro ao registrar: " . $conn->error;
        }
    }
}

// Fecha a conexão
$conn->close();
?>
