<?php

    require("action/database.php");

    // tableau de gerant

    $gerant = $bdd->prepare('SELECT * from gerant');
    $gerant->execute();
    $gerantliste = $gerant->fetchAll();