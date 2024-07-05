<?php 


    // au click du bouton enregistrer
    if (isset($_POST['validate'])) {

        //verifier si la saisie entrer est valide

        if ((!empty($_POST['nom_gerant']))  &&  (!empty($_POST['contact_gerant'])) && (!empty($_POST['sexe_gerant']))) {
            $nom_gerant = htmlspecialchars($_POST['nom_gerant']);
            $contact_gerant = htmlspecialchars($_POST['contact_gerant']);
            $sexe_gerant = htmlspecialchars($_POST['sexe_gerant']);

            //verifier si le gerant existe

            $checkifgerantexist = $bdd->prepare('SELECT * FROM gerant where NOM_GERANT = ?');
            $checkifgerantexist->execute(array($nom_gerant));
            $idcount = $bdd->prepare('SELECT count(*) from gerant');
            $idcount->execute();
            $idcount = $idcount->fetchColumn();

            if ($checkifgerantexist->rowcount() == 0) {
                
                //enregistrer le nouveau gerant

                $insert = $bdd->prepare("INSERT INTO gerant(ID_GERANT,ID_ADMINISTRATEUR,NOM_GERANT,CONTACT_GERANT,SEXE) VALUES (?,?,?,?,?)");
                $insert->execute(array(($idcount+1),$_SESSION['id'],$nom_gerant,$contact_gerant,$sexe_gerant));

                echo"<meta http-equiv='refresh' content='0'>";
            }else{
                $errormsg =  "ce gerant a deja ete enregistrer";
            }

        }else{
            $errormsg = "veuillez remplir tous les champs";
        }
    }


    //supprimer un gerant

    if(isset($_POST['delete'])){
        $delete = $bdd->prepare("DELETE FROM `gerant` WHERE `gerant`.`ID_GERANT` = ?");
        $delete->execute(array($_POST['num']));
        echo"<meta http-equiv='refresh' content='0'>";
    }

    //conserver l'id de la colonne
    if(isset($_POST['edit'])){
        $num = $_POST['num'];
    }

    // modifier les informations d'un gerant

    if(isset($_POST['edit2'])){


        //verifier si la saisie entrer est valide

        if ((!empty($_POST['modifnom_gerant']))  &&  (!empty($_POST['modifcontact_gerant']))  &&  (!empty($_POST['modifsexe_gerant']))) {
            $modifnom_gerant = htmlspecialchars($_POST['modifnom_gerant']);
            $modifcontact_gerant = htmlspecialchars($_POST['modifcontact_gerant']);
            $modifsexe_gerant = htmlspecialchars($_POST['modifsexe_gerant']);

            //verifier si le gerant existe

            $checkifgerantexist = $bdd->prepare('SELECT * FROM gerant where NOM_GERANT = ?  and CONTACT_GERANT	= ?');
            $checkifgerantexist->execute(array($modifnom_gerant,$modifcontact_gerant));

            if ($checkifgerantexist->rowcount() == 0) {
                
                //modifier le fournisseur

                $insert = $bdd->prepare("UPDATE gerant SET NOM_GERANT = ?, CONTACT_GERANT = ?, SEXE = ? WHERE ID_GERANT = ?");
                $insert->execute(array($modifnom_gerant,$modifcontact_gerant,$modifsexe_gerant,$_POST['num']));
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