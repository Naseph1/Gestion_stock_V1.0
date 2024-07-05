
<?php
    // require('database.php');

    // au click du bouton enregistrer
    if (isset($_POST['validate'])) {

        //verifier si la saisie entrer est valide

        if ((!empty($_POST['nom_produit']))  &&  (!empty($_POST['description_produit'])) && (!empty($_POST['prix_produit'])) && (!empty($_POST['quantite'])) && (!empty($_POST['fournisseur'])) && (!empty($_POST['dateajout'])) && (!empty($_POST['dateexpiration']))) {
            $nom_produit = htmlspecialchars($_POST['nom_produit']);
            $description_produit = htmlspecialchars(nl2br($_POST['description_produit']));
            $prix_produit = htmlspecialchars($_POST['prix_produit']);
            $quantite = htmlspecialchars($_POST['quantite']);
            $fournisseur = htmlspecialchars($_POST['fournisseur']);
            $dateajout = htmlspecialchars($_POST['dateajout']);
            $dateexpiration = htmlspecialchars($_POST['dateexpiration']);

            //verifier si le stock existe

            $checkifstockexist = $bdd->prepare('SELECT * FROM stock where NOM_PRODUIT = ?');
            $checkifstockexist->execute(array($nom_produit));
            $idcount = $bdd->prepare('SELECT count(ID_STOCK) from stock');
            $idcount->execute();
            $idcount = $idcount->fetchColumn();
            if ($checkifstockexist->rowcount() == 0) {
                
                //enregistrer le nouveau stock de produit

                
                $insert = $bdd->prepare("INSERT INTO stock(ID_STOCK,NOM_PRODUIT,DESCRIPTION,QUANTITE_DISPONIBLE,DATE_D_AJOUT,DATE_D_EXPIRATION,FOURNISSEUR,PRIX_PRODUIT) VALUES (?,?,?,?,?,?,?,?)");
                $insert->execute(array(($idcount+1),$nom_produit,$description_produit,$quantite,$dateajout,$dateexpiration,$fournisseur,$prix_produit));

                echo"<meta http-equiv='refresh' content='0'>";
            }else{
                $errormsg =  "ce stock a deja ete enregistrer";
            }

        }else{
            $errormsg = "veuillez remplir tous les champs";
        }
    }

    //supprimer un stock

    if(isset($_POST['delete'])){
        $delete = $bdd->prepare("DELETE FROM `stock` WHERE `stock`.`ID_STOCK` = ?");
        $delete->execute(array($_POST['num']));
        echo"<meta http-equiv='refresh' content='0'>";
    }


    if(isset($_POST['edit'])){
        $num = $_POST['num'];
    }
    // modifier les informations d'un fournisseur

    if(isset($_POST['edit2'])){


        //verifier si la saisie entrer est valide

        if ((!empty($_POST['modifnom_produit'])) && (!empty($_POST['modifprix_produit'])) && (!empty($_POST['modifquantite'])) && (!empty($_POST['modiffournisseur'])) && (!empty($_POST['modifdateajout'])) && (!empty($_POST['modifdateexpiration']))) {
            $modifnom_produit = htmlspecialchars($_POST['modifnom_produit']);
            $modifquantite = htmlspecialchars($_POST['modifquantite']);
            $modifdateajout = htmlspecialchars($_POST['modifdateajout']);
            $modifdateexpiration = htmlspecialchars($_POST['modifdateexpiration']);   
            $modiffournisseur = htmlspecialchars($_POST['modiffournisseur']);
            $modifprix_produit = htmlspecialchars($_POST['modifprix_produit']);
            

            //verifier si le fournisseur existe

            $checkifstockexist = $bdd->prepare('SELECT * FROM stock where NOM_PRODUIT = ?');
            $checkifstockexist->execute(array($modifnom_produit));

            if ($checkifstockexist->rowcount() != 0) {
                
                //modifier un stock

                $insert = $bdd->prepare("UPDATE stock SET NOM_PRODUIT = ?, QUANTITE_DISPONIBLE = ? , DATE_D_AJOUT = ?, DATE_D_EXPIRATION = ?, FOURNISSEUR = ?, PRIX_PRODUIT = ? WHERE ID_STOCK = ?");
                $insert->execute(array($modifnom_produit,$modifquantite,$modifdateajout,$modifdateexpiration,$modiffournisseur,$modifprix_produit,$_POST['num']));
                echo"
                    <meta http-equiv='refresh' content='0'>
                ";
            }else{
                $errormsg =  "aucune modification n'a ete apporte";
            }

        }else{
            $errormsg = "veuillez remplir tous ces champs svp";
        } 

        $num ="";
        
    }