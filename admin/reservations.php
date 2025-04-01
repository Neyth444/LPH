<?php
// con a la bdd
$pdo = new PDO("mysql:host=localhost;dbname=los_pollos;charset=utf8", "root", "");
$reservations = $pdo->query("SELECT * FROM reservations ORDER BY date_created DESC")->fetchAll(PDO::FETCH_ASSOC);
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
        <?php foreach ($reservations as $resa): ?>
            <tr>
                <td><?= $resa['id'] ?></td>
                <td><?= htmlspecialchars($resa['nom']) ?></td>
                <td><?= htmlspecialchars($resa['email']) ?></td>
                <td><?= $resa['date_reservation'] ?></td>
                <td><?= $resa['service'] ?></td>
                <td><?= $resa['date_created'] ?></td>
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