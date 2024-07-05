<?php

    require('database.php');

    if (isset($_POST['validate'])) {
        if ((isset($_POST['username']) && !empty($_POST['username'])) && (isset($_POST['password']) && !empty($_POST['password'])) ) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);

            //liste des admins
            $checkifuserexist = $bdd->prepare('SELECT * from administrateur WHERE NOM_ADMINISTRATEUR = ?');
            $checkifuserexist->execute(array($username));


            if($checkifuserexist->rowcount() > 0){
                $userinfos = $checkifuserexist->fetch();
                if ($password=$userinfos['PASSWORD']) {
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $userinfos['ID_ADMINISTRATEUR'];
                    $_SESSION['nom'] = $userinfos['NOM_ADMINISTRATEUR'];
                    header('Location:index.php');
                }else{
                    $errormsg = "mot de passe incorrect";
                }
            }else{
                //liste des gerants
                $checkifuserexist = $bdd->prepare('SELECT * from gerant WHERE NOM_GERANT = ?');
                $checkifuserexist->execute(array($username));
                if ($checkifuserexist->rowcount() > 0) {
                    $userinfos = $checkifuserexist->fetch();
                    if ($password==$userinfos['PASSWORD']) {
                        $_SESSION['auth'] = true;
                        $_SESSION['id'] = $userinfos['ID_GERANT                                                                 '];
                        $_SESSION['nom'] = $userinfos['NOM_GERANT'];
                        header('Location:index.php');
                    }else{
                        $errormsg = "mot de passe incorrect";
                    }
                } else {
                    $errormsg = "cette utilisateur n'est pas encore inscrit";
                }
            }
        }else{
            $errormsg = "Tous les champs doivent etre rempli";
        }
    }
