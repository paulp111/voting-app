<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"], $_POST["vote"])) {
    $id = (int)$_POST["id"];
    $vote = $_POST["vote"];

    if ($vote === "up") {
        $pdo->query("UPDATE products SET upvotes = upvotes + 1 WHERE id = $id");
    } elseif ($vote === "down") {
        $pdo->query("UPDATE products SET downvotes = downvotes + 1 WHERE id = $id");
    }
}

header("Location: index.php");
exit;
?>
