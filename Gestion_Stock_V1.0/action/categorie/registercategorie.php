
<?php
    // require('database.php');

    // au click du bouton enregistrer
    if (isset($_POST['validate'])) {

        //verifier si la saisie entrer est valide

        if ((!empty($_POST['nom_categorie']))  &&  (!empty($_POST['description_categorie']))) {
            $nom_categorie = htmlspecialchars($_POST['nom_categorie']);
            $description_categorie = htmlspecialchars($_POST['description_categorie']);

            //verifier si le fournisseur

            $checkifuserexist = $bdd->prepare('SELECT * FROM categorie where NOM_CATEGORIE = ?');
            $checkifuserexist->execute(array($nom_categorie));
            $idcount = $bdd->prepare('SELECT count(ID_CATEGORIE) from categorie');
            $idcount->execute();
            $idcount = $idcount->fetchColumn();
            if ($checkifuserexist->rowcount() == 0) {
                
                //enregistrer une nouvelle categorie

                $insert = $bdd->prepare("INSERT INTO categorie(ID_CATEGORIE,NOM_CATEGORIE,DESCRIPTION_CATEGORIE) VALUES (?,?,?)");
                $insert->execute(array(($idcount+1),$nom_categorie,$description_categorie));

                echo"<meta http-equiv='refresh' content='0'>";
            }else{
                $errormsg =  "cette categorie a deja ete enregistrer";
            }

        }else{
            $errormsg = "veuillez remplir tous les champs";
        }
    }

    //supprimer une categorie

    if(isset($_POST['delete'])){
        $delete = $bdd->prepare("DELETE FROM `categorie` WHERE `categorie`.`ID_CATEGORIE` = ?");
        $delete->execute(array($_POST['num']));
        echo"<meta http-equiv='refresh' content='0'>";
    }


    if(isset($_POST['edit'])){
        $num = $_POST['num'];
    }
    // modifier les informations d'une categorie

    if(isset($_POST['edit2'])){


        //verifier si la saisie entrer est valide

        if (!empty($_POST['modifnom_categorie'])) {
            $modifnom_categorie = htmlspecialchars($_POST['modifnom_categorie']);
            // $contact_fournisseur = htmlspecialchars($_POST['modifdescription_categorie']);

            //verifier si le fournisseur existe

            $checkifcategorieexist = $bdd->prepare('SELECT * FROM categorie where NOM_CATEGORIE = ?');
            $checkifcategorieexist->execute(array($modifnom_categorie));

            if ($checkifcategorieexist->rowcount() == 0) {
                
                //modifier la categorie

                $insert = $bdd->prepare("UPDATE categorie SET NOM_CATEGORIE = ? WHERE ID_CATEGORIE = ?");
                $insert->execute(array($modifnom_categorie,$_POST['num']));
                echo"
                    <meta http-equiv='refresh' content='0'>
                ";
            }else{
                $errormsg =  "aucune modification n'a ete apporte";
            }

        }else{
            $errormsg = "veuillez remplir tous ces puttain de champs ";
        } 

        $num ="";
        
    }