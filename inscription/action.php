<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - Compass</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Ton CSS -->
    <link href="../css/styles.css" rel="stylesheet">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#4513DD;">
        <div class="container px-5">
            <a class="navbar-brand" href="#!"><img class="img-fluid rounded mb-4 mb-lg-0" src="../assets/Page 11.png"
                    alt="Fond" style="width: 30px; height: 30px; object-fit: cover;"> Compass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="../vitrine/selection.php">selection</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="../vitrine/select.php">select</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="../vitrine/sel.php">sel</a></li>
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="inscription.php">inscription</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <main class="d-flex justify-content-center align-items-center" style="min-height: 90vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6">

                    <div class="card shadow p-4 text-center">

                        <h3 class="mb-4">Résultat de l'inscription</h3>
                        Bonjour, <?php echo htmlspecialchars(addslashes($_POST['pseudo'])) . "<br>"; ?>.
                        nom : <?php echo htmlspecialchars(addslashes($_POST['nom'])) . "<br>"; ?>
                        prenom : <?php echo htmlspecialchars(addslashes($_POST['prenom'])) . "<br>"; ?>
                        <?php
                        $mysqli = new mysqli('localhost', 'e22408872sql', '#VS2TxpP', 'e22408872_db1');
                        $probleme = 0;
                        //il faut verifier les champs si il sont remplie c'est avce ampty ou metre require dans le code html de chaque balise
                        if (!empty($_POST["pseudo"]) && !empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['code'])) {
                            $id = htmlspecialchars(($_POST['pseudo']));
                            $mdp1 = htmlspecialchars(addslashes($_POST['password']));
                            $mdp2 = htmlspecialchars(addslashes($_POST['confirm_password']));

                            $nom = htmlspecialchars(addslashes($_POST['nom']));
                            $prenom = htmlspecialchars(addslashes($_POST['prenom']));
                            $code = htmlspecialchars(addslashes($_POST['code']));
                        } else {
                            echo "il faut remplire tout les champs ". "<br>";
                            if (empty($_POST["pseudo"])) {
                                echo "pseudo \n". "<br>";
                            }
                            if (empty($_POST['password'])) {
                                echo "mot de passe \n". "<br>";
                            }
                            if (empty($_POST['confirm_password'])) {
                                echo "mot de passe 2 \n". "<br>";
                            }
                            if (empty($_POST['nom'])) {
                                echo "nom \n". "<br>";
                            }
                            if (empty($_POST['prenom'])) {
                                echo "prenom ". "<br>";
                            }
                            if (empty($_POST['code'])) {
                                echo "code \n". "<br>";
                            }
                            echo"<div class='mt-4'><a href='inscription.php' class='btn btn-primary'>Retour au formulaire</a></div>";
                            exit();
                        }
                        if ($mysqli->connect_errno) {
                            // Affichage d'un message d'erreur
                            echo "Error: Problème de connexion à la BDD \n";
                            echo "Errno: " . $mysqli->connect_errno . "\n";
                            echo "Error: " . $mysqli->connect_error . "\n";
                            // Arrêt du chargement de la page
                            exit();
                        }
                        // Instruction à rajouter depuis PHP 8.1
                        mysqli_report(MYSQLI_REPORT_OFF);
                        //echo ("Connexion BDD réussie !");
                        // Instructions PHP à ajouter pour l'encodage utf8 du jeu de caractères
                        if (!$mysqli->set_charset("utf8")) {
                            printf("Pb de chargement du jeu de car. utf8 : %s \n", $mysqli->error);
                            exit();
                        }

                        $sql0 = "SELECT pres_code from t_presentation_pres where pres_id=3 ";
                        $result0 = $mysqli->query($sql0);   //Exécution de la requête de recuperation du code d'inscription
                        $ligne = $result0->fetch_assoc();  //recupere toute la ligne 
                        //echo ($sql0);
                        $result0 = $mysqli->query($sql0);
                        if ($result0 == false) //Erreur lors de l’exécution de la requête
                        {
                            // La requête a echoué
                            echo "Error: La requête a échoué \n";
                            echo "Query: " . $sql0 . "\n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit();
                        }

                        $sqlcpt = "SELECT count(*)as nbcpt from t_compt_cpt where  cpt_pseudo=('" . $id . "')";
                        $resultcpt = $mysqli->query($sqlcpt);   //Exécution de la requête de recuperation du code d'inscription
                        $lignecpt = $resultcpt->fetch_assoc();  //recupere toute la ligne 
                        //echo ($sqlcpt);
                        $resultcpt = $mysqli->query($sqlcpt);
                        if ($resultcpt == false) //Erreur lors de l’exécution de la requête
                        {
                            // La requête a echoué
                            echo "Error: La requête a échoué \n";
                            echo "Query: " . $sqlcpt . "\n";
                            echo "Errno: " . $mysqli->errno . "\n";
                            echo "Error: " . $mysqli->error . "\n";
                            exit;
                        } 
                        if ($lignecpt['nbcpt'] != 0) {
                            $probleme = 1;
                            echo "<p> compte existe deja  </p>";
                        }

                        if (strcasecmp($code, $ligne['pres_code']) != 0) {
                            $probleme = 1;
                            echo "<p> code d'inscription incorect  </p>";
                        }

                        if (strcasecmp($mdp1, $mdp2) != 0) {
                            $probleme = 1;
                            echo "<p> mot de passe incompatible  </p>";
                        }

                        if ($probleme == 1) {
                            echo"<div class='mt-4'><a href='inscription.php' class='btn btn-primary'>Retour au formulaire</a></div>";
                            exit();
                        }
                        if ($probleme == 0) {
                            $sql = "INSERT INTO t_compt_cpt VALUES('" . $id . "',MD5('" . $mdp1 . "'));";
                            // Affichage de la requête constituée pour vérification
                            //echo ($sql);
                            $result3 = $mysqli->query($sql);
                            if ($result3 == false) //Erreur lors de l’exécution de la requête
                            {
                                // La requête a echoué
                                echo "Error: La requête a échoué \n";
                                echo "Query: " . $sql . "\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                exit();
                            } else //Requête réussie
                            {
                                echo "<br />";
                                echo "Insertion compte réussie !" . "<br>";
                            }

                            $sql1 = "INSERT INTO t_profil_pro (cpt_pseudo, pro_nom, pro_prenom, pro_valide, pro_statut ,pro_date) VALUES 
                                    ('" . $id . "' , '" . $nom . "', '" . $prenom . "','D','R',Now())";
                            //echo ($sql1);
                            //Exécution de la requête d'ajout d'un compte dans la table des comptes
                            $result4 = $mysqli->query($sql1);
                            if ($result4 == false) //Erreur lors de l’exécution de la requête
                            {
                                // La requête a echoué
                                echo "Error: La requête insertion profil a échoué \n";
                                echo "Query: " . $sql1 . "\n";
                                echo "Errno: " . $mysqli->errno . "\n";
                                echo "Error: " . $mysqli->error . "\n";
                                $sqlsup = "DELETE FROM t_compt_cpt where cpt_pseudo='" . $id . "';";
                                // Affichage de la requête constituée pour vérification
                                echo ($sqlsup);
                                $resultsup = $mysqli->query($sqlsup);
                                if ($resultsup == false) //Erreur lors de l’exécution de la requête
                                {
                                    // La requête a echoué
                                    echo "Error: La requête suspression compte a échoué \n";
                                    echo "Query: " . $sql . "\n";
                                    echo "Errno: " . $mysqli->errno . "\n";
                                    echo "Error: " . $mysqli->error . "\n";
                                    exit();
                                } else //Requête réussie
                                {
                                    echo "le compte est supprimer :|  "."<br>";
                                    echo"<div class='mt-4'><a href='inscription.php' class='btn btn-primary'>Retour au formulaire</a></div>";
                                    exit();
                                }
                            } else //Requête réussie
                            {
                                echo "<br />";
                                echo "Inscription profil réussie !" . "\n";
                            }
                        }
                            
                        
                        //Ferme la connexion avec la base MariaDB
                        $mysqli->close();
                        ?> 

                    </div>
                </div>
            </div>
        </div>
    </main>
    </div>
    <footer class="py-5 bg-violet text-white">
        <div class="container text-center">

            <h5><?php $requete = "SELECT pres_texte,pres_nomstruct,pres_logo ,pres_adresse,pres_tel,pres_email,pres_horaire  FROM t_presentation_pres;";                                                 //la requette
                $result1 = $mysqli->query($requete);
                if ($result1 == false) {
                    echo "Error: La requête a echoué \n";
                    echo "Errno: " . $mysqli->errno . "\n";
                    echo "Error: " . $mysqli->error . "\n";
                    exit();
                } else {
                    if ($presentation = $result1->fetch_assoc()) {
                        echo $presentation['pres_nomstruct'];
                    }
                } ?></h5>

            <p>
                <?php echo $presentation['pres_email']; ?> |
                <?php echo $presentation['pres_tel']; ?>
            </p>

            <p>
                <?php echo $presentation['pres_horaire']; ?>
            </p>

            <p>
                <?php echo $presentation['pres_adresse']; ?>
            </p>

        </div>
    </footer>
</body>

</html>