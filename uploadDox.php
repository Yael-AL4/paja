<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['doxTitle']);
    $content = htmlspecialchars($_POST['doxContent']);
    $author = htmlspecialchars($_POST['doxAuthor']);

    if (!isset($_SESSION['user_id'])) {
        die('No estás autenticado.');
    }

    $stmt = $pdo->prepare('INSERT INTO doxes (titulo, contenido, autor) VALUES (?, ?, ?)');
    if ($stmt->execute([$title, $content, $author])) {
        echo 'Doxeo subido exitosamente.';
    } else {
        echo 'Error al subir el doxeo.';
    }
}
?>
