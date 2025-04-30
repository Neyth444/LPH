<?php
$host = 'localhost';
$dbname = 'los_pollos_hermanos';
$user = 'root';
$pass = '';

// connexion a la bdd
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// evite les failles xss et injection sql  en validant les données utilisateurs.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = htmlspecialchars(trim($_POST['nom']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $date_reservation = $_POST['date-reservation'];
    $service = $_POST['service'];

    if (!$email) {
        die("Adresse email invalide.");
    }

    $sql = "INSERT INTO reservations (nom, email, date_reservation, service) 
            VALUES (:nom, :email, :date_reservation, :service)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':date_reservation' => $date_reservation,
        ':service' => $service
    ]);

    header("Location: index.php?confirmation=1");
    exit;
}
?>
