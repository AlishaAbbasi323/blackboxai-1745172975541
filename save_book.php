<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_book.php');
    exit();
}

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$description = trim($_POST['description'] ?? '');
$contact = trim($_POST['contact'] ?? '');
$username = $_SESSION['username'];

$errors = [];

if ($title === '') {
    $errors[] = 'Title is required.';
}
if ($author === '') {
    $errors[] = 'Author is required.';
}
if ($description === '') {
    $errors[] = 'Description is required.';
}
if ($contact === '' || !filter_var($contact, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid contact email is required.';
}

if (!empty($errors)) {
    $_SESSION['form_errors'] = $errors;
    $_SESSION['form_data'] = $_POST;
    header('Location: add_book.php');
    exit();
}

$booksFile = 'books.json';
$books = [];
if (file_exists($booksFile)) {
    $books = json_decode(file_get_contents($booksFile), true);
}

$newBook = [
    'title' => $title,
    'author' => $author,
    'description' => $description,
    'contact' => $contact,
    'username' => $username
];

$books[] = $newBook;

file_put_contents($booksFile, json_encode($books, JSON_PRETTY_PRINT));

header('Location: index.php');
exit();
