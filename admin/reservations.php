<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'los_pollos_hermanos';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM reservations ORDER BY date_creation DESC");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<div id="admin-header-include"></div>
<head>
    <meta charset="UTF-8">
    <title>Réservations - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 30px; }
        h1 { color: #d92d2d; }
        table { border-collapse: collapse; width: 100%; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #d92d2d; color: white; }
    </style>
</head>
<body>

<h1>📋 Liste des Réservations</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date</th>
            <th>Service</th>
            <th>Réservé le</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($reservations as $res): ?>
        <tr>
            <td><?= htmlspecialchars($res['id']) ?></td>
            <td><?= htmlspecialchars($res['nom']) ?></td>
            <td><?= htmlspecialchars($res['email']) ?></td>
            <td><?= htmlspecialchars($res['date_reservation']) ?></td>
            <td><?= htmlspecialchars($res['service']) ?></td>
            <td><?= htmlspecialchars($res['date_creation']) ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>

</table>

</body>
</html>
<script>
    fetch('admin_header.html')
        .then(res => res.text())
        .then(html => {
            document.getElementById('admin-header-include').innerHTML = html;
        });
</script>