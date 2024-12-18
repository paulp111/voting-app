<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST["title"];
    $image = $_FILES["image"];

    $filename = basename($image["name"]);
    move_uploaded_file($image["tmp_name"], "uploads/" . $filename);

    $stmt = $pdo->prepare("INSERT INTO products (title, image_filename) VALUES (?, ?)");
    $stmt->execute([$title, $filename]);

    header("Location: admin.php");
    exit;
}
?>

<main class="container">
    <h1>Produkt hinzufügen</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Titel</label>
        <input type="text" id="title" name="title" required>
        <label for="image">Bild</label>
        <input type="file" id="image" name="image" required>
        <button type="submit">Hinzufügen</button>
    </form>
</main>
