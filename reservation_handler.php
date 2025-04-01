<?php
$host = 'localhost';
$dbname = 'los_pollos';
$user = 'root';
$pass = '';

// conn a la bdd
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $date_reservation = $_POST['date-reservation'];
    $service = $_POST['service'];

    $sql = "INSERT INTO reservations (nom, email, date_reservation, service) 
            VALUES (:nom, :email, :date_reservation, :service)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':date_reservation' => $date_reservation,
        ':service' => $service
    ]);

   header("Location: index.html");
   exit;
}

?>
