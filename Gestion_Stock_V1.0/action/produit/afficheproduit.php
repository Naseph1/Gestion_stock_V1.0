<?php

    require('action/database.php');


    // tableau de produit

    $produit = $bdd->prepare('SELECT * from produit');
    $produit->execute();
    $produitliste = $produit->fetchAll();

    // tableau de fournisseur

    $fournisseur = $bdd->prepare('SELECT NOM_FOURNISSEUR from fournisseur');
    $fournisseur->execute();
    $fournisseurliste = $fournisseur->fetchAll();

    // tableau de categorie

    $categorie = $bdd->prepare('SELECT NOM_CATEGORIE from categorie');
    $categorie->execute();
    $categorieliste = $categorie->fetchAll();