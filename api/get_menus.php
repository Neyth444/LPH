<?php
header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=localhost;dbname=los_pollos;charset=utf8", "root", "");
    $menus = $pdo->query("SELECT * FROM menus")->fetchAll(PDO::FETCH_ASSOC);

    // transforme le champ items de JSON string → array
    foreach ($menus as &$menu) {
        $menu['items'] = json_decode($menu['items']);
    }

    echo json_encode($menus);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
