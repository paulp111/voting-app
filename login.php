<?php
session_start();

$hardcoded_user = "admin";
$hardcoded_password = "pw";

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["username"] === $hardcoded_user && $_POST["password"] === $hardcoded_password) {
        $_SESSION["user"] = $hardcoded_user;
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>
<body>
    <main class="container">
        <article>
            <h2>Login</h2>
            <?php if ($error): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST">
                <label for="username">Benutzername</label>
                <input type="text" id="username" name="username" placeholder="Benutzername eingeben" required>

                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" placeholder="Passwort eingeben" required>

                <button type="submit">Anmelden</button>
            </form>

            <p>Zurück zur <a href="index.php">Startseite</a></p>
        </article>
    </main>
</body>
</html>
