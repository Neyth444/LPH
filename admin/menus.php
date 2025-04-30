<?php
$pdo = new PDO("mysql:host=localhost;dbname=los_pollos_hermanos;charset=utf8", "root", "");

// add menu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $items = json_encode(explode(",", $_POST['items'])); // liste séparée par virgules

    $stmt = $pdo->prepare("INSERT INTO menus (nom, description, prix, items) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $description, $prix, $items]);
}

// del menu
if (isset($_GET['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM menus WHERE id = ?");
    $stmt->execute([$_GET['delete']]);
}

//pour lire les menus
$menus = $pdo->query("SELECT * FROM menus ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<div id="admin-header-include"></div>
<head>
    <meta charset="UTF-8">
    <title>Menus - Admin</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 30px; background: #f4f4f4; }
        h1 { color: #d92d2d; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #d92d2d; color: white; }
        form { margin-top: 30px; background: white; padding: 20px; border-radius: 5px; }
        input, textarea { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { padding: 10px 20px; background: #d92d2d; color: white; border: none; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>

<h1>🍗 Gestion des Menus</h1>

<h2>Ajouter un Menu</h2>
<form method="POST">
    <input type="text" name="nom" placeholder="Nom du menu" required>
    <textarea name="description" placeholder="Description du menu" required></textarea>
    <input type="text" name="prix" placeholder="Prix (ex: 12.90)" required>
    <input type="text" name="items" placeholder="Items (séparés par des virgules)" required>
    <button type="submit">Ajouter</button>
</form>

<h2>Liste des Menus</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Items</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
        <tr>
            <td><?= $menu['id'] ?></td>
            <td><?= htmlspecialchars($menu['nom']) ?></td>
            <td><?= htmlspecialchars($menu['description']) ?></td>
            <td><?= $menu['prix'] ?>€</td>
            <td>
                <ul>
                    <?php foreach (json_decode($menu['items']) as $item): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </td>
            <td>
                <a href="?delete=<?= $menu['id'] ?>" onclick="return confirm('Supprimer ce menu ?')">❌ Supprimer</a>
            </td>
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