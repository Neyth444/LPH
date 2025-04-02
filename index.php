<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Pollos Hermanos - Réservation</title>
    <link rel="stylesheet" href="./css/bodyFont.css">
    <link rel="stylesheet" href="./css/reservation.css">
    <link rel="stylesheet" href="./css/presentation.css">
    <link rel="stylesheet" href="./css/bodyFont.css">
    <link rel="stylesheet" href="./css/menu.css">


</head>
<body>

<?php
include "header.php";
include "presentation.php";
include "menus.php";

?>



  

<section id="reservation-section">
    <h2>Réservez votre table</h2>
    <form id="reservation-form" method="POST" action="reservation_handler.php">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="date-reservation">Date :</label>
        <input type="date" id="date-reservation" name="date-reservation" required>

        <label for="service">Créneau horaire :</label>
        <select id="service" name="service" required>
            <option value="10h-14h">10h - 14h</option>
            <option value="14h-20h">14h - 20h</option>
            <option value="20h-00h">20h - 00h</option>
        </select>

        <button type="submit">Réserver</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 Los Pollos Hermanos. Tous droits réservés.</p>
</footer>

<script src="./javascript/script.js"></script>

</body>
</html>
