<?php

// Base de donnée
const BDD_HOST = '127.0.0.1';
const BDD_NAME = 'bd_m314';
const BDD_USER = 'root';
const BDD_PASS = '';

// Connexion à l'administration
const ADMIN_USER = 'Admin';
const ADMIN_PASS = 'sudo';

// connexion à la base de données => sur toutes les pages on aura l'objet $db pour effectuer les requêtes
try {
    $db = new PDO('mysql:host=' . BDD_HOST . ';dbname=' . BDD_NAME, BDD_USER, BDD_PASS);
    $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);             // les noms de champs seront en caractères minuscules
    $db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);  // les erreurs lanceront des exceptions
    $db->exec('SET NAMES utf8');
} catch(Exception $e) {
    die('Une erreur est survenue : impossible de se connecter à la base de données.');
}

?>
