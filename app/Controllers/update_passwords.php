<?php

$servername = "127.0.0.1";
$username = "root";
$password = "password";
$dbname = "mecanica2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT id, senha FROM user";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $senha = $row['senha'];

        $hash = password_hash($senha, PASSWORD_DEFAULT);

        $update_sql = "UPDATE user SET senha = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $hash, $id);
        $stmt->execute();
    }
    echo "Senhas atualizadas com sucesso.";
} else {
    echo "Nenhum registro encontrado.";
}

$conn->close();
