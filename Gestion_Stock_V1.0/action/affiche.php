<?php
 
    require('database.php');

    //afficher le nombre de forunisseur

    $fournisseur = $bdd->prepare('SELECT COUNT(*) FROM fournisseur');
    $fournisseur->execute();
    $nombrefournisseur = $fournisseur->fetchColumn();

    // afficher le nombre de gerant
    $gerant = $bdd->prepare('SELECT COUNT(*) FROM gerant');
    $gerant->execute();
    $nombregerant = $gerant->fetchColumn();

    //afficher le nombre de stock
    $stock = $bdd->prepare('SELECT COUNT(*) FROM stock');
    $stock->execute();
    $nombrestock = $stock->fetchColumn();