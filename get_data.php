<?php
include 'db.php';

// Simuler la récupération des données des capteurs
// En pratique, cela pourrait provenir d'une API ou d'un dispositif embarqué
$data = [
    'id_personne' => 1,
    'id_vehicule' => 1,
    'vitesse' => 85, // vitesse mesurée
    'vitesse_limite' => 40 // vitesse limite
];

// Vérifier si la vitesse dépasse la limite
if ($data['vitesse'] > $data['vitesse_limite']) {
    // Insérer l'infraction dans la base de données
    $stmt = $pdo->prepare("INSERT INTO infraction (date_infraction, type_infraction, id_personne, id_vehicule) VALUES (NOW(), 'Excès de vitesse', ?, ?)");
    $stmt->execute([$data['id_personne'], $data['id_vehicule']]);

    // Envoyer un email au propriétaire
    $stmt = $pdo->prepare("SELECT email FROM personne WHERE id_personne = ?");
    $stmt->execute([$data['id_personne']]);
    $email = $stmt->fetchColumn();

    if ($email) {
        mail($email, "Infraction de vitesse", "Vous avez été enregistré en excès de vitesse.");
    }
}
