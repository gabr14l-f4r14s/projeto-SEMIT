<?php

// Configurações de conexão com o banco de dados.
$host = 'localhost';
$dbname = 'pizzaria_mvc';
$user = 'root';
$password = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try {

    // Cria a conexão PDO utilizada por toda a aplicação.
    $pdo = new PDO($dsn, $user, $password);

    // Configura o PDO para lançar exceções em caso de erro.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    // Encerra a execução caso a conexão não seja estabelecida.
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}