<?php
session_start();

$host = 'localhost';
$dbname = 'los_pollos_hermanos';
$user = 'root';
$pass = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && hash('sha256', $password) === $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: index.php");
            exit;
        } else {
            $error = "Identifiants invalides.";
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <style>
        body { font-family: Arial; padding: 30px; background: #f2f2f2; }
        form { background: white; padding: 20px; border-radius: 8px; max-width: 400px; margin: auto; }
        input { display: block; width: 100%; padding: 10px; margin: 10px 0; }
        button { padding: 10px 20px; background: #d92d2d; color: white; border: none; }
        .error { color: red; }
    </style>
</head>
<body>

<h2>Connexion à l'espace admin</h2>
<form method="post">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Connexion</button>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</form>

</body>
</html>
