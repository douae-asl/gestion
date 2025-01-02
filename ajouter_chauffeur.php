<?php
// Configuration de la base de données
$host = "localhost";
$dbname = "TPSI";
$username = "root"; // Remplacez par le nom d'utilisateur de votre base de données
$password = ""; // Remplacez par le mot de passe de votre base de données

try {
    // Connexion à la base de données
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si les données du formulaire sont envoyées
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $id_chauffeur = $_POST["id_chauffeur"];
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $contact = $_POST["contact"];

        // Préparer la requête SQL
        $sql = "INSERT INTO Chauffeur (
                    id_chauffeur, 
                    nom, 
                    prenom, 
                    contact
                ) VALUES (
                    :id_chauffeur, 
                    :nom, 
                    :prenom, 
                    :contact
                )";

        $stmt = $pdo->prepare($sql);

        // Lier les paramètres
        $stmt->bindParam(":id_chauffeur", $id_chauffeur);
        $stmt->bindParam(":nom", $nom);
        $stmt->bindParam(":prenom", $prenom);
        $stmt->bindParam(":contact", $contact);

        // Exécuter la requête
        if ($stmt->execute()) {
            echo "Le chauffeur a été ajouté avec succès. <a href='chauffeur.html'>Retourner au formulaire</a>";
        } else {
            echo "Une erreur s'est produite lors de l'ajout du chauffeur.";
        }
    }
} catch (PDOException $e) {
    // Gérer les erreurs de connexion
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>