<!--  -->
<?php
    // require('database.php');

    // au click du bouton enregistrer
    if (isset($_POST['validate'])) {

        //verifier si la saisie entrer est valide

        if ((!empty($_POST['nom_produit'])) &&  (!empty($_POST['description_produit'])) && (!empty($_POST['prix_produit'])) && (!empty($_POST['quantite'])) && (!empty($_POST['nom_fournisseur'])) && (!empty($_POST['categorie_produit'])) && (!empty($_POST['datelivraison'])) && (!empty($_POST['dateperemption']))) {
            $nom_produit = htmlspecialchars($_POST['nom_produit']);
            $description_produit = htmlspecialchars(nl2br($_POST['description_produit']));
            $prix_produit = htmlspecialchars($_POST['prix_produit']);
            $quantite = htmlspecialchars($_POST['quantite']);
            $fournisseur = htmlspecialchars($_POST['nom_fournisseur']);
            $categorie_produit = htmlspecialchars($_POST['categorie_produit']);;
            $datelivraison = htmlspecialchars($_POST['datelivraison']);
            $dateperemption = htmlspecialchars($_POST['dateperemption']);



            //verifier si le stock existe

            $checkifstockexist = $bdd->prepare('SELECT * FROM stock where NOM_PRODUIT = ?');
            $checkifstockexist->execute(array($nom_produit));
            
            if ($checkifstockexist->rowcount() > 0) {
                // recuperation de l'id du stock
                $stock = $bdd->prepare('SELECT * FROM stock where NOM_PRODUIT = ?');
                $stock->execute(array($nom_produit));
                $idstock = $stock->fetch();

                // echo "<script language='javascript'> alert('".var_dump($idstock['ID_STOCK'])."')</script>";

                //recuperation de l'id du fournisseur
                $fournisseur_produit = $bdd->prepare('SELECT * FROM fournisseur where NOM_FOURNISSEUR = ?');
                $fournisseur_produit->execute(array($fournisseur));
                $idfournisseur = $fournisseur_produit->fetch();

                // //recuperation de l'id de la categorie
                $categorie = $bdd->prepare('SELECT * FROM categorie where NOM_CATEGORIE = ?');
                $categorie->execute(array($categorie_produit));
                $idcategorie = $categorie->fetch();

                //compte le nombre d'identifiant
                $idcount = $bdd->prepare('SELECT count(ID_PRODUIT) from produit');
                $idcount->execute();
                $idcount = $idcount->fetchColumn();
                // $idcount =0;

                //ajouter le nouveau stock de produit

                $insert = $bdd->prepare("INSERT INTO produit(ID_PRODUIT,ID_STOCK,ID_FOURNISSEUR,ID_CATEGORIE,ID_GERANT,NOM_PRODUIT,DESCRIPTION_PRODUIT,PRIX_PRODUIT,QUANTITE_PRODUIT,FOURNISSEUR,CATEGORIE_PRODUIT,DATE_LIVRAISON_PRODUIT,DATE_PEREMPTION_PRODUIT) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
                $id_stock = $idstock['ID_STOCK'];
                $id_fournisseur = $idfournisseur['ID_FOURNISSEUR'];
                $id_categorie = $idcategorie['ID_CATEGORIE'];
                $id_session = $_SESSION['id'];
                // echo"<script language='javascript'>alert('".$id_session."')</script>";
                $insert->execute(array(($idcount+1),$id_stock,$id_fournisseur,$id_categorie,$id_session,$nom_produit,$description_produit,$prix_produit,$quantite,$fournisseur,$categorie_produit,$datelivraison,$dateperemption));

                //ajouter la quantite de produit au stock

                $quantitestock = $idstock['QUANTITE_DISPONIBLE'];
                $somme = $quantitestock + $quantite;
                // $insertstock = $bdd->prepare("INSERT INTO "); // je veux utiliser les joins ici 
                $insertstock = $bdd->prepare("UPDATE stock set QUANTITE_DISPONIBLE = ? where ID_STOCK = ?");
                $insertstock->execute(array($somme,$id_stock));



                // echo"<meta http-equiv='refresh' content='0'>";
            }else{
                $errormsg =  "le stock de ce produit n'existe pas";
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


        //verifier si la saisie entrer et valide

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