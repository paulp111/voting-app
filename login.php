<?php
session_start();
$error = "";

$users = [
    "admin" => "admin",
    "user" => "user"
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION["username"] = $username;
        if ($username === "admin") {
            $_SESSION["admin"] = true;
        }
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
    <title>Login</title>
    <link rel="stylesheet" href="/css/pico.classless.min.css">
</head>

<body>
    <main class="container">
        <h2>Login</h2>
        <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
        <form method="POST">
            <label>Benutzername</label>
            <input type="text" name="username" required>
            <label>Passwort</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <a href="index.php" role="button">Zurück zur Startseite</a>
    </main>
</body>

</html>