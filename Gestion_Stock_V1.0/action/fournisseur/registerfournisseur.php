
<?php
    // require('database.php');

    // au click du bouton enregistrer
    if (isset($_POST['validate'])) {

        //verifier si la saisie entrer est valide

        if ((!empty($_POST['nom_fournisseur']))  &&  (!empty($_POST['contact_fournisseur']))) {
            $nom_fournisseur = htmlspecialchars($_POST['nom_fournisseur']);
            $contact_fournisseur = htmlspecialchars($_POST['contact_fournisseur']);

            //verifier si le fournisseur

            $checkifuserexist = $bdd->prepare('SELECT * FROM fournisseur where NOM_FOURNISSEUR = ?');
            $checkifuserexist->execute(array($nom_fournisseur));

            if ($checkifuserexist->rowcount() == 0) {
                
                //enregistrer le nouveau fournisseur

                $insert = $bdd->prepare("INSERT INTO fournisseur(ID_ADMINISTRATEUR,NOM_FOURNISSEUR,CONTACT_FOURNISSEUR) VALUES (?,?,?)");
                $insert->execute(array($_SESSION['id'],$nom_fournisseur,$contact_fournisseur));

                echo"<meta http-equiv='refresh' content='0'>";
            }else{
                $errormsg =  "ce fournisseur a deja ete enregistrer";
            }

        }else{
            $errormsg = "veuillez remplir tous les champs";
        }
    }

    //supprimer un fournisseur

    if(isset($_POST['delete'])){
        $delete = $bdd->prepare("DELETE FROM `fournisseur` WHERE `fournisseur`.`ID_FOURNISSEUR` = ?");
        $delete->execute(array($_POST['num']));
        echo"<meta http-equiv='refresh' content='0'>";
    }


    if(isset($_POST['edit'])){
        $num = $_POST['num'];
    }
    // modifier les informations d'un fournisseur

    if(isset($_POST['edit2'])){


        //verifier si la saisie entrer est valide

        if ((!empty($_POST['modifnom_fournisseur']))  &&  (!empty($_POST['modifcontact_fournisseur']))) {
            $nom_fournisseur = htmlspecialchars($_POST['modifnom_fournisseur']);
            $contact_fournisseur = htmlspecialchars($_POST['modifcontact_fournisseur']);

            //verifier si le fournisseur existe

            $checkifuserexist = $bdd->prepare('SELECT * FROM fournisseur where NOM_FOURNISSEUR = ?  and CONTACT_FOURNISSEUR	= ?');
            $checkifuserexist->execute(array($nom_fournisseur,$contact_fournisseur));

            if ($checkifuserexist->rowcount() == 0) {
                
                //modifier le fournisseur

                $insert = $bdd->prepare("UPDATE fournisseur SET NOM_FOURNISSEUR = ?, CONTACT_FOURNISSEUR = ? WHERE ID_FOURNISSEUR = ?");
                $insert->execute(array($nom_fournisseur,$contact_fournisseur,$_POST['num']));
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