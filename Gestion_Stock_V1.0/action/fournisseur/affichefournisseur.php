<?php

    require('action/database.php');

    //afficher la liste des fournisseur

    $fournisseur = $bdd->prepare('SELECT * from fournisseur');
    $fournisseur->execute();
    $fournisseurliste = $fournisseur->fetchAll();
