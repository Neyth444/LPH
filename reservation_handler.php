<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Récupération des données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $dateReservation = htmlspecialchars($_POST['date-reservation']);
    $service = htmlspecialchars($_POST['service']);

    // Adresse email du restaurant
    $restaurantEmail = "reservations@lospolloshermanos.com";

    // Sujet du mail envoyé au client
    $subjectClient = "Confirmation de votre réservation chez Los Pollos Hermanos";

    // Corps du mail envoyé au client
    $messageClient = "
Bonjour $nom,

Nous confirmons votre réservation chez Los Pollos Hermanos.

Détails de la réservation :
- Nom : $nom
- Email : $email
- Date : $dateReservation
- Service choisi : $service

Nous sommes impatients de vous accueillir !

Cordialement,
Los Pollos Hermanos
";

    // Headers pour format texte et UTF-8
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/plain;charset=UTF-8\r\n";
    $headers .= "From: Los Pollos Hermanos <".$restaurantEmail.">\r\n";
    $headers .= "Reply-To: $restaurantEmail\r\n";

    // Envoi du mail au client
    if(mail($email, $subjectClient, $messageClient, $headers)){
        // Envoi du mail au restaurant (optionnel)
        $subjectRestaurant = "Nouvelle réservation reçue";
        $messageRestaurant = "
Nouvelle réservation effectuée :

Nom : $nom
Email : $email
Date : $dateReservation
Créneau : $service
";

        mail($restaurantEmail, $subjectRestaurant, $messageRestaurant, $headers);

        // Répondre au frontend
        echo "Réservation effectuée avec succès. Un email de confirmation a été envoyé à : $email";
    } else {
        http_response_code(500);
        echo "Erreur lors de l'envoi du mail.";
    }
} 
?>
