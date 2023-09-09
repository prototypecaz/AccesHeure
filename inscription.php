<?php

if(
    isset($_POST['prenom']) and !empty($_POST['prenom']) and 
    isset($_POST['nom']) and !empty($_POST['nom']) and 
    isset($_POST['ville']) and !empty($_POST['ville']) and 
    isset($_POST['telephone']) and !empty($_POST['telephone']) and 
    isset($_POST['naissance']) and !empty($_POST['naissance']) and 
    isset($_POST['dateEntrer']) and !empty($_POST['dateEntrer']) and 
    isset($_POST['compte']) and !empty($_POST['compte']) and 
    isset($_POST['password']) and !empty($_POST['password'])){

    require_once('./classes/Sanitizing.php');
    $sanitizing = new Sanitizing();
    $prenom = $sanitizing->sanitizeString($_POST['prenom']);
    $nom = $sanitizing->sanitizeString($_POST['nom']);
    $ville = $sanitizing->sanitizeString($_POST['ville']);
    $telephone = $sanitizing->sanitizeString($_POST['telephone']);
    $naissance = $sanitizing->sanitizeString($_POST['naissance']);
    $dateEntrer = $sanitizing->sanitizeString($_POST['dateEntrer']);
    $compte = $sanitizing->sanitizeString($_POST['compte']);
    
    require_once('./classes/Encryption.php');
    
    $encryption = (object) new Encryption();
    $password = (string) $encryption->passwordHash($_POST['password']);

    require_once('./classes/Database.php');
    
    Database::query(
        'INSERT INTO `employes`(`id`, `employe`, `nomEmploye`, `ville`, `telephone`, `naissance`, `dateEntrer`, `admin`, `password`) VALUES (NULL,(:employe),
        (:nom),(:ville),(:telephone),(:naissance),(:dateEntrer),(:compte),(:password))', 
        [
            ':employe' => $prenom,
            ':nom' => $nom,
            ':ville' => $ville,
            ':telephone' => $telephone,
            ':naissance' => $naissance,
            ':dateEntrer' => $dateEntrer,
            ':compte' => $compte,
            ':password' => $password
        ]
    );

    http_response_code(302);
    header('Location: ./#register');
    exit(); 
    
}else{
    http_response_code(302);
    header('Location: ./#erreur');
    exit(); 
}

?>