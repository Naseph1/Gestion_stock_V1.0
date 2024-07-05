<?php

    require('action/database.php');

    //afficher la liste des fournisseur

    $categorie = $bdd->prepare('SELECT ID_CATEGORIE,NOM_CATEGORIE from categorie');
    $categorie->execute();
    $categorieliste = $categorie->fetchAll();