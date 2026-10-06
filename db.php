<?php
// Database connection settings.
// Update these four values to match your hosting environment (e.g. XAMPP locally,
// or the database credentials your hosting provider gives you).

$db_host = "localhost";
$db_name = "pastimes";
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO(
        "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
        $db_user,
        $db_pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

session_start();
