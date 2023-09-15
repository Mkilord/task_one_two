<?php
$host = 'localhost';
$dbname = 'myappdb';
$username = 'admin';
$password = 'nk(il1C]OyzhydXz';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die("Error connecting to the database: " . $e->getMessage());
}
?>
