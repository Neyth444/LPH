<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin • Los Pollos Hermanos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --primary: #d92d2d;
            --dark: #222;
            --light: #fdf6e3;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--light);
            padding: 40px;
            color: #333;
        }

        header {
            margin-bottom: 40px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5rem;
            color: var(--primary);
        }

        .admin-box {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 500px;
            margin: 0 auto;
        }

        .admin-box a {
            display: block;
            text-align: center;
            padding: 15px;
            background-color: var(--primary);
            color: white;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .admin-box a:hover {
            background-color: #a80000;
        }

        footer {
            text-align: center;
            margin-top: 60px;
            color: #999;
            font-size: 0.9rem;
        }

        @media (max-width: 500px) {
            body {
                padding: 20px;
            }

            header h1 {
                font-size: 2rem;
            }

            .admin-box a {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
<div id="admin-header-include"></div>
    <header>
        <h1>Panneau d'administration</h1>
        <p>Bienvenue dans l'espace de gestion de <strong>Los Pollos Hermanos</strong>.</p>
    </header>

    <div class="admin-box">
        <a href="reservations.php">📋 Gérer les réservations</a>
        <a href="menus.php">🍗 Gérer les menus</a>
    </div>

    <footer>
        &copy; <?= date('Y') ?> Los Pollos Hermanos – Admin
    </footer>

</body>
</html>
<script>
    fetch('admin_header.html')
        .then(res => res.text())
        .then(html => {
            document.getElementById('admin-header-include').innerHTML = html;
        });
</script>