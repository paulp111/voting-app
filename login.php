<?php
session_start();

$hardcoded_user = "admin";
$hardcoded_password = "admin";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["username"] === $hardcoded_user && $_POST["password"] === $hardcoded_password) {
        $_SESSION["admin"] = true; // Admin true
        header("Location: index.php");
        exit;
    } else {
        $error = "Falsche Anmeldedaten!";
    }
}

$hardcoded_standard_user = "user";
$hardcoded_standard_password = "user";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["username"] === $hardcoded_standard_user && $_POST["password"] === $hardcoded_standard_password) {
        $_SESSION["user"] = true; // User true
        header("Location: index.php");
        exit;
    } else {
        $error = "Falsche Anmeldedaten!";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>
<body>
    <main class="container">
        <h2>Admin Login</h2>
        <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
        <form method="POST">
            <label>Benutzername</label>
            <input type="text" name="username" required>
            <label>Passwort</label>
            <input type="password" name="password" required>
            <button type="submit">Anmelden</button>
        </form>
        <a href="index.php">Zurück zur Startseite</a>
    </main>
</body>
</html>

