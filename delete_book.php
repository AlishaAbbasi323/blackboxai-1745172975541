<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

$booksFile = 'books.json';
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true);
}

$id = $_GET['id'] ?? null;
if ($id === null || !isset($books[$id])) {
    header('Location: index.php');
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$book = $books[$id];

// Check access: admin or owner
if ($role !== 'admin' && $book['username'] !== $username) {
    header('Location: index.php');
    exit();
}

unset($books[$id]);
$books = array_values($books); // reindex array

file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT));

header('Location: user.php');
exit();
